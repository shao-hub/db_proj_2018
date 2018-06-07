<?php
/**
 * Created by PhpStorm.
 * User: syhaung
 * Date: 5/25/18
 * Time: 2:18 AM
 */
class Msg
{
    static function SetMsg($new_msg)
    {
        $_SESSION['msg']=$new_msg;
    }

    static function ChkMsgExist()
    {
        return isset($_SESSION['msg']);
    }

    static function GetMsg()
    {
        return $_SESSION['msg'];
    }

    static function GetandClrMsg()
    {
        $msg=$_SESSION['msg'];
        unset($_SESSION['msg']);
        return $msg;
    }

}