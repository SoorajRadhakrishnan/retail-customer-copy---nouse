<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['supplier_name','supplier_company_name','supplier_email','supplier_company_email','supplier_phone',
                            'supplier_address','branch_id','uuid'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
