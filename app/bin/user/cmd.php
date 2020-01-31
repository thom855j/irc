<?php

if($input == '/clear') {

	$data = preg_replace("/<div user='{$nickname}' [^>]*>.*?<\/div>/i", '', $data);
      
    $data = $dec->encrypt($data);

    file_put_contents($session['channel'], $data);

    $data = false;
}


if($input == '/help') {

	    $username = 'system';

        $input = '<br>/clear - clear your comments.<br>';

        $input .= '<br>/quit - leave channel.<br>';
  
}

if( preg_match('/away/', $input) ) {

    $msg = str_replace('/away', '', $input);

    $input = "AWAY: {$msg}";

}
