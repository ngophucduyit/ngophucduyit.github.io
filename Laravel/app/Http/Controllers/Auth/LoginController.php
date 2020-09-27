<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
// use App\Services\SocialAccountService;
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
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($social)
   {
       $userSocial = Socialite::driver($social)->user();
       $user = User::where(['username' => $userSocial->getId()])->first();
       // var_dump($userSocial);
       if($user){
           Auth::login($user);
           return redirect()->action('norController@index');
       }else{
          $newUser= new User;
          $newUser->displayName=$userSocial->getName();
          $newUser->username=$userSocial->getId();
          $newUser->avatar=$userSocial->getAvatar();
          $newUser->email = $userSocial->getEmail();
          $newUser->role = 'User';
          $newUser->viewed=[];
          $newUser->liked=[];
          $newUser->followed=[]; 
          $newUser->save();
          Auth::login($newUser);
           return redirect()->action('norController@index');
       }
   }
}
