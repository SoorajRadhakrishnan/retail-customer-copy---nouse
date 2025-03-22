<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockManage extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'stock_manage';

    protected $fillable = ['created_user_id', 'approver_user_id', 'source_branch_id', 'destination_branch_id', 'manage_type',
                            'status', 'notes', 'transaction_date', 'uuid'];

    public function getSourcebranch()
    {
        return $this->belongsTo(Branch::class, 'source_branch_id', 'id');
    }

    public function getDestinationbranch()
    {
        return $this->belongsTo(Branch::class, 'destination_branch_id', 'id');
    }

    public function getManageItems()
    {
        return $this->hasMany(StockManageItem::class, 'stock_manage_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($manage) {
            $manage->getManageItems()->delete();
        });
    }
}
