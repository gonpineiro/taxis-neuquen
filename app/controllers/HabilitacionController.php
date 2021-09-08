<?php

class HabilitacionController
{
    /* Busca todas una habilitacion */
    public function get($habilitacionID, $habTipo)
    {
        $this->habilitacion = new Habilitacion($habilitacionID, $habTipo);
        return [
            'habilitacion' => $this->habilitacion->getHabilitacion(),
            'tipo_documento' => $this->habilitacion->getTipoDocumento(),
            'documento' => $this->habilitacion->getDocumento(),
            'documento_renaper' => $this->habilitacion->getDocumentoRenaper(),
        ];
    }

    public function getImagen()
    {
        return $this->habilitacion->getImagenRenaper();
    }
}
