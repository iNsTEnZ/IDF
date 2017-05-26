<?php

abstract class iDBFunctions
{
    protected static $instance = null;

    protected function __construct()
    {
      $this->initialize();
    }

    public static function getInstance()
    {
        return null;
    }

    abstract public function initialize();
    abstract public function readData($collectionName);
    abstract public function writeData($collectionName, $data);
}
