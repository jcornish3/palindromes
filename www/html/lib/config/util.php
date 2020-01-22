<?php

class Utils {

  public static function getFromRequest($key) {
    if (isset($_GET[$key]) && !empty($_GET[$key])) {
      return $_GET[$key];
    } else if (isset($_POST[$key]) && !empty($_POST[$key])) {
      return $_POST[$key];
    } else {
      return NULL;
    }
  }
}

?>