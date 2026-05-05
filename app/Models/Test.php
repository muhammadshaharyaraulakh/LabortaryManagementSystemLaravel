<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'code',
        'price',
        'sampleType',
        'resultHours',
        'instructions',
        'isActive',
        'departmentId',
        'userId',
        'Instrctuions(SampleCollector)',
        'deleted_by',
        'edited_by',
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