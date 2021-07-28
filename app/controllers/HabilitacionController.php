<?php

class HabilitacionController
{
    /* Busca todas las habilitaciones */
    public function get($param)
    {
        $habilitacion = new Habilitacion($param);
        return $habilitacion->get();
    }

    /* Busca todas las habilitaciones */
    public function getDocumento($param)
    {
        $habilitacion = new Habilitacion($param);
        return $habilitacion->documento;
    }
}
