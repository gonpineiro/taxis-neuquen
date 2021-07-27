<?php
include 'app/config/config.php';
$habilitacionController = new HabilitacionController();
$habilitaciones = $habilitacionController->index();
$choferesController = new ChoferController();
$choferes = $choferesController->index();
die();
