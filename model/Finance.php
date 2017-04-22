<?php

class Finance
{

  protected $BASE_URL = "https://query.yahooapis.com/v1/public/yql";

  public function getQuateFor($stock)
  {
    $yql_query = "select * from yahoo.finance.quote where symbol in ($stock)";
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
