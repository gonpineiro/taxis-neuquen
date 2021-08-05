<?php
include 'app/config/config.php';

die();
$habilitacionController = new HabilitacionController();
$habilitaciones = $habilitacionController->get('AA-144-PM');
if ($habilitaciones['documento_renaper'] != null) {
    $datosTahabilitacionesxi['imagen'] = $habilitacionController->getImagen();
} else {
    $habilitaciones['imagen'] = null;
}
die();
$choferController = new ChoferController();
$chofer = $choferController->get(3816);
$imagen = $choferController->getImagen();
verEstructura($habilitaciones);
verEstructura($chofer);
die();
