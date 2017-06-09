<?php

class Calendar implements iHTTPRequest
{
    private $parameters = ['key' => 'fb5d2526-979f-442e-ab8c-b8fe12c4627f'];

    public function holidays($parameters = array())
    {
        $parameters = array_merge($this->parameters, $parameters);
        $parameters = http_build_query($parameters);

        $url = 'https://holidayapi.com/v1/holidays?'. $parameters;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_HEADER          => false,
            CURLOPT_RETURNTRANSFER  => true,
        ));

        $response = curl_exec($curl);

        if ($error = curl_error($curl)){
            return $error;
        }

        if (!$response){
            return false;
        }

        return $response;
        $json = curl_exec();
        echo $json;
    }

    public function getRoutingData()
    {
        return ['GET:api/Calendar' => function() {$this->holidays('country');}];
    }
}
//$cal = new Calendar();
//var_dump($cal -> holidays(['country'=>'IL', 'year'=>2017]));
?>