<?php

require_once("YahooApi.php");

class Weather extends YahooApi
{
  public function getWeatherFor($location, $u)
  {
	$yql_query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='$location') and u=$u";
    $yql_query_url = $this->BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&env=store://datatables.org/alltableswithkeys";
	
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    echo $json;
  }
}
?>
