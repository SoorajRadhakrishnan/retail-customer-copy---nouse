<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use HasFactory;

    protected $fillable = ['offer_id', 'category_id'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    // In OfferCategory.php model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
