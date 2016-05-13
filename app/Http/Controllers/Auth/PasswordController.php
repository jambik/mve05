<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after password reset.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $subject = 'Сброс пароля';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        view()->composer('auth.emails.password', function($view) {
            $data = config('beautymail.view');
            $data['logo']['path'] = str_replace('%PUBLIC%', \Request::getSchemeAndHttpHost(), $data['logo']['path']);
            $view->with($data);
        });
    }
}
