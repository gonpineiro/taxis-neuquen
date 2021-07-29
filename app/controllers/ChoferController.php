<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function get($param)
    {
        $chofer = new Chofer($param);
        return $chofer->getChofer();
    }
}
