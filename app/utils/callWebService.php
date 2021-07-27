<?php

try {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://weblogin.muninqn.gov.ar/api/mnqn?patente=AE-270-YW',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
} catch (Exception $e) {
    return $e;
}