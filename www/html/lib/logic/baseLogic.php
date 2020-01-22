<?php

class BaseLogic {
  public $dao;

  public function __construct($dao) {
    $this->dao = $dao;
  }

  function getDao() {
    return $this->dao;
  }

  function findAll() {
    return $this->getDao()->findAll();
  }

  function findById($id) {
    return $this->getDao()->findById($id);
  }

  function save(&$object) {
    return $this->getDao()->save($object);
  }

  function delete($id) {
    return $this->getDao()->delete($id);
  }
}

?>
