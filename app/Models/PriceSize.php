<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceSize extends Model
{
    protected $table = 'price_size';

    use HasFactory, SoftDeletes;

    protected $fillable = ['size_name','branch_id','uuid', 'size_slug'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
