<?php

namespace Decimalone\Shiprocket;

class Shiprocket
{
    public function run($method, $endpoint, $params = [])
    {
        $query = "https://apiv2.shiprocket.in/v1/external/$endpoint";
        foreach ($params as $key => $value) {
            if ($value != null) {
                $query .= '&' . $key . '=' . $value;
            }
        }
        $options['headers'] = ['Content-Type'=>"application/json"];
        $client = new Client(['verify' => false]);
        $http_response = $client->request('get', $query, $options);
        $http_status = $http_response->getStatusCode();
        if ($http_status != 200) {
            $this->errors = "http_status $http_status returned";
            return false;
        }
        $json = $http_response->getBody()->getContents();
        $json = json_decode($json);
        return $json;
    }
}