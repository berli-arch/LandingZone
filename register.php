<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  Handles the register process
-->
<?php
  require_once('encrypt.php');
  require_once('csv-handle.php');

  // The filename for the stored accounts (username, email, hash)
  $f_accounts = 'accounts.csv';

  if(isset($_POST['name']) && isset($_POST['surname'])
    && isset($_POST['email']) && isset($_POST['pwd'])
    && isset($_POST['pwd-repeat']) && isset($_POST['city'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $phone = $_POST['phone_number'];

    $gender = '';
    if(isset($_POST['genderMister'])) {
      $gender = 'Mister';
    } else if(isset($_POST['genderMiss'])) {
      $gender = 'Miss';
    }

    // Validating the entered email.
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo
      "<script>
        alert('Email format is incorrect');
        document.location.href = 'register.html';
      </script>";
      return;
    }

    // Checking if the passwords match.
    if($password == $password_repeat) {
      $to_hash = $email.$password;
      $password_hash = enc_password($to_hash);

      if(!isset($password_hash)) {
        reg_failed();
      }

      // Creating the array with the users details, writing the csv and storing the hash as the cookie.
      $user_registration = array($gender.';'.$name.';'.$surname.';'
        .$birthdate.';'.$email.';'.$street.';'.$city.';'.$zip.';'
        .$state.';'.$phone.';'.$password_hash
      );

      $success = write_append($f_accounts, $user_registration);
      if($success) {
        setcookie("usr_hash", $password_hash);
      } else {
        header('location:register.html');
        return;
      }

      header('location:index.php');
    } else {
      reg_failed();
    }
  }

/**
 * Called if the registration failed, to reload the registration page.
 */
  function reg_failed() {
    header('location:register.html');
  }
