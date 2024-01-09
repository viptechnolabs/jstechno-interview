<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $attendances = Attendance::all();
        return view('attendance.index', compact('attendances'));
    }

    public function add(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $employees = Employee::all();
        return view('attendance.add', compact('employees'));
    }

    public function store(AttendanceRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $employee_id = $request->input('employee_id');
        $type = $request->input('type');

        $lastAttendance = Attendance::where('employee_id', $employee_id)
            ->orderBy('in_time', 'desc')
            ->first();

        if ($type === 'check_in') {

            if ($lastAttendance && $lastAttendance->out_time === null) {
                session()->flash('error', 'Please check out before checking in again.');
                return redirect()->back();
            }
            $attendance = new Attendance();
            $attendance->employee_id = $employee_id;
            $attendance->in_time = now();
            $attendance->save();

            session()->flash('success', 'Attendance Check-in successfully');
            return redirect()->route('attendance.index');

        } elseif ($type === 'check_out') {

            if (!$lastAttendance || $lastAttendance->in_time === null) {
                session()->flash('error', 'Please check in before checking out.');
                return redirect()->back();
            }

            if ($lastAttendance->out_time !== null) {
                session()->flash('error', 'Please check in before checking out.');
                return redirect()->back();
            }

            $lastAttendance->out_time = now();
            $lastAttendance->save();

            session()->flash('success', 'Attendance Check-out successfully');
            return redirect()->route('attendance.index');
        }
        session()->flash('error', 'Invalid request.');
        return redirect()->back();
    }
}
