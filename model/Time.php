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

              $cursor = null;

              if (array_key_exists('location', $_GET)) {
                // Get data for a spesific timezone
                $cursor = $this->mongodb->queryData("Time", ['location' => $_GET['location']]);
              } else {
                // Get data for all timezones
                $cursor = $this->mongodb->readData("Time");
              }

              // Print all data from collection
              foreach ($cursor as $document)
              {
                $current = new DateTime(gmdate("d.m.Y G:i:s"));
                date_add($current, date_interval_create_from_date_string($document->offset . " hour"));
                echo json_encode(date_format($current, "d.m.Y G:i:s"));
              }
            },

            'GET:api/time/locations' => function() {

              $cursor = $this->mongodb->readData("Time");

              // Print all data from collection
              foreach ($cursor as $document)
              {
                echo json_encode($document->location);
              }
            },

            'POST:api/time' => function() {
              if (array_key_exists('offset', $_GET) && array_key_exists('location', $_GET)) {
                $data = ['offset' => $_GET['offset'], 'location' => $_GET['location']];
                $this->mongodb->writeData("Time", $data);
              }
            }
           ];
  }
}

?>
