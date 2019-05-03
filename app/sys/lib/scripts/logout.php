<?php
  
    if (file_exists($session['host'])) {

      $dec = new Encryptor(session()['key']);

      $data = $dec->decrypt(file_get_contents($session['host']));

      $username = session()['username'];

      $ip = session()['ip'];

      if($data) {

            $color = session()['color'];

              $data .= "<div user='{$username}' $color class='response'><i>[" . getTimestamp(false) . "] <<b>". $username ."</b>> (". $ip .") left session.</i><br></div>". PHP_EOL;

              $data = $dec->encrypt($data);

              file_put_contents($session['host'], $data);

              unset($data);

      }
    }

    logger('Logged out successfully.', $session['log']);

    session_clear();

    return header("Location: index.php?id=login"); //Redirect the user