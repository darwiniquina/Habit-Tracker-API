<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany(HabitLog::class);
    }
}
