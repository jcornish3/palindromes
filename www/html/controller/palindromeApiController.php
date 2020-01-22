<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/apiController.php';

class PalindromeApiController extends ApiController {
  private $palindromeLogic;

  public function __construct() {
    $this->palindromeLogic = new PalindromeLogic(DaoFactory::getPalindromeDAO());
  }

  /**
   * GET messages
   */
  function doGet() {
    try {

      if (!empty(Utils::getFromRequest('id'))) {
        $this->findById(Utils::getFromRequest('id'));
      } else {
        $this->findAll();
      }
      http_response_code(200);
    } catch ( Exception $e ) {
      http_response_code(500);
      echo '{"error": "' . $e->getMessage() . '"}';
    }
  }

  /**
   * POST messages
   */
  function doPost() {
    try {
      $this->create();
    } catch ( Exception $e ) {
      http_response_code(500);
      echo '{"error": "' . $e->getMessage() . '"}';
    }
  }

  /**
   * PUT messages
   */
  function doPut() {
    try {
      $this->update();
    } catch ( Exception $e ) {
      http_response_code(500);
      echo '{"error": "' . $e->getMessage() . '"}';
    }
  }

  /**
   * DELETE messages
   */
  function doDelete() {
    try {
      $this->delete();
    } catch ( Exception $e ) {
      http_response_code(400);
      echo '{"error": "' . $e->getMessage() . '"}';
    }
  }

  /**
   * ******************************************
   * Private functions
   * ******************************************
   */
  private function findAll() {
    $palindromeArray = $this->palindromeLogic->findAll();

    // show palindromes data in json format
    echo json_encode($palindromeArray);
  }

  private function findById() {
    $id = isset($_GET['id']) ? $_GET['id'] : die();

    $palindrome = $this->palindromeLogic->findById($id);

    echo json_encode($palindrome);
  }

  private function delete() {
    $id = isset($_GET['id']) ? $_GET['id'] : die();

    $this->palindromeLogic->delete($id);
    echo json_encode('{}');
  }

  private function update() {
    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    // make sure data is not empty
    if (!empty($data->id) && !empty($data->value)) {

      $palindrome = new Palindrome();

      $palindrome->id = $data->id;
      $palindrome->value = $data->value;

      if ($this->palindromeLogic->save($palindrome)) {

        // tell the user
        echo json_encode($palindrome);
      }
    } else {
      // set response code - 400 bad request
      http_response_code(400);

      echo json_encode(array (
          "error" => "Unable to create value. Data is incomplete."
      ));
    }
  }

  private function create() {
    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    // make sure data is not empty
    if (!empty($data->value)) {

      $palindrome = new Palindrome();

      $palindrome->value = $data->value;

      try {
        if ($this->palindromeLogic->save($palindrome)) {

          // tell the user
          echo json_encode($palindrome);
        }
      } catch ( Exception $e ) {
        http_response_code(400);
        echo json_encode(array (
            "error" => $e->getMessage()
        ));
      }
    } else {

      // set response code - 400 bad request
      http_response_code(400);

      echo json_encode(array (
          "error" => "Unable to create value. Data is incomplete."
      ));
    }
  }
}

?>