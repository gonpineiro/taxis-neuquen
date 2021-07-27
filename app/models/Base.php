<?php

/**
 * This is the model class for table "Habilitaciones".
 *  @property string $url
 */
class Base
{
    public static $url = 'https://weblogin.muninqn.gov.ar/api/mnqn';
    public static $headers = ['Content-type: application/json'];

    public static function callWebService($params)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => self::$url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTPHEADER => self::$headers,
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, false);
        } catch (Exception $e) {
            return $e;
        }
    }
}
