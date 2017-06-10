<?php

require_once("DAL/MongodbFunctions.php");
require_once("model/iHTTPRequest.php");

class WordOfDay implements iHTTPRequest
{
  private $mongodb;

  public function __construct()
  {
    $this->mongodb = MongodbFunctions::getInstance();
  }

  public function getRoutingData()
  {
    return [
            'GET:api/wordofday' => function() {
              $cursor = $this->mongodb->readData("WordOfDay");
              $array = $cursor->toArray();

              $count = count($array);
              $current = 0;

              echo json_encode($array[rand(0, $count - 1)]);
            },

            'POST:api/wordofday' => function() {
              $data = ['title' => $_GET['title']];
              $this->mongodb->writeData("WordOfDay", $data);
            }
           ];
  }
}
