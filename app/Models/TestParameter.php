<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestParameter extends Model
{
    use HasFactory;
    protected $casts = [
        'options' => 'array',
    ];
    protected $fillable = [
        'testId',
        'parameterName',
        'inputType',
        'unit',
        'normalRange',
        'options'
    ];
    public function test()
    {
        return $this->belongsTo(Test::class, 'testId');
    }
}