<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getConfirmation','logout']]);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);

        $user->role                 = 'user';
        $user->registration_token   = str_random(40);
        $user->save();

        $url = route('confirmation',['token'=>$user->registration_token]);


        Mail::send('auth.emails.registration', compact('user', 'url'), function($m) use ($user){
            $m->to($user->email, $user->name)->subject('Activa tu cuenta');
        });

        return $user;
    }

    public function getCredentials(Request $request)
    {
        /*
            * en vez de email puede ser username, depende como se quiera, pero
            * es necesario tenerlo en la BD, formularios, migraciones, seeder etc etc
        */
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            # registration_token se comenta, ya que permitiremos el login, 
            # pero restringiremos su verificacion a ciertas rutas
            #'registration_token' => null,
            'active'   => true
        ];
    }

    public function getConfirmation($token){

        $user = User::where('registration_token', $token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        return redirect()->route('home')->with('alert', 'Email confirmado !');

    }



    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        return redirect('login')->with('alert', 'Por favor, confirma tu Email ');

    }



}
