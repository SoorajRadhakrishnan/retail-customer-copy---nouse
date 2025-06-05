<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['notes', 'amount', 'transaction_date', 'destination_payment_type','source_payment_type','user_id','branch_id','uuid'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
