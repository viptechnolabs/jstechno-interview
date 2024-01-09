<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Requests\SalaryRequest;
use App\Http\Resources\SalaryResource;
use App\Models\Position;
use App\Models\Salary;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;

class SalaryController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $salaries = Salary::all();
        return SalaryResource::collection($salaries)
            ->additional([
                'message' => 'Salary List',
                'status' => true
            ]);
    }

    public function details($id): SalaryResource
    {
        $salary = Salary::find($id);

        return (new SalaryResource($salary))
            ->additional([
                'message' => 'Salary Details',
                'status' => true
            ]);
    }

    public function store(Request $request): SalaryResource
    {
        // Request params
        $positions_id = $request->input('positions_id');
        $basic_salary = $request->input('basic_salary');
        $hra = $request->input('hra');
        $da = $request->input('da');
        $other_allowances = $request->input('other_allowances');
        $gross_salary = $basic_salary + $hra + $da + $other_allowances;

        $salary = new Salary();
        $salary->position_id = $positions_id;
        $salary->basic_salary = $basic_salary;
        $salary->hra = $hra;
        $salary->da = $da;
        $salary->other_allowances = $other_allowances;
        $salary->gross_salary = $gross_salary;
        $salary->save();

        return (new SalaryResource($salary))
            ->additional([
                'message' => 'Position added successfully',
                'status' => true
            ]);
    }

    public function update(Request $request): SalaryResource
    {
        // Request params
        $id = $request->input('id');
        $positions_id = $request->input('positions_id');
        $basic_salary = $request->input('basic_salary');
        $hra = $request->input('hra');
        $da = $request->input('da');
        $other_allowances = $request->input('other_allowances');
        $gross_salary = $basic_salary + $hra + $da + $other_allowances;

        $salary = Salary::find($id);
        $salary->position_id = $positions_id;
        $salary->basic_salary = $basic_salary;
        $salary->hra = $hra;
        $salary->da = $da;
        $salary->other_allowances = $other_allowances;
        $salary->gross_salary = $gross_salary;
        $salary->save();

        return (new SalaryResource($salary))
            ->additional([
                'message' => 'Salary updated successfully',
                'status' => true
            ]);
    }

    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $salary = Salary::find($id);
        if (!$salary) {
            return $this->error(message: 'Salary not found');
        }
        $salary->delete();
        return $this->success(message: 'Salary deleted successfully.');
    }
}
