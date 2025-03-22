<?php

namespace App\Exports;

use App\Models\SaleOrders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class BillWiseExport implements FromCollection, WithHeadings, WithEvents, WithStyles, WithCustomStartCell, WithMapping
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
        $customer = $this->request->customer;
        $receipt_id = $this->request->receipt_id;
        $branch_id = $this->getBranch();

        return SaleOrders::whereBetween('ordered_date', [$from_date, $to_date])
                    ->where('status','!=','hold')
                    ->where('payment_status','paid')
                    ->when($branch_id, function ($query,$branch_id) {
                        $query->where('shop_id',$branch_id);
                    })
                    ->when($customer, function ($query,$customer) {
                        $query->where('customer_id',$customer);
                    })
                    ->when($receipt_id, function ($query,$receipt_id) {
                        $query->where('receipt_id',$receipt_id);
                    })
                    ->get(['receipt_id','ordered_date','customer_id','payment_type','without_tax','discount','with_tax']);
    }

    public function map($user): array
    {
        return [
            $user->receipt_id,
            dateFormat($user->ordered_date,1),
            $user->customer_id ? getCustomerDetById($user->customer_id) : '',
            $user->payment_type,
            showAmount($user->without_tax),
            showAmount($user->discount),
            showAmount($user->with_tax),
        ];
    }

    public function headings(): array
    {
        return [
            'Receipt ID',
            'Date',
            'Customer',
            'Payment Type',
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
        return 'A9'; // Data will start from this cell
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $from_date = (isset($this->request->from_date) && $this->request->from_date != '') ? $this->request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
                $to_date = (isset($this->request->to_date) && $this->request->to_date != '') ? $this->request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
                $customer = $this->request->customer ? getCustomerDetById($this->request->customer) : '';
                $receipt_id = $this->request->receipt_id;
                $branch = $this->getBranch() ? getBranchById($this->getBranch()) : "All Branch";

                $event->sheet->setCellValue('A1', 'Bill Wise Report');

                $event->sheet->setCellValue('A3', 'Branch:');
                $event->sheet->setCellValue('B3', $branch);

                $event->sheet->setCellValue('A4', 'From Date:');
                $event->sheet->setCellValue('B4', $from_date);

                $event->sheet->setCellValue('A5', 'To Date:');
                $event->sheet->setCellValue('B5', $to_date);

                $event->sheet->setCellValue('A6', 'Receipt ID:');
                $event->sheet->setCellValue('B6', $receipt_id);

                $event->sheet->setCellValue('A7', 'Customer:');
                $event->sheet->setCellValue('B7', $customer);

                $sheet = $event->sheet;

                // Calculate totals
                $data = $this->collection();
                $gross_total = $discount = $net_total = 0;
                foreach($data as $date){
                    $gross_total += $date->without_tax;
                    $discount += $date->discount;
                    $net_total += $date->with_tax;
                }
                // $gross_total = $data->sum(fn($row) => $row[4]);
                // $discount = $data->sum(fn($row) => $row[5]);
                // $net_total = $data->sum(fn($row) => $row[6]);

                // Define starting cell for footer
                // $startCell = 'A5';
                $footerRow = count($data) + 10; // The row where the footer will start

                // Add footer with totals
                $sheet->setCellValue("A{$footerRow}", 'Total');
                $sheet->setCellValue("B{$footerRow}", '');
                $sheet->setCellValue("C{$footerRow}", '');
                $sheet->setCellValue("D{$footerRow}", '');
                $sheet->setCellValue("E{$footerRow}", showAmount($gross_total,1));
                $sheet->setCellValue("F{$footerRow}", showAmount($discount,1));
                $sheet->setCellValue("G{$footerRow}", showAmount($net_total,1));

                // Optionally, apply styles to the footer
                $sheet->getStyle("A{$footerRow}:G{$footerRow}")->getFont()->setBold(true);
                $sheet->getStyle("A9:G9")->getFont()->setBold(true);
                $sheet->getStyle("A3")->getFont()->setBold(true);
                $sheet->getStyle("A4")->getFont()->setBold(true);
                $sheet->getStyle("A5")->getFont()->setBold(true);
                $sheet->getStyle("A6")->getFont()->setBold(true);
                $sheet->getStyle("A7")->getFont()->setBold(true);
                $sheet->getStyle("A{$footerRow}:G{$footerRow}")->getAlignment()->setHorizontal('center');
            },
        ];
    }

    public function styles($sheet)
    {
        // Apply styles to header row
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }
}

