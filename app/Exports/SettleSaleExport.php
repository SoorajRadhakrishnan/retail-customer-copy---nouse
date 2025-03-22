<?php

namespace App\Exports;

use App\Models\SettleSale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class SettleSaleExport implements FromCollection,WithHeadings, WithEvents, WithCustomStartCell, WithMapping
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

    public function collection() : Collection
    {
        $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        $branch_id = $this->getBranch();

        return SettleSale::when($branch_id, function ($query,$branch_id) {
            $query->where('shop_id',$branch_id);
        })->whereBetween('settle_date', [$from_date, $to_date])->orderBy('id','desc')
        ->get();
    }

    public function map($purchase): array
    {
        return [
            dateFormat($purchase->settle_date,1),
            showAmount($purchase->cash_at_starting),
            showAmount($purchase->cash_sale),
            showAmount($purchase->card_sale),
            showAmount($purchase->credit_sale),
            showAmount($purchase->credit_recover),
            showAmount($purchase->delivery_sale),
            showAmount($purchase->delivery_recover),
            showAmount($purchase->pay_back),
            showAmount($purchase->pay_back_vat),
            showAmount($purchase->expense),
            showAmount($purchase->gross_total),
            showAmount($purchase->discount),
            showAmount($purchase->gross_total_tax),
            showAmount($purchase->net_total),
            showAmount($purchase->cash_drawer),
        ];
    }


    public function headings(): array
    {
        return [
            'Settle Date',
            'Cash At Starting',
            'Cash Sale',
            'Card Sale',
            'Credit Sale',
            'Credit Recover',
            'Delivery Sale',
            'Delivery Recover',
            'Payback',
            'Payback VAT',
            'Expense',
            'Gross Total',
            'Discount',
            'Sale VAT',
            'Net Total',
            'Cash Drawer',
        ];
    }

    /**
     * Set the starting cell for the data
     */
    public function startCell(): string
    {
        return 'A7'; // Data will start from this cell
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
                $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
                $branch = $this->getBranch() ? getBranchById($this->getBranch()) : "All Branch";

                $event->sheet->setCellValue('A1', 'Settle Sale Report');

                $event->sheet->setCellValue('A3', 'Branch:');
                $event->sheet->setCellValue('B3', $branch);

                $event->sheet->setCellValue('A4', 'From Date:');
                $event->sheet->setCellValue('B4', $from_date);

                $event->sheet->setCellValue('A5', 'To Date:');
                $event->sheet->setCellValue('B5', $to_date);

                $sheet = $event->sheet;

                $sheet->getStyle("A7:P7")->getFont()->setBold(true);
                $sheet->getStyle("A1")->getFont()->setBold(true);
                $sheet->getStyle("A3")->getFont()->setBold(true);
                $sheet->getStyle("A4")->getFont()->setBold(true);
                $sheet->getStyle("A5")->getFont()->setBold(true);
            },
        ];
    }

    public function styles($sheet)
    {
        // Apply styles to header row
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }
}
