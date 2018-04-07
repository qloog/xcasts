<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Lang;
use Laracasts\Flash\Flash;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::getUser();
            if($user->is_activated == 0) {
                $this->logout($request);
                Flash::warning('您的帐号还未激活, 请激活后才试。');
                return back();
            }

            //modify last_login_time and last_login_ip
            $user->last_login_time = date('Y-m-d H:i:s');
            $user->last_login_ip = $request->getClientIp();
            $user->save();

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }

    /**
     * Check for user Activation Code
     *
     * @param $token
     * @return User
     */
    public function userActivation($token)
    {
        $check = DB::table('user_activations')->where('token',$token)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_activated == 1){
                Flash::success('您的帐号已经激活');
                return redirect()->to('login');
            }

            $user->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token',$token)->delete();

            Flash::success('帐号已激活成功, 现在可以登录啦~');
            return redirect()->to('login');
        }

        Flash::warning('无效的激活链接');
        return redirect()->to('login');
    }

    /**
     * 跳转到oauth授权服务方
     *
     * @param $driver
     * @return mixed
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * 授权成功后执行的回调地址
     *
     * @param Request $request
     * @param         $driver
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback(Request $request, $driver)
    {
        try {
            $user = Socialite::driver("{$driver}")->user();
        } catch (\Exception $e) {
            return redirect()->to("login/oauth/{$driver}");
        }

        switch($driver) {
            case 'github':
                $userInstance = $this->findOrCreateUser($request, $user);
                Auth::login($userInstance, true);
                break;
            case 'wechat':
                break;
        }

        return redirect('/');
    }

    /**
     * @param $request
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser(Request $request, $githubUser)
    {
        $request->setTrustedProxies(['127.0.0.1', '192.168.31.245','10.27.243.59']);

        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            $authUser->last_login_time = Carbon::now();
            $authUser->last_login_ip = $request->getClientIp();
            $authUser->save();

            return $authUser;
        }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'avatar' => $githubUser->avatar,
            'last_login_time' => Carbon::now(),
            'last_login_ip' => $request->getClientIp(),
            'is_activated' => 1
        ]);
    }

}