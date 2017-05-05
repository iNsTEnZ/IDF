<?php
require_once("model/Finance.php");
require_once("model/Weather.php");
require_once("model/Books.php");
require_once("model/Time.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

if ($request != null) {

  $path = join("/", $request);

  switch ($method) 
  {
    case 'GET':
      switch ($path) 
	  {
        case 'api/finance':
			if ($_GET['stock'] != null) 
			{
				$finance = new Finance();
				$finance->getQuateFor('"' . $_GET['stock'] . '"');
			}
			break;

        case 'api/weather':
			if ($_GET['location'] != null) 
			{
				$weather = new Weather();
				$weather->getWeatherFor('"' . $_GET['location'] . '"');
			}
			break;
			
		case 'api/books':
			if ($_GET['bookName'] != null) 
			{
				$book = new Books();
				$book->getBookFromName('"' . $_GET['bookName'] . '"');
			}
			break;
		case 'api/time':
			if ($_GET['location'] != null) 
			{
				$book = new Time();
				$book->getTime('"' . $_GET['location'] . '"');
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
