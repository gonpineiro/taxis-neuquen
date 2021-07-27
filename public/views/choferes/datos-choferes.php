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
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <title>Administración de Habilitaciones de Transporte Público Neuquén</title>
</head>

<body>
    <?PHP
    include('../common/header.php');
    ?>
    <div class="body container" style="margin-bottom: 5em;">
        <div class="datos-perfil">
            <div class="card text-center rounded mb-3" style="background-color:white; margin-top: 1.5em;">
                <div id="contenedorImagen">
                    <img src='../../estilos/libreta/icono-persona.png' name="fotografia" class="fotografia card-img-top img-fluid" id="fotografia" style="margin: 20px auto; height:200px; width: 200px;">
                </div>
                <div class="card-body" style="background-color: white; color: #315891 !important;">
                    <p>
                    <h4 id="cardNombre" class="card-title mt-2"><?= "$nombre $apellido" ?></h4>
                    </p>
                    <p id="cardDni"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Dni: </bold><?= $dni ?>
                        </small></p>
                    <p id="cardTelefono"><small>
                            <bold>Tel:</bold> <?= $celular; ?>
                        </small></p>
                    <p id="cardEmail"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Email: </bold><?= $email ?>
                        </small></p>
                    <p id="cardFechanacimiento"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Fecha de Nacimiento: </bold><?= $fechanacimiento ?>
                        </small></p>
                    <p id="cardGenero"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>G&eacute;nero:</bold> <?= $genero ?>
                        </small></p>
                </div>
            </div>
        </div>
        <h1 class="titulo mb-5 mt-5">Choferes </h1>
        <!-- COMIENZO DE TABS/ PESTAÑAS -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-choferes-tab" data-toggle="tab" href="#nav-choferes" role="tab" aria-controls="nav-choferes" aria-selected="true">Choferes</a>
            </div>
        </nav>
        <div class="tab-content bg-light" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-choferes" role="tabpanel" aria-labelledby="nav-choferes-tab">
                <div class="container">
                    <h4 class="pt-3 pb-3">Datos Personales</h4>
                    <h5></h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-sm table-borderless">
                                <!-- CREAR NUEVOS TR SOLO VISTA CELULAR PARA LAS FILAS QUE TIENEN 4 DATOS Y OCULTAR LAS COLUMNAS 3 Y 4 DE VISTA PC EN CELULAR-->
                                <tbody>
                                    <tr class="d-flex" style="background-color:#fff">
                                        <td class="col-md-2 col-6 text-right">Persona:</td>
                                        <td class="col-md-10 col-6">CUIL:20-26810704-6</td>
                                    </tr>
                                    <tr class="d-flex">
                                        <td class="col-md-2 col-6 text-right">Nombre:</td>
                                        <td class="col-md-10 col-6">BAEZA, SANTIAGO ANDRES</td>
                                    </tr>
                                    <tr class="d-flex" style="background-color:#fff">
                                        <td class="col-md-2 col-6 text-right">Nro Conductor:</td>
                                        <td class="col-md-10 col-6">3816</td>
                                    </tr>
                                    <tr class="d-flex">
                                        <td class="col-md-2 col-3 text-right">Tipo Licencia:</td>
                                        <td class="col-md-6 col-3">D2-Autom. de serv. de trans. mas 8 plazas</td>
                                        <td class="col-md-2 col-3 text-right">Vencimiento Licencia:</td>
                                        <td class="col-md-2 col-3">30/08/2021</td>
                                    </tr>
                                    <tr class="d-flex" style="background-color:#fff">
                                        <td class="col-md-2 col-3 text-right">Otorgada:</td>
                                        <td class="col-md-6 col-3">14/11/2019</td>
                                        <td class="col-md-2 col-3 text-right">Vencimiento:</td>
                                        <td class="col-md-2 col-3">12/11/2020</td>
                                    </tr>
                                    <tr class="d-flex">
                                        <td class="col-md-2 col-3 text-right">Tipo cambio:</td>
                                        <td class="col-md-6 col-3">Renovación</td>
                                        <td class="col-md-2 col-3 text-right">Último cambio:</td>
                                        <td class="col-md-2 col-3">14/11/2019</td>
                                    </tr>
                                    <tr class="d-flex" style="background-color:#fff">
                                        <td class="col-md-2 col-6 text-right">Observaciones:</td>
                                        <td class="col-md-10 col-6">CREDENCIAL DE TAXO OTORGADA HASTA 12/11/2020</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end pb-3">
                                <div class="buttonsRow">
                                    <button class="btn btn-primary submitBtn" onclick="imprimirHabilitacionChofer()">Imprimir Habilitación</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="datos-choferes.js"></script>

</html>