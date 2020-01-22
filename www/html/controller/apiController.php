<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/palindromeApiController.php';

abstract class ApiController {

  abstract function doGet();

  abstract function doPost();

  abstract function doPut();

  abstract function doDelete();
}

?>