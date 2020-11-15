<?php

namespace App\Http\Controllers\RepresentanteAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:representante');
    }

    public function guard()
    {
        return Auth::guard('representante');
    }

    public function broker()
    {
        return Password::broker('representantes');
    }
   
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.representante.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
