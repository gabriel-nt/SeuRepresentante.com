<?php
namespace App\Http\Controllers\ComercianteAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest:comerciante');
    }

    public function guard()
    {
        return Auth::guard('comerciante');
    }

    public function broker()
    {
        return Password::broker('comerciantes');
    }
   
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.comerciante.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}