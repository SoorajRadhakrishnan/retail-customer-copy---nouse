<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;

class PurchaseWiseExport implements FromCollection,WithHeadings, WithEvents, WithCustomStartCell, WithMapping
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
        $supplier_id = $this->request->supplier_id;
        $payment_status = $this->request->payment_status;

        if(auth()->user()->branch_id)
        {
            return Purchase::where('shop_id', auth()->user()->branch_id)
                    ->whereBetween('created_at', [$from_date, $to_date])
                    ->when($supplier_id, function (Builder $query,$supplier_id) {
                        $query->where('supplier_id',$supplier_id);
                    })->when($payment_status, function (Builder $query,$payment_status) {
                        $query->where('payment_status',$payment_status);
                    })->get();

        }
        else{
            if(getSessionBranch()){
                return Purchase::where('shop_id', getSessionBranch())
                        ->whereBetween('created_at', [$from_date, $to_date])
                        ->when($supplier_id, function (Builder $query,$supplier_id) {
                            $query->where('supplier_id',$supplier_id);
                        })->when($payment_status, function (Builder $query,$payment_status) {
                            $query->where('payment_status',$payment_status);
                        })->get();

            }else{
                return Purchase::when($supplier_id, function (Builder $query,$supplier_id) {
                            $query->where('supplier_id',$supplier_id);
                        })->when($payment_status, function (Builder $query,$payment_status) {
                            $query->where('payment_status',$payment_status);
                        })
                        ->whereBetween('created_at', [$from_date, $to_date])->get();

            }
        }
    }

    public function map($user): array
    {
        // Apply a custom function to calculate the user's age
        // $age = Carbon::parse($user->birthdate)->age;

        // Return the row data with the calculated value
        return [
            Str::ucfirst($user->supplier_name),
            Str::ucfirst($user->invoice_no),
            Str::ucfirst($user->status),
            Str::ucfirst($user->payment_status),
            showAmount($user->tax_amount),
            showAmount($user->total_amount),
            // $age, // Custom function applied to the birthdate column
            // $user->created_at->format('Y-m-d'),
        ];
    }


    public function headings(): array
    {
        return [
            'Supplier',
            'Invoice Number',
            'Status',
            'Payment Status',
            'VAT Amount',
            'Final Amount',
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
                $event->sheet->setCellValue('A1', 'Purchase Report');

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
