<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;
    public $imagen;
    public $codigoQr;

    public function __construct(int $conductorID)
    {
        $params = ['action' => 1, 'conductorID' => $conductorID];
        $this->chofer = $this->callWebService($params);
        $this->extractDoc($this->chofer[0]['conductorIdentificacion']);
        $this->formatDate();
    }

    public function getChofer()
    {
        return $this->chofer;
    }

    private function formatDate()
    {
        $timestamp = strtotime($this->chofer[0]['fechaOtorgamiento']);
        $this->chofer[0]['fechaOtorgamiento'] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->chofer[0]["fechaVencimiento"]);
        $this->chofer[0]['fechaVencimiento'] = date('d/m/Y', $timestamp);

        $timestamp = strtotime($this->chofer[0]["fechaVencimientoLicencia"]);
        $this->chofer[0]["fechaVencimientoLicencia"] = date('d/m/Y', $timestamp);
    }

    public function getImagenRenaper()
    {
        $this->imagen = getImageByRenaper(['genero' => 'M', 'dni' => $this->documento_renaper]);
        if ($this->imagen == null) {
            $this->imagen = getImageByRenaper(['genero' => 'F', 'dni' => $this->documento_renaper]);
        }
        return $this->imagen;
    }
    public function getQrChofer(){
        $this->codigoQr = getCodigoQr($this->chofer[0]["conductorID"]);
        return $this->codigoQr;
    }
}
