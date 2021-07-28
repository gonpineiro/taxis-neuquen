<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function index($param)
    {
        $chofer = new Chofer();
        return $chofer->list($param);
    }

    /* Busca una chofer */
    public static function get($params)
    {
        // return Habilitacion::get($params);
    }
}
