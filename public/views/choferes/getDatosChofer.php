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
    $chofer = $choferController->get($dato->id)[0];
    echo (json_encode($chofer));
    exit();
} else {
    header("HTTP/1.1 404");
}
