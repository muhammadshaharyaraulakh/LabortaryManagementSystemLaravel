<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestParameter extends Model
{
    use HasFactory;
    use SoftDeletes;
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