<?php

class Time implements iHTTPRequest
{

  private $mongodb;

  public function __construct()
  {
    $this->mongodb = MongodbFunctions::getInstance();
  }

  public function getRoutingData()
  {
    return [
            'GET:api/time' => function() {

              // Get data for a spesific timezone
              $cursor = $this->mongodb->queryData("Time", ['location' => $_GET['location']]);

              // Print all data from collection
              foreach ($cursor as $document)
              {
                $current = new DateTime(gmdate("d.m.Y G:i:s"));
                date_add($current, date_interval_create_from_date_string($document->offset . " hour"));
                echo json_encode(date_format($current, "d.m.Y G:i:s"));
              }
            },

            'POST:api/time' => function() {
              if ($_GET['offset'] != null && $_GET['location'] != null) {
                $data = ['offset' => $_GET['offset'], 'location' => $_GET['location']];
                $this->mongodb->writeData("Time", $data);
              }
            }
           ];
  }
}

?>
