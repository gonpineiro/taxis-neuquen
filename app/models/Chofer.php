<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;
    public $codigoQr;
    private $errorColaApi = "Licencia en cola de consulta, intente nuevamente!";
    private $errorDoc = "No hay registros con ese número de DNI";

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
        
        if ($licencia == $this->errorColaApi) return $this->errorColaApi;        
        if ($licencia == $this->errorDoc) return $this->errorDoc;

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
        $params = ['action' => 2, 'documento' => /* $this->documento_renaper */ 845];

        $intentos = 0;
        do {
            try {
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
                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response, true)['value'];

                switch ($response[0]['status']) {
                    case null:
                        return $response;
                        break;
                    case $this->errorColaApi:
                        $intentos++;
                        break;
                    case $this->errorDoc:
                        return $this->errorDoc;
                        break;
                }
            } catch (Exception $e) {
                return $e;
            }
        } while ($intentos < 3);
        return $this->errorColaApi;
    }
}
