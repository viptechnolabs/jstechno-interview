<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\Request;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $departments = Department::all();
        return DepartmentResource::collection($departments)
            ->additional([
                'message' => 'Department List',
                'status' => true
            ]);
    }

    public function details($slug): DepartmentResource
    {
        $department = Department::where('slug', $slug)->first();

        return (new DepartmentResource($department))
        ->additional([
            'message' => 'Department Details',
            'status' => true
        ]);
    }

    public function store(Request $request): DepartmentResource
    {
        // Request params
        $name = $request->input('name');

        $department = new Department();
        $department->name = $name;
        $department->slug = Str::slug($name);
        $department->save();

        return (new DepartmentResource($department))
            ->additional([
                'message' => 'Department added successfully',
                'status' => true
            ]);
    }

    public function update(Request $request): DepartmentResource
    {
        // Request params
        $id = $request->input('id');
        $name = $request->input('name');

        $department = Department::find($id);
        $department->name = $name;
        $department->slug = Str::slug($name);
        $department->save();

        return (new DepartmentResource($department))
            ->additional([
                'message' => 'Department updated successfully',
                'status' => true
            ]);
    }

    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $department = Department::find($id);
        if (!$department) {
            return $this->error(message: 'Department not found');
        }
        $department->delete();
        return $this->success(message: 'Department deleted successfully.');
    }
}
