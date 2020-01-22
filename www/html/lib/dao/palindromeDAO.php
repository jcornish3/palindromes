<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/palindrome.php';
include_once 'baseDAO.php';

class PalindromeDAO extends BaseDAO {
  private static $SELECT_QUERY = "SELECT p.id, p.supplied_value, p.palindrome, p.created, p.modified FROM palindrome p";
  private static $INSERT_QUERY = "INSERT INTO palindrome (supplied_value, palindrome, created) VALUES (:supplied_value, :palindrome, NOW()) RETURNING id";
  private static $UPDATE_QUERY = "UPDATE palindrome SET supplied_value=:supplied_value, palindrome=:palindrome, modified=NOW() where id=:id";
  private static $DELETE_QUERY = "DELETE FROM palindrome WHERE id=?";

  /**
   * Constructor
   *
   * @param Connection $conn the databse connection
   */
  public function __construct($conn) {
    parent::__construct($conn);

    $this->setSelectQuery(self::$SELECT_QUERY);
    $this->setInsertQuery(self::$INSERT_QUERY);
    $this->setUpdateQuery(self::$UPDATE_QUERY);
    $this->setDeleteQuery(self::$DELETE_QUERY);
  }

  function sanitizeAndInsertParams(&$stmt, &$palindrome) {
    // sanitize
    $palindrome->value = htmlspecialchars(strip_tags($palindrome->value));

    // bind values
    $stmt->bindParam(":supplied_value", $palindrome->value);

    $isPal = $palindrome->palindrome ? "true" : "false";
    $stmt->bindParam(":palindrome", $isPal);
  }

  function getNewObject() {
    return new Palindrome();
  }

  /**
   * Override
   * Get the results from the database.
   *
   * @param Row $row
   */
  function getFromResult(&$palindrome, $row) {
    $palindrome->id = $row['id'];
    $palindrome->value = $row['supplied_value'];
    $palindrome->palindrome = $row['palindrome'];
    $palindrome->created = $row['created'];
    $palindrome->modified = $row['modified'];
  }
}

?>