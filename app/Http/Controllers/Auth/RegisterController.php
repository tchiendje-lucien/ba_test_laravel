<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create_register()
    {
        return view('auth.register');
    }

    function verify_input($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    public function create_user(Request $req)
    {
        $full_name = self::verify_input($req->input('full_name'));
        $email = self::verify_input($req->input('email'));
        $re_password = self::verify_input($req->input('re_password'));
        $password = self::verify_input($req->input('password'));
        $photo_admin = "UserPhote.png";
        $PASSWORD_REGEX = '/^(?=.*\d).{4,20}$/';
        $PHONE_REGEX = '/(\+237|237)\s(6|2)(2|3|[5-9])[0-9]{7}/';
        $EMAIL_REGEX = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        $req->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6|required_with:re_password|same:re_password',
            're_password' => 'required|string|min:6',
        ]);

        if (!preg_match($EMAIL_REGEX, $email)) {
            return back()->with('error', 'Cette adresse email est invalide');
        }
        if (!preg_match($PASSWORD_REGEX, $password)) {
            return back()->with('error', 'mot de passe invalide (doit être de 4 à 20 carractere et inclure au moins 1 chiffre et un symbole');
        }
        $select_user_name = DB::table('users')
            ->where('FULL_NAME', $full_name)
            ->get();
        if ($select_user_name->count() > 0) {
            return back()->with('user_error', 'Ce nom est deja utilisé');
        } else {
            $select_user_email = DB::table('users')
                ->where('EMAIL', $email)
                ->get();
            if ($select_user_email->count() > 0) {
                return back()->with('user_error', 'Cette adresse email est deja utilisé');
            } else {
                $insert_user = DB::table('users')->insert(
                    [
                        "EMAIL" => $email,
                        "PASSWORD" => Hash::make($password),
                        "FULL_NAME" => $full_name,
                        "ETAT_USER" => 1,
                        "PHOTO_USER" => $photo_admin,
                        "DATE_CREATE" => Carbon::now(),
                        "DATE_UPDATE" => Carbon::now(),
                    ]
                );
                if ($insert_user) {
                    return redirect("login");
                } else {
                    return back()->with('error', "Une erreur c'est produite lors de la creation de compte !!! veillez reesayer");
                }
                //Mail::to('luciendidier237@gmail.com')->send(new adminMail($data));
            }
        }
    }
}
