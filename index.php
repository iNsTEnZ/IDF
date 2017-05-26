<?php
require_once("model/Finance.php");
require_once("model/Weather.php");
require_once("model/Books.php");
require_once("model/Time.php");
require_once("DAL/MongodbFunctions.php");
require_once("HTTPRouter.php");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$mongodb = MongodbFunctions::getInstance();
$router = new HTTPRouter();

$router->addRoutingFor(new Finance());
$router->addRoutingFor(new Weather());
$router->addRoutingFor(new Books());
$router->addRoutingFor(new Time());

if ($request != null) {
  $path = join("/", $request);
  $router->route($method, $request, $input);
}
