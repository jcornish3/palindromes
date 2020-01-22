<?php

class PalindromeLogic extends BaseLogic {

  public function __construct($dao) {
    parent::__construct($dao);
  }

  function getDao() {
    return $this->dao;
  }

  function save(&$object) {
    $isPalindrome = $this->isPalindrome($object->value);

    $object->palindrome = $isPalindrome;

    return $this->getDao()->save($object);
  }

  /**
   * Determine if value is a palindrome
   *
   * @param String $value the value to check
   * @return "true" when palindrome
   */
  function isPalindrome($value) {
    // lower case
    $test = strtolower($value);

    // strip whitespace to find palindromes in sentences
    // eg. 'Was it a car or a cat I saw'
    $test = preg_replace('/\s+/', '', $test);

    // if ($test == strrev($test)) {
    // return "true";
    // } else {
    // return "false";
    // }

    return $test == strrev($test);
  }
}

?>