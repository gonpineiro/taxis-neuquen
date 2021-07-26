<?php

class CiudadController
{
    /* Guarda un ciudad */
    public function store($res)
    {
        $ciudad = new Ciudad();
        $ciudad->set(...array_values($res));
        return $ciudad->save();
    }

    /* Busca todos los ciudad */
    public static function index($param = [], $ops = [])
    {
        return Ciudad::list($param, $ops);
    }

    /* Busca un ciudad */
    public static function get($params)
    {
        return Ciudad::get($params);
    }

    /* Actualiza un ciudad */
    public static function update($res, $id)
    {
        return Ciudad::update($res, $id);
    }
}
