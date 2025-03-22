<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['unit_name','unit_slug','branch_id','uuid'];

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
        return $this->hasMany(Item::class,'unit_id','id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($unit) {
            $unit->items()->each(function($item) {
                $item->delete(); // This will trigger the delete in the Item model
            });
        });
    }
}
