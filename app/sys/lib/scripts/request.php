<?php

    $dec = new Encryptor(session()['key']);
  
	if (file_exists($session['host'])) {

    $data = $dec->decrypt(file_get_contents($session['host']));
      
    }

    if($data) {

        echo $data;

        unset($data);

    } else {
      
      echo "<div  class='response'>(".date('H:i:s').") <b>".'system'."</b>: ERROR. Please contact sysadmin.<br></div>";
      
    }

   

