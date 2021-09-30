<?php

/**
 * This is the model class for table "Habilitaciones".
 *  @property string $url
 */
class Base
{
    protected $headers = ["Content-type: application/json", "Authorization: Bearer " . API_TOKEN];
    protected $tipo_documento;
    protected $documento;
    protected $documento_renaper;
    public $imagen;

    public function getTipoDocumento()
    {
        return $this->tipo_documento;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    public function getDocumentoRenaper()
    {
        return $this->documento_renaper;
    }

    public function getImagenRenaper()
    {
        $this->imagen = getImageByRenaper(['genero' => 'M', 'dni' => $this->documento_renaper]);
        if ($this->imagen == null) {
            $this->imagen = getImageByRenaper(['genero' => 'F', 'dni' => $this->documento_renaper]);
        }
        return $this->imagen;
    }

    protected function callWebService(array $params, string $url, string $method = 'POST')
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTPHEADER => $this->headers,
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYPEER => SSL_VERIFYPEER,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        } catch (Exception $e) {
            cargarLogFile('llamada_web_service', 'Hubo un error a la hora de llamar el webService', get_class(), __FUNCTION__);
            return $e;
        }
    }

    /**
     * Extrae del objeto, datos de la documentacion en función del tipo de documento que obtiene.
     * 
     *  $tipo_documento, $documento, $documento_renaper
     */
    protected function extractDoc($doc)
    {
        $arrayDoc = explode(":", $doc);
        $this->tipo_documento = $arrayDoc[0];
        $this->documento = $arrayDoc[1];
        switch ($arrayDoc[0]) {
            case "SC":
                $this->documento = $arrayDoc[1];
            case 'PQCNT':
                $this->documento = $arrayDoc[1];
                break;
            case 'LE':
                $this->documento_renaper = $this->documento;
                break;
            case "DNI":
                $this->documento_renaper = $this->documento;
                break;
            case 'CUIL':
                $this->documento_renaper = explode("-", $arrayDoc[1])[1];
                break;
            case 'CUIT':
                $this->documento_renaper = explode("-", $arrayDoc[1])[1];
                break;
        }
    }
}
