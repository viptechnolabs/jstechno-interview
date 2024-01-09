<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\Request;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\ResponseTrait;

class AttendanceController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $attendances = Attendance::all();
        return AttendanceResource::collection($attendances)
            ->additional([
                'message' => 'Attendance List',
                'status' => true
            ]);
    }

    public function details($id): AttendanceResource
    {
        $attendance = Attendance::find($id);

        return (new AttendanceResource($attendance))
            ->additional([
                'message' => 'Attendance Details',
                'status' => true
            ]);
    }

    public function store(Request $request)
    {
        // Request params
        $employee_id = $request->input('employee_id');
        $type = $request->input('type');

        $lastAttendance = Attendance::where('employee_id', $employee_id)
            ->orderBy('in_time', 'desc')
            ->first();

        if ($type === 'check_in') {

            if ($lastAttendance && $lastAttendance->out_time === null) {
                return $this->error(message: 'Please check out before checking in again.');
            }
            $attendance = new Attendance();
            $attendance->employee_id = $employee_id;
            $attendance->in_time = now();
            $attendance->save();

            return (new AttendanceResource($attendance))
                ->additional([
                    'message' => 'Attendance Check-in successfully',
                    'status' => true
                ]);

        } elseif ($type === 'check_out') {

            if (!$lastAttendance || $lastAttendance->in_time === null) {
                return $this->error(message: 'Please check in before checking out.');
            }

            if ($lastAttendance->out_time !== null) {
                return $this->error(message: 'Please check in before checking out.');
            }

            $lastAttendance->out_time = now();
            $lastAttendance->save();

            return (new AttendanceResource($lastAttendance))
                ->additional([
                    'message' => 'Attendance Check-out successfully',
                    'status' => true
                ]);
        }
    }

    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return $this->error(message: 'Attendance not found');
        }
        $attendance->delete();
        return $this->success(message: 'Attendance deleted successfully.');
    }
}
