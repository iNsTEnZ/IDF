<?php

require_once("YahooApi.php");

class Books extends YahooApi
{
  public function getBookFromName($bookName)
  {
    $yql_query = "SELECT * FROM google.books WHERE q=$bookName";
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
