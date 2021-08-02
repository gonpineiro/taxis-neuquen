<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}
$usuarioController = new UsuarioController();
/* datos de la sesión */
include('../common/session.php');
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

    <?php include('../common/header.php'); ?>

    <?php include('../common/userMenu.php'); ?>

    <div class="body container" style="margin-bottom: 5em;">
        <?php include('../common/datosPerfil.php'); ?>

        <h1 class="titulo mb-5 mt-5">Choferes </h1>
        <!-- BÚSQUEDA DEL VEHÍCULO -->
        <div class="pt-2">
            <div class="row">
                <div class="form-group col">
                    <label for="nro-conductor">Número Conductor </label>
                    <input type="number" id="nro-conductor" class="form-control" placeholder="3816" name="nro-conductor" value="3816" required>
                    <div class="invalid-feedback">
                        <strong>
                            Por favor ingrese la patente correctamente.
                        </strong>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="fecha_hasta font-weight-bold" style="visibility: hidden;">Buscar </label>
                    <input onclick="buscarConductor()" type="submit" value="Buscar Conductor" id="buscar-conductor" class="form-control btn-primary" name="buscar-conductor" required style="background-color: #60C1DE;color:white;">
                </div>
            </div>
        </div>
        <!-- COMIENZO DE TABS/ PESTAÑAS -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-choferes-tab" data-toggle="tab" href="#nav-choferes" role="tab" aria-controls="nav-choferes" aria-selected="true">Choferes</a>
            </div>
        </nav>
        <div id="sin-datos">
            <div class="card-body text-center">
                <span>Ingrese y busque por número de conductor para obtener la información de este. </span>
            </div>
        </div>
        <div id="datos-conductor" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-light">Datos Personales</h4>
                </div>
            </div>
            <div class="tab-content bg-light" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-choferes" role="tabpanel" aria-labelledby="nav-choferes-tab">
                    <div class="container">
                        <!-- CODIGO QR -->
                        <div style="display: none;" id="qr_code">
                        </div>
                        <!-- CODIGO QR -->
                        <div class="row pt-3">
                            <div class="col-xs-12 col-md-2">
                                <img class="img-fluid mb-3" style="width: 200px;" id="foto_dni" src="" alt="">
                            </div>

                            <div class="col-xs-12 col-md-10">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Apellido y Nombre</label>
                                        <input type="text" class="form-control" id="nombrec" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>DNI</label>
                                        <input type="text" class="form-control" id="ind_identificacion" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Tipo Credencial</label>
                                        <select class="custom-select" id="tipo_credencial">
                                            <option value="TAXI" selected>Taxi</option>
                                            <option value="REMISSE">Remisse</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-3">
                                        <label>Nro Conductor</label>
                                        <input type="text" class="form-control" id="nro_conductor" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-3">
                                        <label>Otorgada:</label>
                                        <input type="text" class="form-control" id="fecha_otorgada" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-3">
                                        <label>Vencimiento</label>
                                        <input type="text" class="form-control" id="fecha_vencimiento" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-3">
                                        <label>¿Es renovación?</label>
                                        <select class="custom-select" id="renovacion">
                                            <option value="1" selected>Sí</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Tipo Licencia Conducir</label>
                                        <input type="text" class="form-control" id="descripcion_lic" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Fecha Vencimiento Licencia Conducir</label>
                                        <input type="text" class="form-control" id="fecha_vencimiento_licencia" disabled readonly />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-12">
                                        <label>Observaciones</label>
                                        <textarea type="text" class="form-control" id="observaciones" disabled readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end pb-3">
                                    <div class="">
                                        <button class="btn btn-primary" onclick="buscarDatosConductor()">Imprimir Habilitación</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="./datos-choferes.js"></script>
</body>



</html>