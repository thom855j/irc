<?php


   $input = filterInput($_POST['input'], true);

   if( checkBlacklist(getVisitorIP(), APP . 'sys/etc/blacklist') ) {
        echo '<br>ERROR: IP in blacklist. Login terminated!<br>';
        return false;
   }


    if($input == 'help') {

        echo '<br>Use "ssh/connect user@host key(optional)" to login.<br>';

        return false;
    }

    if( !session()['auth'] && !session()['password'] ){

        $connection = cmdSSH($input, APP . 'sys/etc/passwd/');


        if(!$connection) {

            echo '<br>Missing parameters. Use "ssh/connect user@host key(optional)" to login.<br>';

            return false;

        } else {

            $username = session()['username'];

            $host = session()['host'];

            echo "<br>{$username}@{$host}'s password/key:<br>";

            session(['password', true], true);

            return false;

        }

    } 


    if(session()['password']) {

        $password = $input;
    }


    if(session()['key'])  {

        $dec = new Encryptor(session()['key']);  

    } else {

        $dec = new Encryptor(false);

    }


    if(!session()['auth']) {

        $username = session()['username'];

        $host = session()['host'];

        $session['host'] = APP . "sys/dev/{$host}.dec";

        $session['user'] = APP . "sys/etc/passwd/{$host}/{$username}.dec";

        $session['passwd'] = APP . "sys/etc/passwd/{$host}/";

        $session['storage'] = APP . "home/{$host}/{$username}/";

        $session['log'] = APP . "log/{$host}.{$username}";
          
        $user_ip = getVisitorIP();

        $date = getTimestamp();
          
        $data = '';

    }


 if( file_exists($session['host']) ) { 

        $data = $dec->decrypt(file_get_contents($session['host']));

        if(!$data) {
          
            session_clear();

            checkBlacklist(getVisitorIP(), APP . 'sys/etc/blacklist', true);
          
            echo '<br>ERROR: Wrong credentials. Login terminated!<br>';

            return false;
        }
    }
      
    if(file_exists($session['user'])) {

            $user = unserialize($dec->decrypt(file_get_contents($session['user'])));


            if(password_verify($password, $user['password'])) {

               $color = $user['color'];

                $data .= "<div user='{$username}' $color class='response'><i>[" . $date . "] <<b>". $username ."</b>> (". $user_ip .") joined session.</i><br></div>". PHP_EOL;

                //Simple welcome message
                $data = $dec->encrypt($data);

                file_put_contents($session['host'], $data);

                unset($data);

                session(['color', $user['color']], true);

                session(['auth', true], true);

                logger('Connected to session.', $session['log']);

                echo 'ok';

                return true;

            } else {
              
                if($input == 'exit'){
                    session_clear();
                    echo 'error';
                    return false;
                }

                if( !isset(session()['token']) ) {

                    session(['token', 1], true);

                }

                $token = session()['token'];
                

                if( $token ) {

                    session(['token', $token+1], true);

                    if($token == 4) {

                        session_clear();

                        checkBlacklist(getVisitorIP(), APP . 'sys/etc/blacklist', true);

                        echo 'error';

                        return false;
                    }

                }

                echo "<br>ERROR: Existing user or invalid password/key. Please try again or create new user. {$token} failed attempts out of 3<br>";
                echo "<br>{$username}@{$host}'s password/key:<br>";

                return false;
            }
      }


        $session_data = [
            'ip' => $user_ip,
            'username' => filterInput($username, true),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'host' => filterInput($host, true),
            'color' => setColor(),
        ];

       
        if (!file_exists($session['storage'])) {

            mkdir($session['storage'], 0777, true);
          
            if ( !file_exists($session['passwd']) ) {
          
                mkdir($session['passwd'], 0777, true);

                file_put_contents($session['user'], $dec->encrypt(serialize($session_data)));
            }

        }

        $color = $session_data['color'];

        //Simple welcome message
        $data .= "<div user='{$username}' $color class='response'><i>[" . $date . "] <<b>". $username ."</b>> (". $user_ip .") joined session.</i><br></div>". PHP_EOL;


        $data = $dec->encrypt($data);


        file_put_contents($session['host'], $data);

        unset($data);

        session(['auth', true], true);

        session(['color',  $session_data['color']], true);

        logger('Logged in successfully.', $session['log']);

        echo 'ok';

        return true;