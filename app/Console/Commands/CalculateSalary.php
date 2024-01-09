<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\SalaryCalculation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateSalary extends Command
{
    protected $signature = 'salary:calculate';

    protected $description = 'Automatically calculate salaries on the first date of every month';

    public function handle()
    {
        $currentMonth = now()->startOfMonth();
        $calculationExists = SalaryCalculation::where('calculation_date', $currentMonth)->exists();

        if (!$calculationExists) {

            $employees = Employee::all();

            foreach ($employees as $employee) {
                $previousMonthAttendance = Attendance::where('employee_id', $employee->id)
                    ->whereBetween('in_time', [$currentMonth->copy()->subMonth(), $currentMonth->copy()->subSecond()])
                    ->get();

                $calculatedSalary = $this->calculateSalary($previousMonthAttendance, $employee);

                $salaryCalculation = new SalaryCalculation();
                $salaryCalculation->employee_id = $employee->id;
                $salaryCalculation->calculation_date = $currentMonth->copy()->subMonth();
                $salaryCalculation->gross_salary = $calculatedSalary;
                $salaryCalculation->status = 'Completed';
                $salaryCalculation->save();
            }

            $this->info('Salary calculation for ' . $currentMonth->format('F Y') . ' completed.');
        } else {
            $this->info('Salary calculation for ' . $currentMonth->format('F Y') . ' already completed.');
        }
    }

    private function calculateSalary($attendanceRecords, $employee): float|int
    {
        $totalHoursWorked = 0;
        foreach ($attendanceRecords as $attendance) {
            $inTime = Carbon::parse($attendance->in_time);
            $outTime = Carbon::parse($attendance->out_time);

            $hoursWorked = $outTime->diffInHours($inTime);
            $totalHoursWorked += $hoursWorked;

        }

        $salaryObj = $employee->position->salary;
        $grossSalary = $salaryObj->basic_salary + $salaryObj->hra + $salaryObj->da + $salaryObj->other_allowances;
        $perHourSalary = $grossSalary / $totalHoursWorked;

        $calculatedSalary = $totalHoursWorked * $perHourSalary;

        return $calculatedSalary;
    }
}
