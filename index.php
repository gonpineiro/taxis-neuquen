<?php
include 'app/config/config.php';

$choferController = new ChoferController();
$chofer = $choferController->get(1512);
$imagen = $choferController->getImagen();
verEstructura($chofer);
die();
