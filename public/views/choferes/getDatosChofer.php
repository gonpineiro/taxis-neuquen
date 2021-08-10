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
    $choferController = new ChoferController();
    $datosChofer = $choferController->get($dato->id);
    $datosChofer['qr_url'] = QR_URL;

    $imagen = $choferController->getImagen();
    $qr = $choferController->getQrChofer();
    $datosChofer['qr'] = $qr;
    $datosChofer['imagen'] = $imagen;
    echo (json_encode($datosChofer));
    exit();
} else {
    header("HTTP/1.1 404");
}
