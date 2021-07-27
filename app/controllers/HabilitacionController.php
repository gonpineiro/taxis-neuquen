<?php

class HabilitacionController
{
    /* Guarda una habilitacion */
    public function store($res)
    {
        $habilitacion = new Habilitacion();
        return $habilitacion->save();
    }

    /* Busca todas las habilitaciones */
    public static function index($param = [], $ops = [])
    {
        return Habilitacion::list($param, $ops);
    }

    /* Busca una habilitacion */
    public static function get($params)
    {
        return Habilitacion::get($params);
    }

    /* Actualiza una habilitacion */
    public static function update($res, $id)
    {
        return Habilitacion::update($res, $id);
    }
}
