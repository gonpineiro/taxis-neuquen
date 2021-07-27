<?php

/**
 * This is the model class for table "Habilitaciones".
 */
class Habilitacion extends Base
{
    public function list($params)
    {
        return $this->callWebService($params)[0];
    }
}
