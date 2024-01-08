<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $positions = Position::all();
        return view('position.index', compact('positions'));
    }

    public function add(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $departments = Department::all();
        return view('position.add', compact('departments'));
    }

    public function store(PositionRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $name = $request->input('name');
        $department_id = $request->input('department_id');

        $position = new Position();
        $position->name = $name;
        $position->department_id = $department_id;
        $position->slug = Str::slug($name);
        $position->save();

        session()->flash('success', 'Position added successfully');
        return redirect()->route('position.index');
    }

    public function edit($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $position = Position::where('slug', $slug)->first();
        $departments = Department::all();
        return view('position.edit', compact('position', 'departments'));
    }

    public function update(PositionRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $id = $request->input('id');
        $name = $request->input('name');
        $department_id = $request->input('department_id');

        $position = Position::find($id);
        $position->name = $name;
        $position->department_id = $department_id;
        $position->slug = Str::slug($name);
        $position->save();

        session()->flash('success', 'Position updated successfully');
        return redirect()->route('position.index');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        // Request params
        $id = $request->input('id');
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        $position->delete();

        return response()->json(['message' => 'Position deleted successfully']);
    }
}
