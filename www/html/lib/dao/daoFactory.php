<?php
include_once 'palindromeDAO.php';

class DaoFactory {

  static function getPalindromeDAO() {
    $database = new Database();
    $conn = $database->getConnection();
    return new PalindromeDAO($conn);
  }
}

?>