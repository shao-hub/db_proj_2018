<?php
/**
 * Created by PhpStorm.
 * User: syhaung
 * Date: 5/9/18
 * Time: 9:39 AM
 */

class Auth
{
    static  function isLogin()
    {
        return isset($_SESSION['user_id']);
    }

    static function isAdmin()
    {
        return isset($_SESSION['is_admin']);
    }

    static function getUserName()
    {
        return $_SESSION['user_name'];
    }

    static function getUserId()
    {
        return $_SESSION['user_id'];
    }

    static function setSession($user_id,$user_name,$is_admin)
    {
        $_SESSION['user_id']="$user_id";
        $_SESSION['user_name']="$user_name";

        if(!is_null($is_admin))
            $_SESSION['is_admin']=1;

    }

    static function logout()
    {
        session_unset();
    }
}