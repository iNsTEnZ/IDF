<?php

require_once("model/Finance.php");
require_once("model/Weather.php");
require_once("model/Books.php");
require_once("model/Time.php");
require_once("model/iHTTPRequest.php");
require_once("model/WordOfDay.php");
require_once("model/Calendar.php");
require_once("model/Calculator.php");
class HTTPRouter
{
  private $factory = [];

  public function addRoutingFor($obj)
  {
    $array = $obj->getRoutingData();

    if ($array != null)
    {
      foreach ($array as $key => $value)
      {
        $this->factory[$key] = $value;
      }
    }
  }

  public function route($method, $request, $input)
  {
    $path = join("/", $request);
    $path = strtolower($path);

    if ($this->factory[$method . ':' . $path] != null)
    {
        $this->factory[$method . ':' . $path]();
    }
  }
}
