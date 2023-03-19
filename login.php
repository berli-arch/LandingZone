<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  Handles the login process.
-->

<?php
  //require_once('csv-handle.php');
  require_once('encrypt.php');
  require_once('database.php');
  //$f_accounts = 'accounts.csv';

  if(isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Validating the entered email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo
      "<script>
        alert('Email format is incorrect');
        document.location.href = 'login.html';
      </script>";
      return;
    }

    // Generating the hash, checking if the user is not already registered and saving the cookie.
    $to_hash = $email.$password;
    $password_hash = enc_password($to_hash);
    echo $password_hash;

    if(checkUserHash($password_hash)) {
      setcookie("usr_hash", $password_hash);
      header('location:index.php');
    } else {
      echo $password_hash;

      /*echo
      "<script>
        alert('This account may not exist');
        document.location.href = 'login.html';
      </script>";*/
    }
  }
