<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer extends Base
{
    public function list(int $conductorID)
    {
        $params = ['action' => 1, 'conductorID' => $conductorID];
        return $this->callWebService($params);
    }
}
