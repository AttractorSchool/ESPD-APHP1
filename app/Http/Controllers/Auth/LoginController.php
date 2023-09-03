<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        return view('auth.login', compact('isMobile'));
    }
}
