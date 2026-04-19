<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'price', 'sampleType', 
        'resultHours', 'instructions', 'isActive', 'departmentId',
        'userId'
    ];

    public function parameters()
    {
        return $this->hasMany(TestParameter::class, 'testId');
    }
    public function requirements()
    {
        return $this->hasMany(TestRequirement::class, 'testId');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }
}