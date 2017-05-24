<?php

interface iDBFunctions
{
    public function initialize();
    public function readData($collectionName);
    public function writeData($collectionName, $data);
}

?>
