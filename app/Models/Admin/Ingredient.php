<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'item_ingredient';

    protected $fillable = ['main_item_id', 'item_id', 'price_id', 'item_name', 'unit', 'qty', 'user_id','branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
