<?php

    $dec = new Encryptor(Session::get('key'));

    $input = filterInput(Request::get('input'));

    $nickname = Session::get('nickname');


    $data = $dec->decrypt(file_get_contents($session['channel']));

    // Special commands
    if($nickname == 'admin' || $nickname == 'root') {
    
        require_once APP . 'bin/admin/cmd.php';

    }

    require_once APP . 'bin/user/cmd.php';

    if($data !== false) {

        $color = Session::get('color');

        $data .= "<div user='{$nickname}' $color class='response'>[".getTimestamp(false)."] <b>@".$nickname."</b> ". $input ."<br></div>" . PHP_EOL;
  
        $data = $dec->encrypt($data);

        file_put_contents($session['channel'], $data);

        unset($data);

    }