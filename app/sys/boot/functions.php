<?php

function setColor() {

    $color = randColor();

    return "style='color: {$color};'";
}

function randColor() {

    $color = substr(md5(rand()), 0, 6);

    if($color == '000000') {

        randColor();

    } else {

        return "#{$color}";
    }
}

function logger($text, $path) {
    error_log(getTimestamp() . ' | ' . getVisitorIP() . ' - ' . $text . PHP_EOL, 3, $path);
}

function getTimestamp($full_date = true) {
    if($full_date) {
        return date('Y-m-d H:i:s');
    } else {
        return date('H:i');
    }
}

function filterInput($input, $lowercase = false) {

    if($lowercase) {
        return strtolower(  stripslashes( htmlspecialchars($input) ) );
    }

    return stripslashes( htmlspecialchars($input) );
}


function rrmdir($directory, $delete = false)
{
    $contents = glob($directory . '*');
    foreach($contents as $item)
    {
        if (is_dir($item))
            rrmdir($item . '/', true);
        else
            unlink($item);
    }
    if ($delete === true)
        rmdir($directory);
}


function getVisitorIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function lastVisit() {
 
    $inTwoMonths = 60 * 60 * 24 * 60 + time();
    return setcookie('session_visit', date("H:i - m/d/y"), $inTwoMonths);
}

function checkBlacklist($ip, $storage, $save = false) {

    $data = json_decode( file_get_contents($storage), true );

    if( empty($data) ) {
        $data = array();
    }

    if($save) {

        array_push($data, $ip);
        file_put_contents( $storage, json_encode($data) );
        unset($data);
        return true;

    } elseif( in_array($ip, $data) ) {

        unset($data);
        return true;
    }

    unset($data);

    return false;

}

// Commands
function cmdScan($dir)
{
    return array_values(array_diff(scandir($dir), array('..', '.')));
}

function cmdJOIN($input, $storage = '') {

    $connection = [];

    if( preg_match('/join/', $input) ) {


                $input = explode(' ', $input);

                if(count($input) == 1) {

                    return false;
                }

                if( !preg_match('/#/', $input[1]) ) {

                    return false;
                }       
                                
               /**
                * 0 = CMD
                * 1 = #channel
                * 2 = nickname@password
                * 3 = key
                */

                if(count($input) == 3) {

                    $connection['channel'] = $input[1];
                    $connection['nickname'] = explode('@', $input[2])[0];
                    $connection['password'] = explode('@', $input[2])[1];
                    $connection['key'] = false;
                }

                if(count($input) == 4) {

                    $connection['channel'] = $input[1];
                    $connection['nickname'] = explode('@', $input[2])[0];
                    $connection['password'] = explode('@', $input[2])[1];                  
                    $connection['key'] = md5($input[3]);

                }

                if( !isset($connection['nickname']) ||  !isset($connection['channel']) ) {

                    return false;
                }

        $connection['id'] = uniqid();

        $connection['ip'] = getVisitorIP();

        foreach($connection as $key => $value) {
            Session::put($key, $value);
        }
        
        return $connection;  
                
     }

     return false;

}


function dd($var) {
    var_dump($var);
    die;
}