<?php

/**
 * This is the model class for table "Habilitaciones".
 * @property array $habilitacion
 */
class Habilitacion extends Base
{
    public $habilitacion;

    public function __construct(string $patente)
    {
        $params = ['action' => 0, 'patente' => $patente];
        $this->habilitacion = $this->callWebService($params);
        $this->extractDoc($this->habilitacion[0]['titularEmpresa']);
        $this->formatDate();
        $this->habilitacion = $this->limpiarHabilitacion();
    }

    public function getHabilitacion()
    {
        return $this->habilitacion;
    }

    private function formatDate()
    {
        $timestamp = strtotime($this->habilitacion[0]["habFechaAlta"]);
        $this->habilitacion[0]["habFechaAlta"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion[0]["habFechaVencimiento"]);
        $this->habilitacion[0]["habFechaVencimiento"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion[0]["rtoFechaVencimiento"]);
        $this->habilitacion[0]["rtoFechaVencimiento"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion[0]["polizaFechaVencimiento"]);
        $this->habilitacion[0]["polizaFechaVencimiento"] = date('d/m/Y', $timestamp);
    }

    private function limpiarHabilitacion()
    {
        if (count($this->habilitacion) > 1) {
            return array_filter($this->habilitacion, function ($habilitacion) {
                if ($this->existeTipoEnString($habilitacion['titularEmpresa'])) {
                    return $habilitacion;
                }
            });
        } else {
            return $this->habilitacion;
        }
    }
    private function existeTipoEnString($string)
    {
        $documentoTipos = array('CUIT:', 'CUIL:', 'PQCNT:', 'LE:', 'DNI:', 'SC:');
        foreach ($documentoTipos as $token) {
            if (stristr($string, $token) !== false) {
                return true;
            }
        }
        return false;
    }
}
