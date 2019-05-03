<?php

    $dec = new Encryptor(session()['key']);

    $input = filterInput($_POST['input']);

    $username = session()['username'];


    $data = $dec->decrypt(file_get_contents($session['host']));

    // Special commands
    if($username == 'admin' || $username == 'root') {
    
        require_once APP . 'bin/admin/cmd.php';

    }

    require_once APP . 'bin/user/cmd.php';

    if($data !== false) {

        $color = session()['color'];

        $data .= "<div user='{$username}' $color class='response'>[".getTimestamp(false)."] <<b>".$username."</b>> ". $input ."<br></div>" . PHP_EOL;
  
        $data = $dec->encrypt($data);

        file_put_contents($session['host'], $data);

        unset($data);

    }