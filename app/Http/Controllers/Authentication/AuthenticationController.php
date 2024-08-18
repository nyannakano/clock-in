<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Requests\ForgotPasswordRequest;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use App\Requests\ResetPasswordRequest;
use App\Requests\VerifyEmailRequest;
use App\Services\Authentication\AuthenticationService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private AuthenticationService $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request);

        return response()->json($response, $response['status'] === 'error' ? 401 : 200);
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request);

        return response()->json($response, $response['status'] === 'error' ? 400 : 201);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        return response()->json($response, $response['status'] === 'error' ? 401 : 200);
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $response = $this->authService->verifyEmail($request);

        return response()->json($response, $response['status'] === 'error' ? 400 : 200);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $response = $this->authService->forgotPassword($request);

        return response()->json($response, $response['status'] === 'error' ? 400 : 200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $response = $this->authService->resetPassword($request);

        return response()->json($response, $response['status'] === 'error' ? 400 : 200);
    }
}
