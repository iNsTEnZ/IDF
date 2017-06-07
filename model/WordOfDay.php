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
              $cursor = $this->mongodb->readData("WordOfDay");

              // Print all data from collection
              foreach ($cursor as $document)
              {
                echo json_encode($document);
              }
            },

            'POST:api/WordOfDay' => function() {
              $data = ['title' => $_GET['title']];
              $this->mongodb->writeData("WordOfDay", $data);
            }
           ];
  }
}
