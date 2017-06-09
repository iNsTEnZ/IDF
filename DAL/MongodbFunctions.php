<?php

  require_once("DAL/iDBFunctions.php");

  class MongodbFunctions extends iDBFunctions
  {
    private $connection;

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
      //$this->connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
      $this->connection = new MongoDB\Driver\Manager("mongodb://172.30.123.76:27017");
    }

    public function readData($collectionName)
    {
      try {
        // Get all data from the collection
        $cursor = $this->connection->executeQuery('project.' . $collectionName, new MongoDB\Driver\Query([]));

        return $cursor;

      } catch(MongoDB\Driver\Exception\Exception $e) {
        echo $e->getMessage();
      }
    }

    public function queryData($collectionName, $query)
    {
      try {
        // Get all data from the collection
        $cursor = $this->connection->executeQuery('project.' . $collectionName, new MongoDB\Driver\Query($query));

        return $cursor;

      } catch(MongoDB\Driver\Exception\Exception $e) {
        echo $e->getMessage();
      }
    }

    public function writeData($collectionName, $data)
    {
      try {
        // The write object (buffer)
        $bulk = new MongoDB\Driver\BulkWrite();

        // Write to the buffer
        $bulk->insert($data);

        // Commit the write to the db
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
        $result = $this->connection->executeBulkWrite('project.' . $collectionName, $bulk, $writeConcern);
        echo json_encode($result);
      } catch(MongoDB\Driver\Exception\Exception $e) {
        echo $e->getMessage();
      }
    }
  }
