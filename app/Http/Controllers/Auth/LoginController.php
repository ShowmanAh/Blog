<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Socialite;
use Auth;
use Exception;
use App\User;

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

    //Redirect the user to the social authentication page.
    public function redirectToSocial($social)
    {
        return Socialite::driver($social)->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // take access_token from social to handle it return callback with user data
    public function handleSocialCallback($social)
    {
        try {
            // get user token
            $user = Socialite::driver($social)->user();
            //dd($user);
            $log = new Logger('stderr');
            $stream = new StreamHandler('php://stderr', Logger::WARNING);
            $stream->setFormatter(new JsonFormatter());
            $log->pushHandler($stream);
            // add records to the log
            $log->warning('this is the user',['user'=>$user]);
            // $log->error($user);
            // check exist user in database
            $finduser = User::where('email', $user->getEmail())->first();
            if($finduser){
                // login if user exist and redirect to homepage
                Auth::login($finduser);
                return view('home');
            }else{
                // if not exist make create and login with new user  and redirect to homepage
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    //'github_id'=> $user->id,
                    'password' => encrypt('ahmed123456a')
                ]);
                Auth::login($newUser);
                return view('home');
            }
            // if take exception example after login make drop tables return this exception not user found
        } catch (Exception $e) {
            dd($e->getMessage() . "Not User Found");
        }
    }

}
