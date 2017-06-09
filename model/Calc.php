<?php

require_once("YahooApi.php");

class Calc extends YahooApi
{
  public function calcExpression($operator, $fvalue, $lvalue)
  {
  	$operator=$_REQUEST['operator'];

  	if($operator=="plus")
  	{
    	$add1 = $fvalue;
    	$add2 = $lvalue;
    	$res= $add1+$add2;
  	}

  	if($operator=="minus")
  	{
    	$add1 = $fvalue;
    	$add2 = $lvalue;
    	$res= $add1-$add2;
  	}

  	if($operator=="mul")
  	{
    	$add1 = $fvalue;
    	$add2 = $lvalue;
    	$res =$add1*$add2;
  	}

  	if($operator=="div")
  	{
    	$add1 = $fvalue;
    	$add2 = $lvalue;
    	$res= $add1/$add2;
  	}

  	echo $res;
  }

  public function getRoutingData()
  {
      return ['GET:api/calc' => function() { $this->calcExpression('"' . $_GET['operator'] . '"',$_GET['fvalue'],$_GET['lvalue']); }];
  }
}
