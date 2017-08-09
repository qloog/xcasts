<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Mail\UserRegisteredActivation;
use App\Models\User;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Laracasts\Flash\Flash;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // see: https://laravel.com/docs/5.3/authentication#events
        event(new Registered($user = $this->create($request->all())));

        // todo: next all move to listener
        if ($user->is_activated == 1) {
            $this->guard()->login($user);
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * 注册之后的一些处理
     *
     * @param Request $request
     * @param         $user
     */
    protected function registered(Request $request, $user)
    {
        // send activation code
        $user = $user->toArray();
        $token = str_random(30);
        $user['token'] = $token;
        DB::table('user_activations')->insert(['user_id' => $user['id'], 'token'=> $token]);

        // todo: use mail class
        // see: https://scotch.io/tutorials/easy-and-fast-emails-with-laravel-5-3-mailables
        //      https://mattstauffer.co/blog/introducing-mailables-in-laravel-5-3
        //Mail::send('emails.activation', $user, function($message) use ($user) {
        //    $message->to($user['email']);
        //    $message->subject('PHPCasts - 帐号激活链接');
        //});
        Mail::to($user['email'])->send(new UserRegisteredActivation($user));

        Flash::success('已发送激活链接,请检查您的邮箱。');

        return redirect()->route('login');
    }
}