<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ExpenseExport implements FromCollection,WithHeadings, WithEvents, WithCustomStartCell, WithMapping
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
        $payment_status = $this->request->payment_status;

        return Expense::when($branch_id, function ($query,$branch_id) {
                $query->where('branch_id',$branch_id);
            })->when($payment_status, function ($query,$payment_status) {
                $query->where('payment_status',$payment_status);
            })
            ->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','desc')
            ->get();
    }

    public function map($expense): array
    {
        return [
            Str::ucfirst($expense->expense_cat_name),
            Str::ucfirst($expense->action),
            Str::ucfirst($expense->invoice_no),
            Str::ucfirst($expense->description),
            Str::ucfirst($expense->payment_status),
            showAmount($expense->total_before_vat),
            showAmount($expense->vat),
            showAmount($expense->total_amount),
        ];
    }


    public function headings(): array
    {
        return [
            'Expense Category Name',
            'Added From',
            'Invoice Number',
            'Description',
            'Payment Status',
            'Total Before VAT',
            'VAT Amount',
            'Final Amount',
        ];
    }

    /**
     * Set the starting cell for the data
     */
    public function startCell(): string
    {
        return 'A8'; // Data will start from this cell
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
                $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
                $branch = $this->getBranch() ? getBranchById($this->getBranch()) : "All Branch";
                $payment_status = $this->request->payment_status;

                $event->sheet->setCellValue('A1', 'Expense Report');

                $event->sheet->setCellValue('A3', 'Branch:');
                $event->sheet->setCellValue('B3', $branch);

                $event->sheet->setCellValue('A4', 'From Date:');
                $event->sheet->setCellValue('B4', $from_date);

                $event->sheet->setCellValue('A5', 'To Date:');
                $event->sheet->setCellValue('B5', $to_date);

                $event->sheet->setCellValue('A6', 'Payment Status:');
                $event->sheet->setCellValue('B6', $payment_status);

                $sheet = $event->sheet;

                $sheet->getStyle("A8:H8")->getFont()->setBold(true);
                $sheet->getStyle("A1")->getFont()->setBold(true);
                $sheet->getStyle("A3")->getFont()->setBold(true);
                $sheet->getStyle("A4")->getFont()->setBold(true);
                $sheet->getStyle("A5")->getFont()->setBold(true);
                $sheet->getStyle("A6")->getFont()->setBold(true);
            },
        ];
    }

    public function styles($sheet)
    {
        // Apply styles to header row
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }
}
