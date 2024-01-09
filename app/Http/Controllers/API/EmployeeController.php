<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\Request;
use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Traits\ResponseTrait;

class EmployeeController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $employees = Employee::all();
        return EmployeeResource::collection($employees)
            ->additional([
                'message' => 'Employee List',
                'status' => true
            ]);
    }

    public function details($id): EmployeeResource
    {
        $employee = Employee::find($id);

        return (new EmployeeResource($employee))
            ->additional([
                'message' => 'Employee Details',
                'status' => true
            ]);
    }

    public function store(Request $request): EmployeeResource
    {
        // Request params
        $name = $request->input('name');
        $department_id = $request->input('department_id');
        $positions_id = $request->input('positions_id');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');

        $employee = new Employee();
        $employee->name = $name;
        $employee->department_id = $department_id;
        $employee->position_id = $positions_id;
        $employee->email = $email;
        $employee->phone_number = $phone_number;
        $employee->address = $address;
        $employee->save();

        return (new EmployeeResource($employee))
            ->additional([
                'message' => 'Employee added successfully',
                'status' => true
            ]);
    }

    public function update(Request $request): EmployeeResource
    {
        // Request params
        $id = $request->input('id');
        $name = $request->input('name');
        $positions_id = $request->input('positions_id');
        $department_id = $request->input('department_id');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');

        $employee = Employee::find($id);
        $employee->name = $name;
        $employee->department_id = $department_id;
        $employee->position_id = $positions_id;
        $employee->email = $email;
        $employee->phone_number = $phone_number;
        $employee->address = $address;
        $employee->save();

        return (new EmployeeResource($employee))
            ->additional([
                'message' => 'Employee updated successfully',
                'status' => true
            ]);
    }

    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return $this->error(message: 'Employee not found');
        }
        $employee->delete();
        return $this->success(message: 'Employee deleted successfully.');
    }
}
