<?php

/**
 * This is the model class for table "Habilitaciones".
 *  @property string $url
 */
class Habilitacion extends Base
{
    public static function list($params)
    {
        return self::callWebService($params);
    }
}
