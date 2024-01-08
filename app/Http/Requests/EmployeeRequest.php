<?php

namespace App\Http\Requests;

class EmployeeRequest extends Request
{
    public function rules(): array
    {
        $id = $this->request->get('id');
        return [
            'name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'positions_id' => 'required|exists:positions,id',
            'email' => 'required|unique:employees,email,'.$id,
            'phone_number' => 'required',
            'address' => 'required',
        ];
    }
}
