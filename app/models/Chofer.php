<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;
    public $codigoQr;
    private $conductorID;

    public function __construct(int $conductorID)
    {
        $this->conductorID = $conductorID;
        $params = ['action' => 1, 'conductorID' => $conductorID];
        $this->chofer = $this->callWebService($params, API_URL)['value'][0];
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
        $obs = [
            'cola_api' => "Licencia en cola de consulta, intente nuevamente!",
            'documento_ine' => "No hay registros con ese número de DNI",
            'api_licencia' => 'error_api_licencia'
        ];

        $params = ['action' => 2, 'documento' => $this->documento_renaper];

        $intentos = 0;
        do {
            $response = $this->callWebService($params, API_URL_LIC);

            if (!is_null($response['error'])) return $obs['api_licencia'];

            $response = $response['value'];

            if ($response[0]['status'] == $obs['documento_ine']) return $obs['documento_ine'];

            if ($response[0]['status'] == $obs['cola_api']) {
                $intentos++;
                continue;
            };

            if (is_null($response[0]['status'])) {

                if (count($response) > 1) {
                    /* Filtramos el arreglo para traiga a la persona correspondiente */
                    $licencia = array_filter($response, function ($array) {
                        $apellidoLicencia = explode(',', $array['razonSocial'])[0];
                        $apellidoChofer = explode(',', $this->chofer["conductorRazonSocial"])[0];
                        return $apellidoLicencia == $apellidoChofer;
                    });
                } else {
                    $licencia = $response[0]['licencia'];
                }

                if (is_array($licencia['subclaseID'])) {
                    $licencia['subclaseID'] = implode(' - ', $licencia['subclaseID']);
                }

                $timestamp = strtotime($licencia["fechaEmision"]);
                $licencia["fechaEmision"] = date('d/m/Y', $timestamp);

                $timestamp = strtotime($licencia["fechaVigencia"]);
                $licencia["fechaVigencia"] = date('d/m/Y', $timestamp);

                if ($intentos > 0) {
                    $logMsg = "[Intentos] : Se obtuvo los datos despues de $intentos intentos | Documento: $this->documento_renaper";
                    cargarLogFile('api_lic', $logMsg, get_class(), __FUNCTION__);
                }
                return $licencia;
            }
        } while ($intentos < 3);

        $logMsg = "[Intentos] : Exedio limite de tres intentos | Documento: $this->documento_renaper";
        cargarLogFile('api_lic', $logMsg, get_class(), __FUNCTION__);

        return $obs['api_licencia'];
    }

    public function getAutosHabilitados()
    {
        $params = ['action' => 4, 'conductorID' => $this->conductorID];

        $response = $this->callWebService($params, API_URL_LIC);

        if ($response['error'] == 'Sin información') {
            return null;
        }

        $response = $response['value'];
        $autos = [];
        $allowed = ['habilitacionNumero', 'habilitacionTipo', 'vehiculoDominio', 'vehiculoMarca', 'vehiculoModelo'];
        foreach ($response as $auto) {
            $filtered = array_filter(
                $auto,
                function ($key) use ($allowed) {
                    return in_array($key, $allowed);
                },
                ARRAY_FILTER_USE_KEY
            );
            array_push($autos, $filtered);
        }
        return $autos;
    }
}
