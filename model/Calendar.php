<?php
namespace HolidayAPI;

class Calendar
{
    private $parameters = ['key' => '6cfd72bd-7bc5-44c7-adfa-645f4b4e0985'];

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

        curl_close($curl);
        $response = json_decode($response, true);

        if (!$response){
            return false;
        }

        return $response;
    }
}
$cal = new Calendar();
var_dump($cal -> holidays(['country'=>'IL', 'year'=>2017]));
?>
