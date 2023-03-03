<?php
  require_once('encrypt.php');
  global $enc;

  if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwd-repeat'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST["pwd"];
    $password_repeat = $_POST['pwd-repeat'];

    if($password == $password_repeat) {
      $enc.enc_password($password);

      /*$pwd_hash = password_hash($password, PASSWORD_DEFAULT);
      $user_registration = file_get_contents("user-registration.csv");
      $user_registration .= $username.",".$email.",".$pwd_hash."\n";

      $registrations_file = fopen("user-registration.csv", "w");
      fwrite($registrations_file, $user_registration);

      header('location:index.html');*/
    } else {
      header('location:register.html');
    }
  }
