<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("HTTP/1.1 200 OK");
    $dato = json_decode(file_get_contents('php://input'));


    echo (json_encode($dato));
    exit();
} else {
    header("HTTP/1.1 404");
}
