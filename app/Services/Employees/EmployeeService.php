<?php

namespace App\Services\Employees;

use App\Models\Employee;
use App\Models\Group;
use App\Models\User;

class EmployeeService
{
    public function registerEmployee($user_id, $data)
    {
        try {
            $group = Group::where('name', 'default')->first();

            $employee = Employee::create([
                'name' => $data['name'],
                'user_id' => $user_id,
                'group_id' => $group->id,
                'internal_id' => $data['internal_id'],
                'avatar' => $data['avatar'] ?? null,
                'born_at' => $data['born_at'] ?? null,
            ]);

            return ([
                'message' => 'Employee registered successfully',
                'employee' => $employee,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return ([
                'message' => 'Employee registration failed',
                'error' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}
