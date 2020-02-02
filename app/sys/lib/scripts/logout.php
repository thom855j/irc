<?php
  
    if (file_exists($session['channel'])) {

      $dec = new Encryptor(Session::get('key'));

      $data = $dec->decrypt(file_get_contents($session['channel']));

      $nickname = Session::get('nickname');

      $ip = Session::get('ip');

      if($data) {

            $color = Session::get('color');

              $data .= "<div user='{$nickname}' $color class='response'><i>[" . getTimestamp(false) . "] <<b>". $nickname ."</b>> (". $ip .") left channel.</i><br></div>". PHP_EOL;

              $data = $dec->encrypt($data);

              file_put_contents($session['channel'], $data);

              unset($data);

      }
    }

    logger("{$nickname} left channel successfully.", $session['log']);

    session_destroy();

    return header("Location: index.php?id=login"); //Redirect the user