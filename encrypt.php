<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  Handles the encrypting of the password by using a hashing
  function and by adding some salt and some pepper to the password
-->

<?php
  $salt = "$2a$07$9NQ7+UHV7X5SIIR/V?!YFXT-";
  $pepper = "P84WI§K.CF17ZC7/%70!SYAQ";
  $master_key = "C+/1%3PRF§E(!0\MXSL52!?W";
  $crypt_str = '$6$rounds=5000$';

/**
 * @param $password The password to encrypt
 * @return The password with added salt and pepper
 */
  function enc_password($password) {
    if(!isset($password)) {
      return null;
    }

    global $salt;
    global $pepper;
    global $master_key;
    global $crypt_str;

    // Pre hashing the salt and pepper.
    $salt_crypt = crypt($salt, $crypt_str.$master_key);
    $pepper_crypt = crypt($pepper, $crypt_str.$master_key);

    // Hashing and encrypting the password.
    return str_replace($crypt_str, "", crypt($password.$pepper_crypt, $crypt_str.$salt_crypt));
  }
