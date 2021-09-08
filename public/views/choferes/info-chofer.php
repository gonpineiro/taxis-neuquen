<?PHP
include '../../../app/config/config.php';
$choferController = new ChoferController();

if ($_GET['numero']) {
    $habilitacion = $_GET['numero'];
    $datosChofer = $choferController->get($habilitacion);
    $imagen = $choferController->getImagen();
    $nombre = $datosChofer['chofer']['conductorRazonSocial'];
    $documento = $datosChofer['chofer']['conductorIdentificacion'];
    $tipoDoc = $datosChofer['tipo_documento'];
    $numDoc =  $datosChofer['documento_renaper'];
    $credencial = $datosChofer['chofer']['conductorID'];
    $fechaOtorgamiento = $datosChofer['chofer']['fechaOtorgamiento'];
    $fechaVencimiento = $datosChofer['chofer']['fechaVencimiento'];
    $observaciones = $datosChofer['chofer']['observaciones'];
    $fechaVencimientoLicencia = $datosChofer['chofer']['fechaVencimientoLicencia'];
    if ($datosChofer['datos_licencia'] == "error_api_licencia") {
        $tipoLicencia = "Sin datos por el momento.";
        $fechaVencimientoLicencia = "Sin datos por el momento.";
    } else {
        $tipoLicencia = $datosChofer['datos_licencia']['subclaseID'];
        $fechaVencimientoLicencia = $datosChofer['datos_licencia']['fechaVigencia'];
    }
    if ($datosChofer['autos_habilitados'] != null) {
        $habilitacionesAutos = $datosChofer['autos_habilitados'];
    }
} else {
    echo "Error";
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
    <div class="container mb-3">
        <div class="datos-perfil">
            <div class="card-body">
                <?PHP
                if ($datosChofer['autos_habilitados'] != null) {
                ?>
                    <div class="container">
                        <h5 class="pb-3 text-center" style="font-size: 1.2rem;">Autos Habilitados</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Dominio</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col" class="text-center" style="width:50px">Modelo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?PHP
                                    foreach ($datosChofer['autos_habilitados'] as $habilitacion) {
                                    ?>
                                        <tr>
                                            <td><?= $habilitacion['vehiculoDominio'] ?></td>
                                            <td><?= $habilitacion['vehiculoMarca'] ?></td>
                                            <td class="text-center" style="width:50px"><?= $habilitacion['vehiculoModelo'] ?></td>
                                        </tr>
                                    <?PHP
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?PHP
                }
                ?>
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