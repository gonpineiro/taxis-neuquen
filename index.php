<?php
include 'app/config/config.php';

$choferController = new ChoferController();
$chofer = $choferController->get(3816);
$imagen = $choferController->getImagen();
verEstructura($chofer);
die();
