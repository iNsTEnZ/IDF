<?php
require_once("YahooApi.php");
class Calc extends YahooApi
{
  public function calcExpression($expr)
  {
	$url = "http://www.calcatraz.com/calculator/api?c=" . urlencode($expr);
	
    // Make call with cURL
    $session = curl_init($url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    echo $json; 
  }
  public function getRoutingData()
  {
      return ['GET:api/calc' => function() { $this->calcExpression('"' . $_GET['expr'] . '"'); }];
  }
}
