<?php

/**
 * This is the model class for table "Habilitaciones".
 * @property array $habilitacion
 * @property string $tipo_documento
 * @property string $documento
 * @property string $documento_renaper
 */
class Habilitacion extends Base
{
    public $habilitacion;
    public $tipo_documento;
    public $documento;
    public $documento_renaper;

    public function __construct(string $patente)
    {
        $params = ['action' => 0, 'patente' => $patente];
        $this->habilitacion = $this->callWebService($params);
        $this->extractDoc();
    }

    public function getHabilitacion()
    {
        return $this->habilitacion;
    }

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

    private function extractDoc()
    {
        $arrayDoc = explode(":", $this->habilitacion[0]['titularEmpresa']);
        $this->tipo_documento = $arrayDoc[0];
        $this->documento = $arrayDoc[1];
        switch ($arrayDoc[0]) {
            case "DNI":
            case "SC":
            case 'LE':
            case 'PQCNT':
                $this->documento = $arrayDoc[1];
                break;
            case 'CUIL':
                $this->documento_renaper = explode("-", $arrayDoc[1])[1];
                break;

            default:
                # code...
                break;
        }
    }
}
