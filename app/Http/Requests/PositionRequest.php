<?php

namespace App\Http\Requests;

class PositionRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'department_id' => 'required|exists:departments,id'
        ];
    }
}
