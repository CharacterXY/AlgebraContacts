<?php

// CRSR -> informiraj se o tome
// CRSR token
class Token{

    public static function generate() {
        $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
    }
     
/*     public static function check($token) {
        if (isset($_POST['token'])  && $token === $_SESSION['token']) {
            return true;
        }
            return false;
    }
  */
    


}

?>