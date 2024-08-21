<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Services\Employees\EmployeeService;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }
}
