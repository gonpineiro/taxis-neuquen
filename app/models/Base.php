<?php

/**
 * This is the model class for table "Habilitaciones".
 *  @property string $url
 */
class Base
{
    private $url = API_URL;
    private $headers = ["Content-type: application/json", "Authorization: Bearer " . API_TOKEN];

    public function callWebService(array $params, string $method = 'POST')
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTPHEADER => $this->headers,
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true)['value'];
        } catch (Exception $e) {
            return $e;
        }
    }
}
