<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  Signs the user out by clearing the saved cookie
-->
<?php
  setcookie("usr_hash", "");
  header('location:index.php');
