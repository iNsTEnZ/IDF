<?php
require_once("YahooApi.php");
class Weather extends YahooApi
{
  public function getWeatherFor($location)
  {
    $yql_query = "select * from wunderground.forecast where location=$location";
    $yql_query_url = $this->BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&env=store://datatables.org/alltableswithkeys";
	
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
	
    // Convert JSON to PHP object
    $phpObj =  json_decode($json);
    echo "<pre>", var_dump($phpObj), "</pre>";
  }
}
?>