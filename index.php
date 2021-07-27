<?php
include 'app/config/config.php';
$habilitacionController = new HabilitacionController();
$habilitaciones = $habilitacionController->index(['patente' => 'OPC-656', 'action' => 0]);
verEstructura($habilitaciones);
die();
