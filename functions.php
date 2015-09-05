<?php

    function send_data($name, $data) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[$name] = $data;
    }

    function get_data($name) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return null;
        }
    }

    function trim_text($input, $length, $ellipses = true, $strip_html = true) {
        if ($strip_html === true) {
            $input = strip_tags($input);
        }

        if (strlen($input) <= $length) {
            return $input;
        }

        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        if ($ellipses === true) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }

    function is_multiArray($arr) {
        $rv = array_filter($arr,'is_array');
        return (count($rv)>0) ? true : false;
    }

    function get_ip(){
        if(function_exists('apache_request_headers')){
            $headers = apache_request_headers();
        } else{
            $headers = $_SERVER;
        }

        if(array_key_exists('X-Forwarded-For', $headers) &&
                filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            $the_ip = $headers['X-Forwarded-For'];
        } elseif(array_key_exists('HTTP_X_FORWARDED_FOR', $headers) &&
                filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
        } else{
            $the_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        }

        return $the_ip;
    }

    function createCSV($data, $filename = null){
        if(!isset($filename)){
            $filename = "replies";
        }

        //Clear output buffer
        ob_clean();

        //Set the Content-Type and Content-Disposition headers.
        header("Content-type: text/x-csv");
        header("Content-Transfer-Encoding: binary");
        header("Content-Disposition: attachment; filename={$filename}-".date('YmdHis',strtotime('now')).".csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        //Open up a PHP output stream using the function fopen.
        $fp = fopen('php://output', 'w');

        //Loop through the array containing our CSV data.
        foreach ($data as $row) {
            //fputcsv formats the array into a CSV format.
            //It then writes the result to our output stream.
            fputcsv($fp, $row);
        }

        //Close the file handle.
        fclose($fp);
    }