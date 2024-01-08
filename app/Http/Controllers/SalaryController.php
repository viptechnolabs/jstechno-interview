<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Requests\SalaryRequest;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Support\Str;

class SalaryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $salaries = Salary::all();
        return view('salary.index', compact('salaries'));
    }

    public function add(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $positions = Position::all();
        return view('salary.add', compact('positions'));
    }

    public function store(SalaryRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $positions_id = $request->input('positions_id');
        $basic_salary = $request->input('basic_salary');
        $hra = $request->input('hra');
        $da = $request->input('da');
        $other_allowances = $request->input('other_allowances');
        $gross_salary = $request->input('gross_salary');

        $salary = new Salary();
        $salary->position_id = $positions_id;
        $salary->basic_salary = $basic_salary;
        $salary->hra = $hra;
        $salary->da = $da;
        $salary->other_allowances = $other_allowances;
        $salary->gross_salary = $gross_salary;
        $salary->save();

        session()->flash('success', 'Salary added successfully');
        return redirect()->route('salary.index');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $salary = Salary::find($id);
        $positions = Position::all();
        return view('salary.edit', compact('salary','positions'));
    }

    public function update(SalaryRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $id = $request->input('id');
        $positions_id = $request->input('positions_id');
        $basic_salary = $request->input('basic_salary');
        $hra = $request->input('hra');
        $da = $request->input('da');
        $other_allowances = $request->input('other_allowances');
        $gross_salary = $request->input('gross_salary');

        $salary = Salary::find($id);
        $salary->position_id = $positions_id;
        $salary->basic_salary = $basic_salary;
        $salary->hra = $hra;
        $salary->da = $da;
        $salary->other_allowances = $other_allowances;
        $salary->gross_salary = $gross_salary;
        $salary->save();

        session()->flash('success', 'Salary updated successfully');
        return redirect()->route('salary.index');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        // Request params
        $id = $request->input('id');
        $salary = Salary::find($id);

        if (!$salary) {
            return response()->json(['error' => 'Salary not found'], 404);
        }

        $salary->delete();

        return response()->json(['message' => 'Salary deleted successfully']);
    }
}
