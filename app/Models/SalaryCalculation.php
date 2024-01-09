<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'calculation_date',
        'gross_salary',
        'status',
    ];
}
