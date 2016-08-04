<?php

/*
----------------------
AuditoriaException
-----------------------
Description:
this class is a pattern for all exceptions messages that can be occured.
 */

namespace MT4;

class AuditoriaException extends \Exception
{

    public function errorMessage()
    {

        $STRING = "<div style='background:red; font-family:arial; color:white; padding:10px; font-size:15px; font-weight:100;'>";
        $STRING .= "<div style='text-decoration:underline; padding-bottom:10px'>MT4 Exception</div>";
        $STRING .= parent::getMessage();
        $STRING .= "</div>";

        echo $STRING;
    }
}
