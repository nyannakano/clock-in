<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'internal_id',
        'avatar',
        'born_at',
        'group_id'
    ];

    protected function casts(): array
    {
        return [
            'born_at' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function workload()
    {
        return $this->hasOne(Workload::class);
    }

    public function clockins()
    {
        return $this->hasMany(Clockin::class);
    }

    public function justifications()
    {
        return $this->hasMany(Justification::class);
    }
}
