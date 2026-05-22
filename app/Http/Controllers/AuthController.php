<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Logout the user
     */
    public function logout(): View|RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return view('filament.pages.logout');
    }
}
