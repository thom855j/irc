<?php

session_save_path(APP . 'sys/tmp'); 

session_name('session_id');

session_start();

$session = [];

if( session()['auth'] ){

	$username = session()['username'];

    $host = session()['host'];

    $session['host'] = APP . "sys/dev/{$host}.dec";

    $session['user'] = APP . "sys/etc/passwd/{$host}/{$username}.dec";

    $session['passwd'] = APP . "sys/etc/passwd/{$host}/";

    $session['storage'] = APP . "home/{$host}/{$username}/";

    $session['log'] = APP . "log/{$host}.{$username}";

    $user_ip = getVisitorIP();

    $date = getTimestamp();
      
    $data = '';
}
