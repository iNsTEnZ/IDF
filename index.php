<?php
require_once("model/Finance.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

if ($request != null) {

  $path = join("/", $request);

  switch ($method) {
    case 'GET':
      switch ($path) {
        case 'api/finance':

          if ($_GET['stock'] != null) {
            $finance = new Finance();
            $finance->getQuateFor('"' . $_GET['stock'] . '"');
          }

          break;
      }
      break;
    case 'PUT':
      break;
    case 'POST':
      break;
    case 'DELETE':
      break;
  }

}

?>
