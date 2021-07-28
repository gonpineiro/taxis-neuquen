<?php

class HabilitacionController
{
    /* Busca todas las habilitaciones */
    public function get($param)
    {
        $habilitacion = new Habilitacion();
        return $habilitacion->list($param);
    }
}
