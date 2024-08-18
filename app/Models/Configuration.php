<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'shoul_block_weekends',
        'overtime_type',
        'allow_overtime',
    ];

    protected $casts = [
        'shoul_block_weekends' => 'boolean',
        'allow_overtime' => 'boolean',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
