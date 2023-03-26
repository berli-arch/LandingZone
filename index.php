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
      echo '<img src="../landing_zone_logo.png">';
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
      echo '<img src="../landing_zone_logo.png">';
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
      <img src="products/Versace T-Shirt White.jpg" alt="T-Shirt 1">
      <h3>Versace T-Shirt White</h3><br>
      <a href="https://www.versace.com/eu/barocco-silhouette-logo-t-shirt-1w010/1006974-1A04949_AT4_M_1W010__.html?lgw_code=16201-1006974-1A04949_AT4_M_1W010__&&wt_mc=at.shopping.google.link.shopping&gclid=Cj0KCQjw2v-gBhC1ARIsAOQdKY2LPU9rJPXg5o1rc0cHPb76OPaM3ncyCbe8nmlILI3jzIn2SQ8dZHEaAq8PEALw_wcB&gclsrc=aw.ds" target="_blank">Learn More</a>
    </div>
    <div class="product-item">
      <img src="products/Versace Jeans Couture Logo Couture T-Shirt for Men.jpg" alt="T-Shirt 2">
      <h3>Versace Jeans Couture <br> Logo Couture T-Shirt <br> for Men</h3>
      <a href="https://www.versace.com/eu/jeans-couture/herren/kleidung/t-shirts-und-poloshirts/logo-couture-t-shirt-e801/E74GAH6S0-EJS161_E801.html" target="_blank">Learn More</a>
    </div>
    <div class="product-item"><br>
      <img src="products/Versace Allover T-Shirt with Crystals.jpg" alt="T-Shirt 3">
      <h3>Versace Allover T-Shirt <br> with Crystals</h3>
      <a href="https://www.versace.com/eu/en/women/clothing/t-shirts-sweatshirts/t-shirts/crystal-versace-allover-t-shirt-2b300/1009337-1A05387_2B300.html" target="_blank">Learn More</a>
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
