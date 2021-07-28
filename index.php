<?php
include 'app/config/config.php';
$habilitacionController = new HabilitacionController();
$habilitaciones = $habilitacionController->index(['patente' => 'OPC-656']);
verEstructura($habilitaciones);
die();
