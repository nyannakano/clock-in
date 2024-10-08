<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Justification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'type',
        'description',
        'attachment',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
