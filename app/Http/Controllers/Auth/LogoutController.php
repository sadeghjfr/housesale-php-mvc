<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\MailService;
use App\User;
use System\Auth\Auth;
use System\Session\Session;

class LogoutController{

    private $redirectTo = "/login";

    public function logout()
    {

        Auth::logout();
        redirect($this->redirectTo);
    }


}
