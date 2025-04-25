<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // display login form
    public function login(): View {
        return view(
            'auth.login', 
            [
                'title' => 'Pieslēgties'
            ]
        );
    }

    // authentificate user
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // pāradresācijas url, vēlāk nomainīsim uz /bands
            return redirect('/members');
        }

        return back()->withErrors([
            'name' => 'Autentifikācija neveiksmīga',
        ]);
    }
    
    // end user session
    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    } 
}
