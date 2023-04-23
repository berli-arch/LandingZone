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

    echo "Login";
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
    $password_hash = $this->enc_password($to_hash);

    echo "Test";
    if($this->checkUserHash($password_hash)) {
      echo "Test1";
      setcookie("usr_hash", $password_hash);
      echo "Test2";
      header("Location: index.php");
      exit;
      echo "Test3";
    } else {
      echo
      "<script>
        alert('This account may not exist');
        document.location.href = 'login.html';
      </script>";
    }
  }
