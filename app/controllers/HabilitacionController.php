<?php

class HabilitacionController
{
    /* Busca todas las habilitaciones */
    public function index($param)
    {
        $habilitacion = new Habilitacion();
        return $habilitacion->list($param);
    }

    /* Busca una habilitacion */
    public static function get($params)
    {
        // return Habilitacion::get($params);
    }
}
