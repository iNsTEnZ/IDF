<?php

  require_once("DAL/iDBFunctions.php");

  class MongodbFunctions implements iDBFunctions
  {
    private static $instance = null;
    private $connection;

    private function __construct()
    {
      $this->initialize();
    }

    public static function getInstance()
    {
      if (static::$instance == null)
      {
        static::$instance = new MongodbFunctions();
      }

      return static::$instance;
    }

    public function initialize()
    {
      // Create a connection to Mongodb
      $this->connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public function readData($collectionName)
    {
      // Get all data from the collection
      $cursor = $this->connection->executeQuery('project.' . $collectionName, new MongoDB\Driver\Query([]));

      // Print all data from collection
      foreach ($cursor as $document)
      {
        echo $document . "\n";
      }
    }

    public function writeData($collectionName, $data)
    {
      // The write object (buffer)
      $bulk = new MongoDB\Driver\BulkWrite();

      // Write to the buffer
      $bulk->insert($data);

      // Commit the write to the db
      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
      $result = $this->connection->executeBulkWrite('project.' . $collectionName, $bulk, $writeConcern);
    }
  }


 ?>
