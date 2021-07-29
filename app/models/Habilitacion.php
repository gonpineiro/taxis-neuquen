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
    }

    public function getHabilitacion()
    {
        return $this->habilitacion;
    }
}
