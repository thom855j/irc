<?php

if( preg_match('/cd/', $input)) {

    $cd = explode(' ', $input)[1];

    $dirs = cmdScan($session['storage'] . $cd);

    $input = '<br><br>';

    foreach ($dirs as $dir) {
      $input .= $dir . "<br>";
    }
}

if( preg_match('/mkdir/', $input)) {

    $dir = explode(' ', $input)[1];

    $dir = $session['storage'] .  $dir;

    if (!file_exists( $dir)) {

        mkdir($dir, 0777, true);
           
    }

    $data = false;
}

if($input == 'clear') {

	$data = preg_replace("/<div user='{$username}' [^>]*>.*?<\/div>/i", '', $data);
      
    $data = $dec->encrypt($data);

    file_put_contents($session['host'], $data);

    $data = false;
}


if($input == 'help') {

	    $username = 'system';

        $input = '<br>Command List - page 1 of 3:<br><br>';

        $input .= '<b>help [page number]</b> - Displays the specified page of commands.<br><br>';

        $input .= "<b>scp [filename] [OPTIONAL:destination]</b> - Downloads the selected file to the main host you are connected from.<br><br>";

        $input .= "<b>scan</b> - This command will scan the hosts that are connected to host you are currently accessing. This command requires admin access on the accessed host. <br><br>";

        $input .= "<b>scan</b> - This command will scan the hosts that are connected to host you are currently accessing. This command requires admin access on the accessed host. <br><br>";
  
}
