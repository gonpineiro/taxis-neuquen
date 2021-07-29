<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("HTTP/1.1 200 OK");
    $dato = json_decode(file_get_contents('php://input'));
    $choferController = new ChoferController();
    $datosChofer = $choferController->get($dato);
    
    echo (json_encode($datosChofer['chofer'][0]));
    exit();
} else {
    header("HTTP/1.1 404");
}
