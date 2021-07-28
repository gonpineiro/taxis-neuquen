<?php

/**
 * This is the model class for table "Habilitaciones".
 */
class Habilitacion extends Base
{
    public function list($params)
    {
        $params['action'] = 0;
        return $this->callWebService($params)[0];
    }
}
