<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['payment_method_name','payment_method_slug','branch_id','uuid'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
