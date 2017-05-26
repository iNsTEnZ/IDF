<?php

  require_once("model/iHTTPRequest.php");

  abstract class YahooApi implements iHTTPRequest
  {
    protected $BASE_URL = "https://query.yahooapis.com/v1/public/yql";
  }
 ?>
