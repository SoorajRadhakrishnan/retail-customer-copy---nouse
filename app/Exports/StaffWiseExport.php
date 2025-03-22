<?php

namespace App\Exports;

use App\Models\SaleOrders;
use Maatwebsite\Excel\Concerns\FromCollection;

class StaffWiseExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SaleOrders::all();
    }
}
