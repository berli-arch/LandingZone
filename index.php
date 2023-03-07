<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1
-->

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="./styles.css">

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!-- Checks if the cookie from the last session is available and logs the user in -->
  <?php
    require_once('csv-handle.php');

    if(isset($_COOKIE['usr_hash'])) {
      $f_accounts = 'accounts.csv';
      $usr_hash = $_COOKIE['usr_hash'];

      $corr_cookie = contains_str($f_accounts, $usr_hash);
      if($corr_cookie) {
        show_account();
      } else {
        setcookie("usr_hash", "");
        show_undefined();
      }
    } else {
      show_undefined();
    }

  /**
   * Shows the Login or Register option.
   */
    function show_undefined() {
      echo '<div class="topnav" id="nav_id">';
      echo '<a href="login.html">Login</a>';
      echo '<a href="register.html">Register</a>';
      echo '</div>';
    }

  /**
   * Shows the Account or Sign Out option.
   */
    function show_account() {
      echo '<div class="topnav">';
      echo '<a href="signout.php">Sign Out</a>';
      echo '<a href="">Account</a>';
      echo '</div>';
    }
  ?>

  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>
