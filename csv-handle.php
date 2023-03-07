<!--
  LandingZone
  Marcel.BERLINGER
  05.03.2023
  v0.1

  Handles the csv functions
-->
<?php
/**
 * @param $str_file The filename
 * @param $arr_lines The array with the line contents
 * @return bool If the writing was successfull
 */
  function write_append($str_file, $arr_lines) {
    if(!isset($str_file) || !isset($arr_lines) || !is_array($arr_lines)) {
      return false;
    }

    if(contains_contents($str_file, $arr_lines)) {
      return false;
    }

    $file = fopen($str_file, 'a');
    foreach ($arr_lines as $line) {
      fputcsv($file, explode(',', $line));
    }
    fclose($file);

    return true;
  }

/**
 * @param $str_file The filename
 * @param $arr_lines The array with the line contents
 * @return bool If given lines were found in the csv
 */
  function contains_contents($str_file, $arr_lines) {
    if(count($arr_lines) > 0) {
      $file = fopen($str_file, "r");
      $alr_reg = false;

      while($row = fgetcsv($file)) {
        if(count($row) <= 0) {
          break;
        }

        if($arr_lines == $row) {
          $alr_reg = true;
          break;
        }
      }

      if($alr_reg) {
        return true;
      }
    }

    return false;
  }

/**
 * @param $str_file The filename
 * @param $str The string to search for in the csv
 * @return bool If the given string was found in the csv
 */
  function contains_str($str_file, $str) {
    if(isset($str)) {
      $file = fopen($str_file, "r");

      while($row = fgetcsv($file)) {
        if(count($row) <= 0) {
          break;
        }

        $row_split = explode(';', (string)$row[0]);
        foreach($row_split as $cell) {
          if($str == $cell) {
            return true;
          }
        }
      }
    }

    return false;
  }
