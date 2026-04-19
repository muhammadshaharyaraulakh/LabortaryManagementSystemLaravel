<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'testId', 'inventoryId', 'quantityUsed'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class, 'testId');
    }
    public function inventoryItem()
    {
        return $this->belongsTo(Inventory::class, 'inventoryId');
    }
}