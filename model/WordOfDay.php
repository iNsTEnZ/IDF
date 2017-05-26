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
            'GET:api/WordOfDay' => function() {
              $this->mongodb->readData("WordOfDay");
            },

            'POST:api/WordOfDay' => function() {
              $data = ['title' => $_GET['title']];
              $this->mongodb->writeData("WordOfDay", $data);
            }
           ];
  }
}
