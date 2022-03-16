<?php

class ChoferController
{
    /* Busca todas las choferes */
    public function get($param)
    {
        $this->chofer = new Chofer($param);
        $chofer = $this->chofer->getChofer();
        $tipo_documento = $this->chofer->getTipoDocumento();
        $documento = $this->chofer->getDocumento();
        $documento_renaper = $this->chofer->getDocumentoRenaper();
        $datos_licencia = $this->chofer->getDatosLicencia();
        $autos_habilitados = $this->chofer->getAutosHabilitados();

        return [
            'chofer' => $chofer,
            'tipo_documento' => $tipo_documento,
            'documento' => $documento,
            'documento_renaper' => $documento_renaper,
            'datos_licencia' => $datos_licencia,
            'autos_habilitados' => $autos_habilitados
        ];
    }

    public function getImagen()
    {
        return $this->chofer->getImagenRenaper();
    }
    public function getQrChofer()
    {
        return $this->chofer->getQrChofer();
    }
}
