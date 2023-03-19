<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  The account page of this website (only when a logged on user exists)
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="./styles.css">
</head>
<body id="account">
  <a href="index.php">
    <img src="../landing_zone_logo.png">
  </a>

  <form class="transparent-form">
    <div class="container">
      <h1>Account</h1>
      <div class="label-account-left-div">
        <label class="label-account-left">Gender</label>
        <label class="label-account-left">Name</label>
        <label class="label-account-left">Surname</label>
        <label class="label-account-left">Birthdate</label>
        <label class="label-account-left">Email</label>
        <label class="label-account-left">Phone</label>
      </div>

      <?php
        require_once('database.php');

        $usr_hash = $_COOKIE['usr_hash'];
        $corr_cookie = checkUserHash($usr_hash);
        if(isset($usr_hash)
          && $corr_cookie) {
          $usr_img = getUserImage($usr_hash);

          $img_hash = null;
          if($usr_img != null
            && count($usr_img) == 1) {
            foreach ($usr_img as $hash) {
              $img_hash = $hash;
            }

            echo '<div class="div-img">';
            $files = scandir("uploads");
            $files = array_diff($files, array('..', '.', '.DS_Store'));
            foreach($files as $img) {
              if(str_contains($img, $img_hash)) {
                echo '<img src="'.'uploads/'.$img.'" class="img-upload">';
                break;
              }
            }
          }
          echo '</div>';

          echo '<div class="label-account-right-div">';
          $usr_rows = getUserInfo($usr_hash);
          if($usr_rows != null
            && count($usr_rows) > 0) {
            foreach ($usr_rows as $row) {
              foreach ($row as $col) {
                switch ($col) {
                  case 'mister':
                    $col = 'Mister';
                    break;
                  case 'miss':
                    $col = 'Miss';
                    break;
                }

                echo '<label class="label-account-right">'.$col.'</label>';
              }
            }
          }
          echo '</div>';
        }
      ?>
    </div>
  </form>
</body>
</html>
