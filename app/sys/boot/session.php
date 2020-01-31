<?php

session_name('session_id');

session_start();

$session = [];

if( Session::exists('auth') ){

    $nickname = Session::get('nickname');

    $channel = Session::get('channel');

    $session['channel'] = APP . "sys/dev/{$channel}.channel";

    $session['user'] = APP . "sys/etc/passwd/{$channel}/{$nickname}.user";

    $session['passwd'] = APP . "sys/etc/passwd/{$channel}/";

    $session['log'] = APP . "log/{$channel}.{$nickname}.log";
      
    $user_ip = getVisitorIP();

    $date = getTimestamp();
      
    $data = '';
}
