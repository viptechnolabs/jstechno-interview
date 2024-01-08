<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function positions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Employee::class);
    }

}
