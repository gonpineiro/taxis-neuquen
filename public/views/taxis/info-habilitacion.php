<?PHP
include '../../../app/config/config.php';
$habilitaciónController = new HabilitacionController();

if ($_GET['habid'] && $_GET['habtipo']) {
    $habID = $_GET['habid'];
    $habTipo = $_GET['habtipo'];
    $datosHabilitacion = $habilitaciónController->get($habID, $habTipo);
    $numHabilitacion = $datosHabilitacion['habilitacion']['habNumero'];
    $patente = $datosHabilitacion['habilitacion']['patente'];
    $habTipo = $datosHabilitacion['habilitacion']['habTipo'];
    $habNumero = $datosHabilitacion['habilitacion']['habNumero'];
    $licenciaComercial = $datosHabilitacion['habilitacion']['licenciaComercial'];
    $marcaVehiculo = $datosHabilitacion['habilitacion']['marcaVehiculo'];
    $modelo = $datosHabilitacion['habilitacion']['modelo'];
    $habFechaAlta = $datosHabilitacion['habilitacion']['habFechaAlta'];
    $habFechaVencimiento = $datosHabilitacion['habilitacion']['habFechaVencimiento'];
    $cambioTipo = $datosHabilitacion['habilitacion']['cambioTipo'];
    $rtoID = $datosHabilitacion['habilitacion']['rtoID'];
    $rtoFechaVencimiento = $datosHabilitacion['habilitacion']['rtoFechaVencimiento'];
    $poliza = $datosHabilitacion['habilitacion']['poliza'];
    $polizaFechaVencimiento = $datosHabilitacion['habilitacion']['polizaFechaVencimiento'];

    $titularIdentificacion = $datosHabilitacion['habilitacion']['titularIdentificacion'];
    $tipo_documento = $datosHabilitacion['tipo_documento'];
    $documento = $datosHabilitacion['documento'];

    $empresaID = $datosHabilitacion['habilitacion']['empresaID'];

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
    <img class="p-3" style="width:100%" src="../../estilos/libreta/banner.svg" />
    <!-- <h4 class="text-center mt-4">Datos del Chofer</h4> -->
    <div class="container mb-3">
        <div class="datos-perfil">
            <div class="card-body">
                <div class="mt-3">
                    <h3>Datos Habilitación</h3>
                    <hr>
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Número Habilitación</label>
                            <input type="text" class="form-control" value="<?= $numHabilitacion ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Tipo Habilitación</label>
                            <input type="text" class="form-control" value="<?PHP if ($habTipo == "TAX") {
                                                                                echo "TAXI";
                                                                            }
                                                                            if ($habTipo == "REM") {
                                                                                echo "REMISSE";
                                                                            } ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Patente</label>
                            <input type="text" class="form-control" value="<?= $patente ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Marca Vehículo</label>
                            <input type="text" class="form-control" value="<?= $marcaVehiculo ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Modelo</label>
                            <input type="text" class="form-control" value="<?= $modelo ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Fecha Alta</label>
                            <input type="text" class="form-control" value="<?= $habFechaAlta ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Fecha Vencimiento</label>
                            <input type="text" class="form-control" value="<?= $habFechaVencimiento ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">RTO ID</label>
                            <input type="text" class="form-control" value="<?= $rtoID ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">RTO Vencimiento</label>
                            <input type="text" class="form-control" value="<?= $rtoFechaVencimiento ?>" disabled readonly />
                        </div>
                    </div>

                    <h3 class="mt-3">Responsable Habilitación</h3>
                    <hr>
                    <div class="row">
                        <img class="rounded mx-auto d-block shadow-sm img-fluid m-3" style="max-width: 40%;" src="<?= $foto_dni ?>" alt="">
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Nombre Titular/ Responsable</label>
                            <input type="text" class="form-control" value="<?= $titularIdentificacion ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Tipo Documento</label>
                            <input type="text" class="form-control" value="<?= $tipo_documento ?>" disabled readonly />
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                            <label class="text-dark">Número</label>
                            <input type="text" class="form-control" value="<?= $documento ?>" disabled readonly />
                        </div>

                        <?PHP
                        if (!is_null($documento_dni) && !empty($documento_dni)) {
                            $foto_dni = $habilitaciónController->getImagen();

                        ?>
                            <div class="col-12 col-md-4"> <img class="rounded mx-auto d-block shadow-sm img-fluid m-3" style="max-width: 40%;" src="<?= $foto_dni ?>" alt="">
                            </div>

                        <?PHP
                        } else {
                            $foto_dni = "https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg";
                        }
                        ?>

                        <?PHP
                        if (!is_null($empresaID) && !empty($empresaID)) {

                            $empresaNombre = $datosHabilitacion['habilitacion']['empresaNombre'];
                            $titularEmpresa = $datosHabilitacion['habilitacion']['titularEmpresa'];


                        ?>
                            <div class="form-group col-xs-6 col-sm-6 col-12 col-md-4">
                                <label class="text-dark">Nombre Empresa</label>
                                <input type="text" class="form-control" value="<?= $empresaNombre ?>" disabled readonly />
                            </div>
                            <div class="form-group col-xs-6 col-sm-6 col-4 col-md-4">
                                <label class="text-dark">Empresa ID</label>
                                <input type="text" class="form-control" value="<?= $empresaID ?>" disabled readonly />
                            </div>
                        <?PHP
                        }
                        ?>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</body>

</html>