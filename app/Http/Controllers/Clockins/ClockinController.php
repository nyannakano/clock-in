<?php

namespace App\Http\Controllers\Clockins;

use App\Http\Controllers\Controller;
use App\Services\Clockins\ClockinService;

class ClockinController extends Controller
{
    protected ClockinService $clockinService;

    public function __construct()
    {
        $this->clockinService = new ClockinService();
    }
}
