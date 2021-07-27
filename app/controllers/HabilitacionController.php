<?php

class HabilitacionController
{
    /* Busca todas las habilitaciones */
    public static function index($param = [], $ops = [])
    {
        return Habilitacion::list($param, $ops);
    }

    /* Busca una habilitacion */
    public static function get($params)
    {
        // return Habilitacion::get($params);
    }
}
