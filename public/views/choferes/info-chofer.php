<?PHP
include '../../../app/config/config.php';
$choferController = new ChoferController();

if ($_GET['numero']) {
    $dato = $_GET['numero'];
    $datosChofer = $choferController->get($dato);
    $imagen = $choferController->getImagen();
    $nombre = $datosChofer['chofer']['conductorRazonSocial'];
    $documento = $datosChofer['chofer']['conductorIdentificacion'];
    $tipoDoc = $datosChofer['tipo_documento'];
    $numDoc =  $datosChofer['documento_renaper'];
    $credencial = $datosChofer['chofer']['conductorID'];
    $tipoLicencia = $datosChofer['chofer']['tipoLicencia'];
    $fechaOtorgamiento = $datosChofer['chofer']['fechaOtorgamiento'];
    $fechaVencimiento = $datosChofer['chofer']['fechaVencimiento'];
    $fechaVencimientoLicencia = $datosChofer['chofer']['fechaVencimientoLicencia'];
    $observaciones = $datosChofer['chofer']['observaciones'];
    $fechaVencimientoLicencia = $datosChofer['chofer']['fechaVencimientoLicencia'];
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
    <img class="p-3" style="width:100%" src="../../estilos/libreta/banner.svg" />
    <!-- <h4 class="text-center mt-4">Datos del Chofer</h4> -->
    <div class="container mb-3">
        <div class="datos-perfil">
            <div class="card-body">
                <img class="rounded mx-auto d-block shadow-sm img-fluid m-3" style="max-width: 40%;" src="<?= $imagen ?>" alt="">
                <div class="container text-center">
                    <h3 style="font-size:1.5rem"><?= $nombre ?></h3>
                    <h4 style="font-size:1.2rem">DNI: <?= $numDoc ?></h4>
                    <h5 style="font-size: 1rem;">Credencial: <?= $credencial ?></h5>
                    <p class="text-dark" style="font-size: 0.8rem;">Fecha Otorgamiento: <?= $fechaOtorgamiento ?></p>
                    <p class="text-dark" style="font-size: 0.8rem;">Fecha Vencimiento: <?= $fechaVencimiento ?></p>
                    <h5 style="font-size: 1rem;">Licencia Conducir: <?= $tipoLicencia ?></h5>
                    <p class="text-dark" style="font-size: 0.8rem;">Fecha Vencimiento Licencia: <?= $fechaVencimientoLicencia ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="datos-choferes.js"></script>
</body>

</html>