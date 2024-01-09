<?php

namespace App\Http\Resources;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Attendance
 */
class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'in_time' => $this->in_time,
            'out_time' => $this->out_time,
            'employee' => new EmployeeResource($this->employee),
        ];
    }
}
