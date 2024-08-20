<?php

namespace App\Services\Employees;

use App\Repositories\EmployeeRepository;
use App\Repositories\GroupRepository;

class EmployeeService
{
    public function registerEmployee($user_id, $data)
    {
        try {
            $group = GroupRepository::findByName('default');

            $employee = EmployeeRepository::create([
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
