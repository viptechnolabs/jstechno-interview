<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\Request;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;

class EmployeeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function add(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.add', compact('departments', 'positions'));
    }

    public function store(EmployeeRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $name = $request->input('name');
        $positions_id = $request->input('positions_id');
        $department_id = $request->input('department_id');
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

        session()->flash('success', 'Employee added successfully');
        return redirect()->route('employee.index');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(EmployeeRequest $request): \Illuminate\Http\RedirectResponse
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

        session()->flash('success', 'Employee updated successfully');
        return redirect()->route('employee.index');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        // Request params
        $id = $request->input('id');
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
