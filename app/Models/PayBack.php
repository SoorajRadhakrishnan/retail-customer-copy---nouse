<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayBack extends Model
{
    use HasFactory;

    protected $table = 'pay_back';  // Specify the table name if it doesn't follow Laravel's plural naming convention

    protected $fillable = [
        'customer_id',
        'amount',
        'payback_date',
        'payback_status',
        'notes',
    ];

    // Define the relationship with the Customer model

}
