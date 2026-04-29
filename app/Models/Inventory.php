<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'unit',
        'alert',
        'current_stock'
    ];

    public function logs()
    {
        return $this->hasMany(InventoryLog::class, 'inventory_id', 'id');
    }

}