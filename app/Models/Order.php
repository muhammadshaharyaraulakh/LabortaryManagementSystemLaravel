<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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
            ->withPivot('status', 'priceAtOrder')
            ->withTimestamps();
    }
}