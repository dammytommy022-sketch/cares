<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name', 'location', 'status'];

    public function personnel()
    {
        return $this->hasMany(Personnel::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

