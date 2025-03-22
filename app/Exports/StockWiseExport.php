<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStyles;

class StockWiseExport implements FromCollection, WithHeadings, WithEvents, WithStyles, WithCustomStartCell, WithMapping
{
    protected $request;

    // Inject the request into the constructor
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getBranch()
    {
        $branch_id = '';
        if(auth()->user()->branch_id)
        {
            $branch_id = auth()->user()->branch_id;
        }
        if(getSessionBranch())
        {
            $branch_id = getSessionBranch();
        }
        return $branch_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $item_id = $this->request->item_id;
        $action_type = $this->request->action_type;
        $branch_id = $this->getBranch();

        return  DB::table('stock_management_history')
                ->when($branch_id, function ($query,$branch_id) {
                    $query->where('shop_id',$branch_id);
                })
                ->when($action_type, function ($query,$action_type) {
                    $query->where('action_type',$action_type);
                })
                ->when($item_id, function ($query,$item_id) {
                    $query->where('item_price_id',$item_id);
                })
                ->whereBetween('date_added', [$from_date, $to_date])->orderBy('id','desc')->get();
    }

    public function map($user): array
    {
        return [
            dateFormat($user->date_added,1),
            Str::ucfirst(getItemNameSize($user->item_price_id)),
            str_replace("_"," ",$user->reference_key),
            $user->action_type,
            $user->open_stock,
            $user->stock_value,
            $user->closing_stock,
        ];
    }


    public function headings(): array
    {
        return [
            'Date',
            'Item',
            'Reference',
            'Action Type',
            'Open Stock',
            'Qty',
            'Closing Stock',
        ];
    }

    /**
     * Set the starting cell for the data
     */
    public function startCell(): string
    {
        return 'A9'; // Data will start from this cell
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
                $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');

                $item_id = $this->request->item_id ? getItemNameSize($this->request->item_id) : '' ;
                $action_type = $this->request->action_type;
                $branch = $this->getBranch() ? getBranchById($this->getBranch()) : "All Branch";

                $event->sheet->setCellValue('A1', 'Stock Report');

                $event->sheet->setCellValue('A3', 'Branch:');
                $event->sheet->setCellValue('B3', $branch);

                $event->sheet->setCellValue('A4', 'From Date:');
                $event->sheet->setCellValue('B4', $from_date);

                $event->sheet->setCellValue('A5', 'To Date:');
                $event->sheet->setCellValue('B5', $to_date);

                $event->sheet->setCellValue('A6', 'Item:');
                $event->sheet->setCellValue('B6', $item_id);

                $event->sheet->setCellValue('A7', 'Action Type:');
                $event->sheet->setCellValue('B7', $action_type);

                $sheet = $event->sheet;

                $sheet->getStyle("A9:G9")->getFont()->setBold(true);
                $sheet->getStyle("A3")->getFont()->setBold(true);
                $sheet->getStyle("A4")->getFont()->setBold(true);
                $sheet->getStyle("A5")->getFont()->setBold(true);
                $sheet->getStyle("A6")->getFont()->setBold(true);
                $sheet->getStyle("A7")->getFont()->setBold(true);
            },
        ];
    }

    public function styles($sheet)
    {
        // Apply styles to header row
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }
}
