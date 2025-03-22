<?php

namespace App\Exports;

use App\Models\SaleOrders;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class DriverWiseExport implements FromCollection,WithHeadings, WithEvents, WithCustomStartCell, WithMapping
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
        $driver_id = $this->request->driver_id;

        if(auth()->user()->branch_id)
        {
            return SaleOrders::leftJoin('sale_order_items', function ($join) {
                $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
            })->when($driver_id, function (Builder $query,$driver_id) {
                $query->where('sale_orders.driver_id',$driver_id);
            })->where('sale_orders.shop_id', auth()->user()->branch_id)
                ->where('sale_orders.status','!=','hold')
                ->where('sale_orders.payment_status','paid')
                ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                ->groupBy('sale_orders.driver_id')
                ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                ->get();
        }
        else{
            if(getSessionBranch()){
                return SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($driver_id, function (Builder $query,$driver_id) {
                            $query->where('sale_orders.driver_id',$driver_id);
                        })->where('sale_orders.shop_id', getSessionBranch())
                        ->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.driver_id')
                        ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }else{
                return SaleOrders::leftJoin('sale_order_items', function ($join) {
                            $join->on('sale_orders.id', '=', 'sale_order_items.sale_order_id');
                        })->when($driver_id, function (Builder $query,$driver_id) {
                            $query->where('sale_orders.driver_id',$driver_id);
                        })->where('sale_orders.status','!=','hold')
                        ->where('sale_orders.payment_status','paid')
                        ->whereBetween('sale_orders.ordered_date', [$from_date, $to_date])
                        ->groupBy('sale_orders.driver_id')
                        ->select(DB::raw('sale_orders.driver_id,sum(sale_order_items.price * sale_order_items.qty) as total_price, sum(sale_order_items.item_unit_price * sale_order_items.qty) as after_discount'))
                        ->get();
            }
        }
    }

    public function map($user): array
    {
        return [//dd(getDriverByID($user->driver_id)),
            getDriverByID($user->driver_id)['driver_name'],
            showAmount($user->total_price),
            showAmount($user->total_price - $user->after_discount),
            showAmount($user->after_discount),
        ];
    }


    public function headings(): array
    {
        return [
            'Driver',
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
                $event->sheet->setCellValue('A1', 'Driver Wise Report');

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
