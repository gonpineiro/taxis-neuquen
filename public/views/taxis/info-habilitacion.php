<?PHP
include '../../../app/config/config.php';
$habilitaciónController = new HabilitacionController();

if ($_GET['patente']) {
    $dato = $_GET['patente'];
    $datosHabilitacion = $habilitaciónController->get($dato);
    // print_r($datosHabilitacion);
    if ($datosHabilitacion['documento_renaper'] != null) {
        $datosHabilitacion['imagen'] =
            $habilitaciónController->getImagen();
    } else {
        $datosHabilitacion['imagen'] = null;
    }
    $id = $datosHabilitacion['habilitacion'][0]['id'];
    $habTipo = $datosHabilitacion['habilitacion'][0]['habTipo'];
    $habNumero = $datosHabilitacion['habilitacion'][0]['habNumero'];
    $licenciaComercial = $datosHabilitacion['habilitacion'][0]['licenciaComercial'];
    $marcaVehiculo = $datosHabilitacion['habilitacion'][0]['marcaVehiculo'];
    $modelo = $datosHabilitacion['habilitacion'][0]['modelo'];
    $habFechaAlta = $datosHabilitacion['habilitacion'][0]['habFechaAlta'];
    $habFechaVencimiento = $datosHabilitacion['habilitacion'][0]['habFechaVencimiento'];
    $cambioTipo = $datosHabilitacion['habilitacion'][0]['cambioTipo'];
    $rtoID = $datosHabilitacion['habilitacion'][0]['rtoID'];
    $rtoFechaVencimiento = $datosHabilitacion['habilitacion'][0]['rtoFechaVencimiento'];
    $poliza = $datosHabilitacion['habilitacion'][0]['poliza'];
    $polizaFechaVencimiento = $datosHabilitacion['habilitacion'][0]['polizaFechaVencimiento'];
    $observacion = $datosHabilitacion['habilitacion'][0]['observacion'];
    $empresaID = $datosHabilitacion['habilitacion'][0]['empresaID'];
    $empresaNombre = $datosHabilitacion['habilitacion'][0]['empresaNombre'];
    $titularEmpresa = $datosHabilitacion['habilitacion'][0]['titularEmpresa'];
    $titularIdentificacion = $datosHabilitacion['habilitacion'][0]['titularIdentificacion'];
    $tipo_documento = $datosHabilitacion['tipo_documento'];
    $documento = $datosHabilitacion['documento'];
    // documento_dni trae el dato cuando tipo_documento es dni
    $documento_dni = $datosHabilitacion['documento_renaper'];
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
    <div class="container mb-3">
        <div class="datos-perfil">
            <div class="card-body">
                <div class="">
                    <h3>Datos Licencia</h3>
                    <h5>Habilitación Nº <?= $id ?></h5>
                    <hr>
                    <div class="row">
                        <div class="form-group col-xs-6 col-md-4">
                            <label class="text-dark">Tipo Habilitación</label>
                            <input type="text" class="form-control" value="<?= $habTipo ?>" id="tipo-hab" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-md-4">
                            <label class="text-dark">Tipo Habilitación</label>
                            <input type="text" class="form-control" value="<?= $habTipo ?>" id="tipo-hab" disabled readonly />
                        </div>
                    </div>
                    <p class="text-dark">habNumero <?PHP if ($habTipo == "TAX") {
                                                        echo "TAXI";
                                                    }
                                                    if ($habTipo == "REM") {
                                                        echo "REMISSE";
                                                    } ?></p>
                    <p class="text-dark">licenciaComercial <?= $licenciaComercial ?></p>
                    <p class="text-dark">marcaVehiculo <?= $marcaVehiculo ?></p>
                    <p class="text-dark">modelo <?= $modelo ?></p>
                    <p class="text-dark">habFechaAlta <?= $habFechaAlta ?></p>
                    <p class="text-dark">habFechaVencimiento <?= $habFechaVencimiento ?></p>
                    <p class="text-dark">cambioTipo <?= $cambioTipo ?></p>
                    <p class="text-dark">rtoID <?= $rtoID ?></p>
                    <p class="text-dark">rtoFechaVencimiento <?= $rtoFechaVencimiento ?></p>
                    <p class="text-dark">poliza <?= $poliza ?></p>
                    <p class="text-dark">polizaFechaVencimiento <?= $polizaFechaVencimiento ?></p>
                    <p class="text-dark">observacion <?= $observacion ?></p>
                    <h3>Responsable Licencia</h3>

                    <p class="text-dark">empresaID <?= $empresaID ?></p>
                    <p class="text-dark">empresaNombre <?= $empresaNombre ?></p>
                    <p class="text-dark">titularEmpresa <?= $titularEmpresa ?></p>
                    <p class="text-dark">titularIdentificacion <?= $titularIdentificacion ?></p>
                    <p class="text-dark">tipo_documento <?= $tipo_documento ?></p>
                    <p class="text-dark">documento <?= $documento ?></p>
                    <p class="text-dark">documento_dni <?= $documento_dni ?></p>



                </div>
                <hr>
                <img class="rounded mx-auto d-block shadow-sm img-fluid m-3" style="max-width: 40%;" src="<?= $imagen ?>" alt="">

            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</body>

</html>