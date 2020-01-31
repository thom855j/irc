<?php

if($input == '/channel clear') {

        $data = '';

        $input = "<i>channel cleared by @{$nickname}.</i>";
  
        $username = 'system';
}

if($input == '/system clear') {

  $data = preg_replace("/<div user='system' [^>]*>.*?<\/div>/i", '', $data);
      
  $data = $dec->encrypt($data);

  file_put_contents($session['channel'], $data);

  $data = false;
}

