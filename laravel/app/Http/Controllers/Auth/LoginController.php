<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\SocialAccount;


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
        // $this->middleware('guest')->except('logout');
        if(auth()->check()) return redirect()->to('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/login');
      }

    /**
    * Login for developer
    */
    public function loginDeveloper($id){
        auth()->logout();
        $user = User::findOrFail($id);
        if ($user->is_suspended!=1){
            auth()->login($user);
            return redirect('/');
        }
    }


    /**
     * Social Login
     */
    public function redirectToProvider($provider = 'facebook')
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider = 'facebook')
    {
        $providerUser = Socialite::driver($provider)->user();
        $user = $this->createOrGetUser($provider, $providerUser);
        if ($user->is_suspended!=1){
            auth()->login($user);
            if($user->role == NULL) return redirect()->to('/user-role');
            else return redirect()->to('/');
        }
    }

    public function createOrGetUser($provider, $providerUser)
    {
        /** Get Social Account */
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            /** Get user detail */
            $userDetail = Socialite::driver($provider)->userFromToken($providerUser->token);

            /** Create new account */
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);

            /** Get email or not */
            $email = !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getId() . '@' . $provider . '.com';

            /** Get User Auth */
            if (auth()->check()) {
                $user = auth()->user();
            }else{
                $user = User::whereEmail($email)->first();
            }

            if (!$user) {

                /** Create User */
                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'nickname' => explode(" ", $providerUser->getName())[0],
                    'image' => $providerUser->getAvatar(),
                    'password' => bcrypt(rand(1000, 9999)),
                ]);

            }

            /** Attach User & Social Account */
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
