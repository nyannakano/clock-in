<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
