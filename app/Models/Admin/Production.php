<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $table = 'item_production';

        protected $fillable = ['item_id', 'price_id', 'qty', 'user_id','branch_id','production_cost','unit_cost_price'];


    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
