<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public $chofer;

    public function __construct(int $conductorID)
    {
        $params = ['action' => 1, 'conductorID' => $conductorID];
        $this->chofer = $this->callWebService($params);
        $this->extractDoc($this->chofer[0]['conductorIdentificacion']);
    }

    public function getChofer()
    {
        return $this->chofer;
    }
}
