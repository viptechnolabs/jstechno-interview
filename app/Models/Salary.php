<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
