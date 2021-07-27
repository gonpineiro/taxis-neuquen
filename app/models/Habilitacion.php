<?php

/**
 * This is the model class for table "Habilitaciones".
 */
class Habilitacion extends Base
{
    public static function list($params)
    {
        return self::callWebService($params);
    }
}
