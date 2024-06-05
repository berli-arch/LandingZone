<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  The index page (home page)
-->

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>LandingZone</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="styles.css">

  <meta name="theme-color" content="#fafafa">
</head>

<body id="index">
  <!-- Checks if the cookie from the last session is available and logs the user in -->
  <?php
    require_once('database.php');
    //require_once('csv-handle.php');

    if(isset($_COOKIE['usr_hash'])) {
      $usr_hash = $_COOKIE['usr_hash'];

      $corr_cookie = checkUserHash($usr_hash);
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
      echo '<header>';
      echo '<img src="landing_zone_logo.png">';
      echo '<nav id="nav_id">';
      echo '<a href="login.html">Login</a>';
      echo '<a href="register.html">Register</a>';
      echo '</nav>';
      echo '</header>';
    }

  /**
   * Shows the Account or Sign Out option.
   */
    function show_account() {
      echo '<header>';
      echo '<img src="landing_zone_logo.png">';
      echo '<nav id="nav_id">';
      echo '<a href="signout.php">Sign Out</a>';
      echo '<a href="account.php">Account</a>';
      echo '</nav>';
      echo '</header>';
    }
  ?>

  <div class="product-list">
    <h2>Featured T-Shirts</h2>
    <div class="product-item">
      <h3>Versace T-Shirt White</h3><br>
      <a target="_blank">Learn More</a>
    </div>
  </div>

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
