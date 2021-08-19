<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;
    public $codigoQr;
    private $errores = [
        'cola_api' => "Licencia en cola de consulta, intente nuevamente!",
        'documento_ine' => "No hay registros con ese número de DNI",
        'api_licencia' => 'error_api_licencia'
    ];

    public function __construct(int $conductorID)
    {
        $params = ['action' => 1, 'conductorID' => $conductorID];
        $this->chofer = $this->callWebService($params)[0];
        $this->extractDoc($this->chofer['conductorIdentificacion']);
        $this->formatDate();
    }

    public function getChofer()
    {
        return $this->chofer;
    }

    private function formatDate()
    {
        $timestamp = strtotime($this->chofer['fechaOtorgamiento']);
        $this->chofer['fechaOtorgamiento'] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->chofer["fechaVencimiento"]);
        $this->chofer['fechaVencimiento'] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->chofer["fechaVencimientoLicencia"]);
        $this->chofer["fechaVencimientoLicencia"] = date('d/m/Y', $timestamp);
    }

    public function getQrChofer()
    {
        $this->codigoQr = getCodigoQr($this->chofer["conductorID"]);
        return $this->codigoQr;
    }

    public function getDatosLicencia()
    {
        $licencia = $this->getDatosLicenciaApi();

        if ($licencia == $this->errores['cola_api']) return $this->errores['api_licencia'];
        if ($licencia == $this->errores['documento_ine']) return $this->errores['documento_ine'];

        /* Filtramos el arreglo para traiga a la persona correspondiente */
        $licencia = array_filter($licencia, function ($array) {
            $apellidoLicencia = explode(',', $array['razonSocial'])[0];
            $apellidoChofer = explode(',', $this->chofer["conductorRazonSocial"])[0];
            return $apellidoLicencia == $apellidoChofer;
        })[0]['licencia'];

        if (is_array($licencia['subclaseID'])) {
            $licencia['subclaseID'] = implode(' - ', $licencia['subclaseID']);
        }

        $timestamp = strtotime($licencia["fechaEmision"]);
        $licencia["fechaEmision"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($licencia["fechaVigencia"]);
        $licencia["fechaVigencia"] = date('d/m/Y', $timestamp);

        return $licencia;
    }

    private function getDatosLicenciaApi(string $method = 'POST')
    {
        $params = ['action' => 2, 'documento' => $this->documento_renaper];
        $intentos = 0;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL_LIC,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ));

        do {
            try {
                $response = curl_exec($curl);                

                /* Verificamos que no haya error de conexion */
                if (!is_null(json_decode($response, true)['error'])) {
                    return $this->errores['api_licencia'];
                }

                $response = json_decode($response, true)['value'];
                $response[0]['status'] = "Licencia en cola de consulta, intente nuevamente!";
                switch ($response[0]['status']) {
                    case null:
                        curl_close($curl);
                        return $response;
                        break;
                    case $this->errores['cola_api']:
                        $intentos++;
                        break;
                    case $this->errores['documento_ine']:
                        curl_close($curl);
                        return $this->errores['documento_ine'];
                        break;
                }
            } catch (Exception $e) {
                return $e;
            }
        } while ($intentos < 3);
        curl_close($curl);
        return $this->errores['cola_api'];
    }
}
