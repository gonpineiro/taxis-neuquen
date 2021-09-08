<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['userProfiles'] != 3) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("HTTP/1.1 200 OK");
    $dato = json_decode(file_get_contents('php://input'));
    $habilitacionController = new HabilitacionController();
    $datosTaxi = $habilitacionController->get($dato->habilitacionID, $dato->habTipo);
    $datosTaxi['qr_url'] = QR_URL;
    if ($datosTaxi['habilitacion'] == null) {
        echo (json_encode(null));
        exit();
    }
    if ($datosTaxi['documento_renaper'] != null) {
        $datosTaxi['imagen'] = $habilitacionController->getImagen();
    } else {
        $datosTaxi['imagen'] = null;
    }
    echo (json_encode($datosTaxi));
    exit();
} else {
    header("HTTP/1.1 404");
}
