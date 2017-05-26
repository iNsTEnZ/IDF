<?php

class Time
{

  public function getTime($location)
  {
	  $t = date_create("Asia/Jerusalem");

    switch ($location) {
     case 'israel':
    	break;
     case 'iran':
    	date_add($t, date_interval_create_from_date_string("+ 2 hours"));
    	break;
     case 'germany':
    	date_sub($t, date_interval_create_from_date_string("+ 1 hours"));
    	break;
     case 'usa':
    	date_sub($t, date_interval_create_from_date_string("+ 7 hours"));
    	break;
     case 'brazil':
    	date_sub($t, date_interval_create_from_date_string("+ 5 hours"));
    	break;
     case 'chine':
    	date_add($t, date_interval_create_from_date_string("+ 6 hour"));
    	break;
   }

   echo "<pre>", date_format($t, "d/m/Y G:i:s"), "</pre>";
  }

  public function getRoutingData()
  {
    return ['GET:api/time' => function() { $this->getTime($_GET['location']); }];
  }
}

?>
