<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        $date = date("Y-m-d");
        $update = User::find($user->id);

        if ($user->verif === 'unverified') {
            Auth::logout();
            return redirect()->back()->with('unverified', 'Failed Login, User Unverified');
        }
        if ($user->role == 'admin') {
            $update->update([
                'terakhir_login' => $date
            ]);

            return redirect()->route('admin.dashboard');
        }
        $update->update([
            'terakhir_login' => $date
        ]);
        return redirect()->route('user.dashboard');
    }
}
