<?php

namespace System\Auth;
use App\User;
use System\Session\Session;

class Auth {

    private $redirectTo = "/login";

    private function userMethod(){

        $userId = Session::get('user');

        if (!$userId)
            return redirect($this->redirectTo);

        $user = User::find($userId);

        if (empty($user)){
            Session::remove('user');
            return redirect($this->redirectTo);
        }

        return $user;
    }

    private function checkMethod(){

        $userId = Session::get('user');

        if (!$userId)
            return redirect($this->redirectTo);

        $user = User::find($userId);

        if (empty($user)){
            Session::remove('user');
            return redirect($this->redirectTo);
        }

        return true;
    }

    private function checkLoginMethod(): bool {

        $userId = Session::get('user');

        if (!$userId)
            return false;

        $user = User::find($userId);

        if (empty($user))
            return false;

        return true;
    }

    private function loginByEmailMethod($email, $password): bool {

        $user = User::where('email', $email)->get();

        if (empty($user)){

            error('login', 'User does not exist');
            return false;
        }

        if (password_verify($password, $user[0]->password) && $user[0]->is_active == 1){

            Session::set('user', $user[0]->id);
            return true;
        }

        else{

            error('login', 'Incorrect information');
            return false;
        }

    }

    private function loginByIdMethod($id): bool {

        $user = User::find($id);

        if (empty($user)){

            error('login', 'User does not exist');
            return false;
        }

        else{

            Session::set('user', $user->id);
            return true;
        }
    }

    private function logoutMethod(){

        Session::remove('user');
    }

    public function __call($name, $arguments){

        return $this->methodCaller($name, $arguments);
    }

    public static function __callStatic($name, $arguments){

        $instance = new self();
        return $instance->methodCaller($name, $arguments);
    }

    private function methodCaller($method, $args){

       $suffix = "Method";
       $methodName = $method . $suffix;
       return call_user_func_array([$this, $methodName], $args);
   }

}