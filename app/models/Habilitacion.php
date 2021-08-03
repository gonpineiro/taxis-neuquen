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
        $this->habilitacion = array_values($this->limpiarHabilitacion())[0];
        if ($this->habilitacion["habTipo"] === 'TAX' || $this->habilitacion["habTipo"] === 'REM') {
            $this->extractDoc($this->habilitacion['titularEmpresa']);
            $this->formatDate();
        } else {
            $this->habilitacion = null;
        }
    }

    public function getHabilitacion()
    {
        return $this->habilitacion;
    }

    private function formatDate()
    {
        $timestamp = strtotime($this->habilitacion["habFechaAlta"]);
        $this->habilitacion["habFechaAlta"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion["habFechaVencimiento"]);
        $this->habilitacion["habFechaVencimiento"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion["rtoFechaVencimiento"]);
        $this->habilitacion["rtoFechaVencimiento"] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->habilitacion["polizaFechaVencimiento"]);
        $this->habilitacion["polizaFechaVencimiento"] = date('d/m/Y', $timestamp);
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
