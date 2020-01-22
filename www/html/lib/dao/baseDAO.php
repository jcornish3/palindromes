<?php

abstract class BaseDAO {
  public $conn;
  private $selectQuery;
  private $insertQuery;
  private $updateQuery;
  private $deleteQuery;

  /**
   * Constructor
   *
   * @param Connection $conn the databse connection
   */
  public function __construct($conn) {
    $this->conn = $conn;
  }

  function setSelectQuery($query) {
    $this->selectQuery = $query;
  }

  function getSelectQuery() {
    return $this->selectQuery;
  }

  function setInsertQuery($query) {
    $this->insertQuery = $query;
  }

  function getInsertQuery() {
    return $this->insertQuery;
  }

  function setUpdateQuery($query) {
    $this->updateQuery = $query;
  }

  function getUpdateQuery() {
    return $this->updateQuery;
  }

  function setDeleteQuery($query) {
    $this->deleteQuery = $query;
  }

  function getDeleteQuery() {
    return $this->deleteQuery;
  }

  abstract function getNewObject();

  /**
   * Find all objects
   *
   * @return array of Objects or empty
   */
  function findAll() {
    // select all query
    $query = $this->getSelectQuery();

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    return $this->returnArray($stmt);
  }

  /**
   * Find Object by id
   *
   * @param UUID $id the id
   * @return NULL|Object
   */
  function findById($id) {
    $query = $this->getSelectQuery() . " WHERE id=?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of product to be updated
    $stmt->bindParam(1, $id);

    return $this->returnOne($stmt);
  }

  /**
   * Find Object by field
   *
   * @param Object $value the value to find
   * @param String $field the field to look in
   * @return array of Objects or empty
   */
  function findByField($value, $field) {
    $query = $this->getSelectQuery() . " WHERE $field = '$value'";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    return $this->returnArray($stmt);
  }

  /**
   * Delete an Object from the databse.
   *
   * @param integer id the id
   * @return boolean
   */
  function delete($id) {
    $query = $this->getDeleteQuery();

    // prepare query
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $id);

    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  /**
   * Get the results from the database.
   *
   * @param Object $object the object to fill
   * @param Row $row
   */
  abstract function getFromResult(&$object, $row);

  function returnArray(&$stmt) {
    // execute query
    $stmt->execute();

    $num = $stmt->rowCount();

    $objectArray = array ();
    if ($num > 0) {
      while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

        $object = $this->getNewObject();
        $this->getFromResult($object, $row);
        array_push($objectArray, $object);
      }
    }

    return $objectArray;
  }

  /**
   * Return one from a Statement
   *
   * @param Statement $stmt
   * @return NULL|Object
   */
  function returnOne(&$stmt) {
    $object = NULL;

    // execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = $stmt->rowCount();

    if ($num == 1) {
      $object = $this->getNewObject();
      $this->getFromResult($object, $row);
    }

    return $object;
  }

  /**
   * Save an Object
   *
   * @param Object $object the Object to save
   * @return boolean true when saved
   */
  function save(&$object) {
    if (empty($object->id)) {
      return $this->insert($object);
    } else {
      return $this->update($object);
    }
  }

  /**
   * Insert a new Object in to the databse.
   *
   * @param Object $object
   * @return boolean
   */
  protected function insert(&$object) {

    // query to insert record
    $query = $this->getInsertQuery();

    // prepare query
    $stmt = $this->conn->prepare($query);

    $this->sanitizeAndinsertParams($stmt, $object);

    // execute query
    if ($stmt->execute()) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $object->id = $row['id'];
      return true;
    }

    return false;
  }

  abstract function sanitizeAndInsertParams(&$stmt, &$object);

  /**
   * Update a Object in the databse.
   *
   * @param Object $object
   * @return boolean
   */
  protected function update(&$object) {

    // query to insert record
    $query = $this->getUpdateQuery();

    // prepare query
    $stmt = $this->conn->prepare($query);

    $this->sanitizeAndinsertParams($stmt, $object);

    $stmt->bindParam(":id", $object->id);

    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}

?>