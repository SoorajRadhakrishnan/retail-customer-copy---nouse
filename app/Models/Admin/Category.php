<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_name','category_slug','other_name','branch_id','uuid'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function items()
    {
        return $this->hasMany(Item::class,'category_id','id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($category) {
            $category->items()->each(function($item) {
                $item->delete(); // This will trigger the delete in the Item model
            });
        });
    }
}
