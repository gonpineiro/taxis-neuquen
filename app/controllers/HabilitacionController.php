<?php

class HabilitacionController
{
    /* Busca todas una habilitacion */
    public function get($param)
    {
        $habilitacion = new Habilitacion($param);
        return [
            'habilitacion' => $habilitacion->getHabilitacion(),
            'tipo_documento' => $habilitacion->getTipoDocumento(),
            'documento' => $habilitacion->getDocumento(),
            'documento_renaper' => $habilitacion->getDocumentoRenaper(),
        ];
    }
}
