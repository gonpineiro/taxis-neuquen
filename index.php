<?php
include 'app/config/config.php';
$habilitacionController = new HabilitacionController();
$habilitaciones = $habilitacionController->get('AE-168-AQ');

$choferController = new ChoferController();
$chofer = $choferController->get(3816);
$imagen = $choferController->getImagen();

verEstructura($habilitaciones);
verEstructura($chofer);
die();
