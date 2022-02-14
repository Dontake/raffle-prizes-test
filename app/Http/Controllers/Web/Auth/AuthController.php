<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * @var AuthInterface
     */
    protected AuthInterface $authService;

    /**
     * @param AuthInterface $authService
     */
    public function __construct(AuthInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return string
     */
    public function login(LoginRequest $request): string
    {
        if ($this->authService->login($request->getEmail(), $request->getUserPassword())) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Wrong email or password.'
        ]);
    }

    /**
     * Logout user
     *
     * @param LoginRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(LoginRequest $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
