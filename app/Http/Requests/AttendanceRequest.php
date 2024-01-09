<?php

namespace App\Http\Requests;

class AttendanceRequest extends Request
{
    public function rules(): array
    {
        $id = $this->request->get('id');
        return [
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required',
        ];
    }
}
