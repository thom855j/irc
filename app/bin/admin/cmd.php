<?php

if($input == 'sudo clear') {

        $data = '';

        $input = "<i>session cleared by {$username}.</i>";
  
        $username = 'system';
}

if($input == 'sudo clear system') {

  $data = preg_replace("/<div user='system' [^>]*>.*?<\/div>/i", '', $data);
      
  $data = $dec->encrypt($data);

  file_put_contents($session['host'], $data);

  $data = false;
}


if($input == 'scan') {

    $hosts = cmdScan(APP . '/sys/dev/');

    $input = '<br><br>';

    foreach ($hosts as $host) {
      $input .= $host . "<br>";
      $input = str_replace('.dec', '', $input);
    }
}
