<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function get($param)
    {
        $chofer = new Chofer($param);
        return [
            'chofer' => $chofer->getChofer(),
            'tipo_documento' => $chofer->getTipoDocumento(),
            'documento' => $chofer->getDocumento(),
            'documento_renaper' => $chofer->getDocumentoRenaper(),
        ];
    }
}
