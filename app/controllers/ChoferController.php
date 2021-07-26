<?php

class ChoferController
{
    /* Guarda un chofer */
    public function store($res)
    {
        $chofer = new Chofer();
        return $chofer->save();
    }

    /* Busca todos los chofer */
    public static function index($param = [], $ops = [])
    {
        return Chofer::list($param, $ops);
    }

    /* Busca un chofer */
    public static function get($params)
    {
        return Chofer::get($params);
    }

    /* Actualiza un chofer */
    public static function update($res, $id)
    {
        return Chofer::update($res, $id);
    }
}
