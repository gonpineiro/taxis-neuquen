<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;
    public $codigoQr;

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
}
