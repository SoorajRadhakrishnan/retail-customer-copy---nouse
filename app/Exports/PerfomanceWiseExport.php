<?php

namespace App\Exports;

use App\Models\Purchase;
use App\Models\SaleOrders;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class PerfomanceWiseExport implements FromCollection,WithHeadings, WithEvents, WithCustomStartCell, WithMapping
{
    protected $request;

    // Inject the request into the constructor
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $item_id = $this->request->item_id;

        if(auth()->user()->branch_id)
        {
            // DB::enableQueryLog();
            return  SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->when($item_id, function (QueryBuilder $query,$item_id) {
                    $query->where('sale_order_items.price_size_id',$item_id);
                })
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_order_items.price_size_id')
                ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                ->orderBy('total_price','desc')
                ->get();
        }
        else{
            if(getSessionBranch()){
                return  SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })->where('sale_orders.shop_id', getSessionBranch())
                    ->when($item_id, function (QueryBuilder $query,$item_id) {
                        $query->where('sale_order_items.price_size_id',$item_id);
                    })
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.price_size_id')
                    ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                    ->orderBy('total_price','desc')
                    ->get();
            }else{
                return  SaleOrders::leftJoin('sale_order_items', function ($join) {
                    $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                    })
                    ->when($item_id, function (QueryBuilder $query,$item_id) {
                        $query->where('sale_order_items.price_size_id',$item_id);
                    })
                    ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                    ->groupBy('sale_order_items.price_size_id')
                    ->select(DB::raw('sale_order_items.price_size_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount,sum(sale_order_items.qty) as total_qty'))
                    ->orderBy('total_price','desc')
                    ->get();
            }
        }
    }

    public function map($user): array
    {
        return [
           Str::ucfirst(getItemNameSize($user->price_size_id)),
            $user->total_qty,
            showAmount($user->total_price),
            showAmount($user->total_price - $user->after_discount),
            showAmount($user->after_discount),
        ];
    }


    public function headings(): array
    {
        return [
            'Item',
            'Qty',
            'Gross Total',
            'Discount',
            'Net Total',
        ];
    }

    /**
     * Set the starting cell for the data
     */
    public function startCell(): string
    {
        return 'A3'; // Data will start from this cell
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Adding text in the first row
                $event->sheet->setCellValue('A1', 'Perfomance - Top Selling Report');

                // Optionally, merge cells if you want this text to span across multiple columns
                // $event->sheet->mergeCells('A1:D1'); // Merging from A1 to D1

                // // Optionally, add styling
                // $event->sheet->getStyle('A1')->applyFromArray([
                //     'font' => [
                //         'bold' => true,
                //         'size' => 14,
                //     ],
                //     'alignment' => [
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //     ],
                // ]);
            },
        ];
    }
}
