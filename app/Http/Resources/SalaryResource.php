<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Salary
 */
class SalaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'basic_salary' => $this->basic_salary,
            'hra' => $this->hra,
            'da' => $this->da,
            'other_allowances' => $this->other_allowances,
            'gross_salary' => $this->gross_salary,
            'position' => new PositionResource($this->position),
        ];
    }
}
