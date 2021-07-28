<?php

/**
 * This is the model class for table "Habilitaciones".
 */
class Habilitacion extends Base
{
    public function list(string $patente)
    {
        $params = ['action' => 0, 'conductorID' => $patente];
        return $this->callWebService($params)[0];
    }
}
