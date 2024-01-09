<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Department;
use App\Models\Position;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $positions = Position::all();
        return PositionResource::collection($positions)
            ->additional([
                'message' => 'Position List',
                'status' => true
            ]);
    }

    public function details($slug): PositionResource
    {
        $position = Position::where('slug', $slug)->first();

        return (new PositionResource($position))
            ->additional([
                'message' => 'Position Details',
                'status' => true
            ]);
    }

    public function store(Request $request)
    {
        // Request params
        $name = $request->input('name');
        $department_id = $request->input('department_id');

        $position = new Position();
        $position->name = $name;
        $position->department_id = $department_id;
        $position->slug = Str::slug($name);
        $position->save();

        return (new PositionResource($position))
            ->additional([
                'message' => 'Position added successfully',
                'status' => true
            ]);
    }

    public function update(Request $request)
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

        return (new PositionResource($position))
            ->additional([
                'message' => 'Position updated successfully',
                'status' => true
            ]);
    }

    public function delete(Request $request, $id)
    {
        $position = Position::find($id);
        if (!$position) {
            return $this->error(message: 'Position not found');
        }
        $position->delete();
        return $this->success(message: 'Position deleted successfully.');
    }
}
