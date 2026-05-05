<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TestRequirement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'testId',
        'inventoryId',
        'quantityUsed'
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