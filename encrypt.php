<?php
  function enc_password($password) {
    $arr_pepper = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
      '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', '+', '-', '.', '/', '\\', '?', '§', '%', '(', ')');

    for($i = 0; $i < 24; ++$i) {
      $rnd = rand(0, 46);
      echo($arr_pepper[$rnd]);
    }
  }
