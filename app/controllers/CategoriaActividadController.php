<?php

class CategoriaActividadController
{
    /* Guarda un cat_actividad */
    public function store($res)
    {
        $cat_actividad = new CategoriaActividad();
        $cat_actividad->set(...array_values($res));
        return $cat_actividad->save();
    }

    /* Busca todos los cat_actividad */
    public static function index($param = [], $ops = [])
    {
        return CategoriaActividad::list($param, $ops);
    }

    /* Busca un cat_actividad */
    public static function get($params)
    {
        return CategoriaActividad::get($params);
    }

    /* Actualiza un cat_actividad */
    public static function update($res, $id)
    {
        return CategoriaActividad::update($res, $id);
    }
}
