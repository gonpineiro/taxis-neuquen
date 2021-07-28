<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function get($param)
    {
        $chofer = new Chofer();
        return $chofer->list($param);
    }
}
