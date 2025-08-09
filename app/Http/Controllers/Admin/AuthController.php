<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService , private UserRepository $userRepository)
    {
    }
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->identifier)
            ?? $this->userRepository->findByMobile($request->identifier);

        if (!$user || !Hash::check($request->password, $user->password)|| !$user->isAdmin()) {
            flash()->error('Email or password is incorrect!');
            return back()->withInput();
        }
        Auth()->login($user);
        return to_route('home');
    }

    public function logout(Request $request)
    {
        Auth()->logout();
        return to_route('login');
    }

}
