<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

        } catch (Exception $e) {

        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
