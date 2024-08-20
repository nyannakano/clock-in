<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Employees\EmployeeService;
use Illuminate\Support\Facades\DB;

class AuthenticationService
{
    public function login($data): array
    {
        $credentials = $data->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('api-token')->plainTextToken;

            return ([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'status' => 'success'
            ]);
        }

        return ([
            'message' => 'Invalid credentials',
            'status' => 'error'
        ]);
    }

    public function register($request): array
    {
        DB::beginTransaction();

        try {
            $user = UserRepository::create([
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $employeeService = new EmployeeService();

            $employee_response = $employeeService->registerEmployee($user->id, $request->all());

            if ($employee_response['status'] === 'error') {
                DB::rollBack();

                return ([
                    'message' => 'Registration failed',
                    'status' => 'error',
                    'error' => $employee_response['error']
                ]);
            }

            if (!$employee_response['employee']) {
                DB::rollBack();

                return ([
                    'message' => 'Registration failed',
                    'status' => 'error',
                    'error' => $employee_response['error']
                ]);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            $this->generatePin($user->email);

            DB::commit();

            return ([
                'user' => $user,
                'token' => $token,
                'message' => 'Registration successful',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return ([
                'message' => 'Registration failed',
                'status' => 'error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout(): array
    {
        try {
            $user = auth()->user();

            $user->tokens()->delete();

            return ([
                'message' => 'Logged out',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            return ([
                'message' => 'An error occurred',
                'status' => 'error',
                'error' => '' . $e
            ]);
        }
    }

    public function verifyEmail($data)
    {
        try {
            $user = auth()->user();

            if ($user->email_verified_at) {
                return ([
                    'message' => 'Email already verified',
                    'status' => 'error',
                    'error' => 'Email already verified'
                ]);
            }

            if ($data->pin !== DB::table('password_reset_tokens')
                    ->where('email', $user->email)
                    ->first()->token) {
                return ([
                    'message' => 'Invalid pin',
                    'status' => 'error',
                    'error' => 'Invalid pin'
                ]);
            }

            $user->email_verified_at = now();
            $user->save();

            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->delete();

            return ([
                'message' => 'Email verified',
                'status' => 'success',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return ([
                'message' => 'An error occurred',
                'status' => 'error',
                'error' => '' . $e
            ]);
        }
    }

    public function forgotPassword($data)
    {
        $user = UserRepository::findByEmail($data->email);

        if (!$user) {
            return ([
                'message' => 'User not found',
                'status' => 'error',
                'error' => 'User not found'
            ]);
        }

        $this->generatePin($user->email);

        return ([
            'message' => 'Pin generated and sent to email',
            'status' => 'success'
        ]);
    }

    public function resetPassword($data): array
    {
        try {
            $user = UserRepository::findByEmail($data->email);
            DB::beginTransaction();

            if (!$user) {
                return ([
                    'message' => 'User not found',
                    'status' => 'error',
                    'error' => 'User not found'
                ]);
            }

            if (!DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->exists()) {
                return ([
                    'message' => 'Pin not generated',
                    'status' => 'error',
                    'error' => 'Pin not generated'
                ]);
            }

            if ($data->pin !== DB::table('password_reset_tokens')
                    ->where('email', $user->email)
                    ->first()->token) {
                return ([
                    'message' => 'Invalid pin',
                    'status' => 'error',
                    'error' => 'Invalid pin'
                ]);
            }

            $user->password = bcrypt($data->password);
            $user->save();

            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->delete();

            \Auth::login($user);

            DB::commit();

            return ([
                'message' => 'Password reset successful',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return ([
                'message' => 'An error occurred',
                'status' => 'error',
                'error' => '' . $e
            ]);
        }
    }

    public function generatePin($email)
    {
        $pin = rand(1000, 9999);

        if (DB::table('password_reset_tokens')
            ->where('email', $email)
            ->exists()) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->update(['token' => $pin]);

            return;
        }

        DB::table('password_reset_tokens')
            ->insert(
                [
                    'email' => $email,
                    'token' => $pin
                ]);

    }
}
