<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'offer_name', // Add offer_name to fillable fields
        'promocode',
        'from_date',
        'to_date',
        'value',
        'min_amt',
        'type',
        'active',
        'uuid',
    ];
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,      // Related model
            'offer_categories',   // Pivot table
            'offer_id',           // Foreign key on the pivot table referencing offers
            'category_id'         // Foreign key on the pivot table referencing categories
        );
    }
    }
