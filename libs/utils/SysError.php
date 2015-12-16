<?php

class SysError {
    public static function user($msg, $username) {
        $date = date('d.m.Y h:i:s');
        $log = $msg."   |  Date:  ".$date."  |  User:  ".$username."\n";
        if(DEBUG !== True){
            error_log($log, 3, USER_ERROR_DIR);
            error_log($log, 1, ADMIN, "Subject: Check the errors\nFrom: Rizzlas@my.domain\n");
        }
    }

    public static function general($msg) {
        $date = date('d.m.Y h:i:s');
        $log = $msg."   |  Date:  ".$date."\n";
        if(DEBUG === True){
            trigger_error($msg);
        } else {
            error_log($log, 3, GENERAL_ERROR_DIR);
        }
    }

}