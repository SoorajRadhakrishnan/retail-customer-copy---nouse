<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PaymentTranscation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_transcations';

    protected $fillable = [
        'payment_type',
        'type',
        'status',
        'ref_no',
        'amount',
        'branch_id',
        'user_id',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_type', 'payment_method_slug');
    }
}
