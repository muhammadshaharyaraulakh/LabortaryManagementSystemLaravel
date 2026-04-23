<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'orderTestId',
        'testParameterId',
        'trackingId',
        'resultValue',
        'attachmentPaths',
        'statusFlag',
        'remarks'
    ];

    protected $casts = [
        'attachmentPaths' => 'array',
    ];

    public function parameter()
    {
        return $this->belongsTo(TestParameter::class, 'testParameterId');
    }
}
