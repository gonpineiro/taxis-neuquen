<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function get($param)
    {
        $this->chofer = new Chofer($param);
        return [
            'chofer' => $this->chofer->getChofer(),
            'tipo_documento' => $this->chofer->getTipoDocumento(),
            'documento' => $this->chofer->getDocumento(),
            'documento_renaper' => $this->chofer->getDocumentoRenaper(),
        ];
    }

    public function getImagen()
    {
        return $this->chofer->getImagenRenaper();
    }
}
