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
}
