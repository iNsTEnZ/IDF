<?php

require_once("YahooApi.php");

class Finance extends YahooApi
{

  public function getQuateFor($stock)
  {
    $yql_query = "select * from yahoo.finance.quote where symbol in ($stock)";
    $yql_query_url = $this->BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&env=store://datatables.org/alltableswithkeys";

    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    echo $json;
  }

  public function getRoutingData()
  {
    return ['GET:api/finance' => function() { $this->getQuateFor('"' . $_GET['stock'] . '"'); }];
  }
}

?>
