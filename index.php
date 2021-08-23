<?php
include 'app/config/config.php';

$choferController = new ChoferController();
$chofer = $choferController->get(8);
$imagen = $choferController->getImagen();
verEstructura($chofer);
die();
