<?php
// include database and dao files
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/apiController.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

$controller = new PalindromeApiController();
switch ($method) {
  case 'PUT' :
    $controller->doPut();
    break;
  case 'POST' :
    $controller->doPost();
    break;
  case 'GET' :
    $controller->doGet();
    break;
  case 'DELETE' :
    $controller->doDelete();
    break;
  default :
    handle_error($request);
    break;
}

?>
