<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function create_login()
    {
        return view('auth.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    function verify_input($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    public function login_user(Request $req)
    {
        $email = self::verify_input($req->input('email'));
        $password = self::verify_input($req->input('password'));

        $req->validate([
            'email' =>'required|email',
            'password' =>'required|min:8',
        ]);
        $infos_user = DB::table('users')
            ->where('EMAIL', $email)
            ->where('ETAT_USER', 1)
            ->first();
        if ($infos_user) {
            if (Hash::check($password, $infos_user->PASSWORD)) {
                session_start();
                session::put('id_user', $infos_user->ID_USER);
                return redirect('/');
            } else {
                return back()->with('error', 'Email ou mot de passe incorrect ');
            }
        } else {
            return back()->with('error', 'Email ou mot de passe incorrect');
        }
    }


    public function logout(Request $req)
    {
        if ($req->session()->forget('id_user')) {
            return redirect('login');
        } else {
            return back();
        }
    }
}
