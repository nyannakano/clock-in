<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository extends AbstractRepository
{
    protected static $model = Employee::class;
}
