<?php

namespace App\Http\Requests;

class SalaryRequest extends Request
{
    public function rules(): array
    {
        return [
            'positions_id' => 'required|exists:positions,id',
            'basic_salary' => 'required',
            'hra' => 'required',
            'da' => 'required',
            'other_allowances' => 'required',
        ];
    }
}
