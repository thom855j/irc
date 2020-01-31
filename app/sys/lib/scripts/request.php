<?php

    $dec = new Encryptor(Session::get('key'));
  
	if (file_exists($session['channel'])) {

    $data = $dec->decrypt(file_get_contents($session['channel']));
      
    }

    if($data) {

        echo $data;

        unset($data);

    } else {
      
      echo "<div  class='response'>(".date('H:i:s').") <b>".'system'."</b>: ERROR. Please contact sysadmin.<br></div>";
      
    }

   

