<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\MailService;
use App\User;
use System\Auth\Auth;
use System\Session\Session;

class ForgotController{

    private $redirectTo = "/login";

    public function view() {

        return view("auth.forgot");
    }

    public function forgot()
    {
        if(Session::get('forgot.time') && Session::get('forgot.time') > time())
        {
            error('forgot', 'please wait 30 sec and try again');
            back();
        }

        else
        {
            Session::set('forgot.time', time() + 30);

            $request = new ForgotRequest();
            $inputs = $request->all();
            $user = User::where('email', $inputs['email'])->get();
            if(empty($user))
            {
                error('forgot', 'کاربر وجود ندارد');
                back();
            }
            $user = $user[0];
            $user->remember_token = generateToken();
            $user->remember_token_expire = date("Y-m-d H:i:s", strtotime(' + 10 min'));
            $user->save();
            $message = '
            <h2>ایمیل بازیابی رمز عبور </h2>
            <p>کاربر گرامی برای بازیابی رمز عبور خود از لینک زیر استفاده نمایید/p>
            <p style="text-align: center">
            <a href="'.route('auth.reset-password.view', [$user->remember_token]).'">بازیابی رمز عبور</a>
            </p>
            ';
            $mailService = new MailService();
            $mailService->send($inputs['email'], 'ایمیل بازیابی رمز عبور', $message);
            flash('forgot', 'ایمیل بازیابی با موفقیت ارسال شد');
            redirect($this->redirectTo);
        }
    }


}
