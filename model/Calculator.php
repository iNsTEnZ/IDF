<?php

require_once("model/iHTTPRequest.php");

class Calculator implements iHTTPRequest
{
	public function calculate($operand1, $operator, $operand2)
	{
		$res;
		$operator = str_replace('"', '', $operator);
		$operand1 = str_replace('"', '', $operand1);
		$operand2 = str_replace('"', '', $operand2);
		
	    switch($operator)
        {
            case "add":
            $res = $operand1 + $operand2;
            break;

            case "sub":
            $res =  $operand1 - $operand2;
            break;

            case "mul":
            $res = $operand1 * $operand2;
            break;

            case "div":
            $res = $operand1 / $operand2;
            break;

            default:
            $res = "Sorry No command found";
        } 
		
		echo $res;
	}

	public function getRoutingData()
	{
		return ['GET:api/calculator' => function() { $this->calculate('"' . $_GET['operand1'] . '"', '"' . $_GET['operator'] . '"', '"' . $_GET['operand2'] . '"'); }];
	}
}
?>