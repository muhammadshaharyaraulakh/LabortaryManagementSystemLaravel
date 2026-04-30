<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'trackingId',
        'name',
        'phone',
        'email',
        'age',
        'gender',
        'subtotal',
        'discount',
        'tax',
        'grandTotal',
        'fiaReceiptNo',
        'userId',
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'order_test', 'orderId', 'testId')
            ->withPivot('id', 'status', 'priceAtOrder','vialBarcode')
            ->withTimestamps();
    }
}