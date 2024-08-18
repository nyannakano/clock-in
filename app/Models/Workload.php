<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    protected $fillable = [
        'total_hours_day',
        'total_days_week',
        'employee_id',
        'interval_hours',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
