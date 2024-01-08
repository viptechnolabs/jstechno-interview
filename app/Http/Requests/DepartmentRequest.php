<?php

namespace App\Http\Requests;

class DepartmentRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
