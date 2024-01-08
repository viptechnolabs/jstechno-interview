<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\Request;
use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    public function add(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('department.add');
    }

    public function store(DepartmentRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $name = $request->input('name');

        $department = new Department();
        $department->name = $name;
        $department->slug = Str::slug($name);
        $department->save();

        session()->flash('success', 'Department added successfully');
        return redirect()->route('department.index');
    }

    public function edit($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $department = Department::where('slug', $slug)->first();
        return view('department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $id = $request->input('id');
        $name = $request->input('name');

        $department = Department::find($id);
        $department->name = $name;
        $department->slug = Str::slug($name);
        $department->save();

        session()->flash('success', 'Department updated successfully');
        return redirect()->route('department.index');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        // Request params
        $id = $request->input('id');
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        $department->delete();

        return response()->json(['message' => 'Department deleted successfully']);
    }
}
