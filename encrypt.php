<?php
  function enc_password($password) {
    $salt = "JC+)TJUQE(JW)R!KW.UDK0U1";
    $pepper = "MB1%§OH07%SR/JM2L?C!/2§Q";

    $salt_crypt = crypt($salt, CRYPT_SHA512);
    $pepper_crypt = crypt($pepper, CRYPT_SHA512);
    $password_crypt = crypt($salt_crypt . $password . $pepper_crypt, CRYPT_SHA512);

    echo $password_crypt;
    echo $salt_crypt;
    echo $pepper_crypt;
    echo $salt;
    echo $pepper;
  }
