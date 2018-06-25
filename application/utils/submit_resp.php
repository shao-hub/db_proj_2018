<?php
/**
 * Created by PhpStorm.
 * User: syhaung
 * Date: 6/24/18
 * Time: 3:40 AM
 */

class submit_resp
{
    static function valid($msg)
    {
        $obj=new stdClass();
        $obj->valid="true";
        $obj->msg=$msg;
        $JSON=json_encode($obj);
        return $JSON;
    }

    static function invalid($msg)
    {
        $obj=new stdClass();
        $obj->valid="false";
        $obj->msg=$msg;
        $JSON=json_encode($obj);
        return $JSON;
    }

}