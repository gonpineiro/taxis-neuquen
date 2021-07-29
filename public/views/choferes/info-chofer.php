<?PHP
include '../../../app/config/config.php';
$choferController = new ChoferController();

if ($_GET['numero']) {
    $dato = $_GET['numero'];
    $datosChofer = $choferController->get($dato);
    $imagen = $choferController->getImagen();
    $nombre = $datosChofer['chofer'][0]['conductorRazonSocial'];
    $documento = $datosChofer['chofer'][0]['conductorIdentificacion'];
    $tipoDoc = $datosChofer['tipo_documento'];
    $numDoc =  $datosChofer['documento'];
    $credencial = $datosChofer['chofer'][0]['conductorID'];
    $tipoLicencia = $datosChofer['chofer'][0]['tipoLicencia'];
    $fechaOtorgamiento = $datosChofer['chofer'][0]['fechaOtorgamiento'];
    $fechaVencimiento = $datosChofer['chofer'][0]['fechaVencimiento'];
    $fechaVencimientoLicencia = $datosChofer['chofer'][0]['fechaVencimientoLicencia'];
    $observaciones = $datosChofer['chofer'][0]['observaciones'];
    $fechaVencimientoLicencia = $datosChofer['chofer'][0]['fechaVencimientoLicencia'];
} else {
    echo "Error en la búsqueda de datos";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../estilos/menu/menu.css">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <title>Administración de Habilitaciones de Transporte Público Neuquén</title>
</head>

<body>
    <img style="width:100%" src="../../estilos/libreta/banner.jpeg" />
    <!-- <h4 class="text-center mt-4">Datos del Chofer</h4> -->
    <img class="rounded mx-auto d-block shadow-sm img-fluid m-3" style="max-width: 50%;" src="<?= $imagen ?>" alt="">
    <div class="container text-center">
        <h3 class=""><?= $nombre ?></h3>
        <h4><?= $documento ?></h4>
        <hr>
        <h5>Credencial: <?= $credencial ?></h5>
        <p>Fecha Otorgamiento: <?= $fechaOtorgamiento ?></p>
        <p>Fecha Vencimiento: <?= $fechaVencimiento ?></p>
        <h5>Licencia Conducir: <?= $tipoLicencia ?></h5>
        <p>Fecha Vencimiento Licencia: <?= $fechaVencimientoLicencia ?></p>
    </div>




    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="datos-choferes.js"></script>
</body>

</html>