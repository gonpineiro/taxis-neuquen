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
    <?PHP
    include('../common/header.php');
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: transparent !important;">
        <div class="container p-md-1 p-sm-1">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#00B4E6" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z" />
                            </svg>
                            <span style="color: #00B4E6;font-weight:600;"><?php echo "$apellido $nombre"; ?></span>
                        </a>
                        <div class="dropdown-menu" style="background-color: transparent!important;border:none!important" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item whiteButton contacto-menu" target="_blank" href="mailto:soporte@muninqn.gov.ar">Soporte</a>
                            <a class="dropdown-item whiteButton mt-2" href="https://weblogin.muninqn.gov.ar">Regresar</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                        <div hidden id="qr_code">
                        </div>
                        <!-- CODIGO QR -->
                        <div class="row pt-3">
                            <div class="col-xs-12 col-md-2"> <img class="img-fluid" style="width: 200px;" id="foto_dni" src="" alt="">
                            </div>
                            <div class="col-xs-12 col-md-10">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Identificación</label>
                                        <input type="text" class="form-control" id="nombrec" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Persona</label>
                                        <input type="text" class="form-control" id="ind_identificacion" disabled readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Nro Conductor</label>
                                        <input type="text" class="form-control" id="nro_conductor" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Otorgada:</label>
                                        <input type="text" class="form-control" id="fecha_otorgada" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Vencimiento</label>
                                        <input type="text" class="form-control" id="fecha_vencimiento" disabled readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Tipo Licencia</label>
                                        <input type="text" class="form-control" id="descripcion_lic" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Tipo cambio</label>
                                        <input type="text" class="form-control" id="tipo_cambio" disabled readonly />
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label>Último cambio</label>
                                        <input type="text" class="form-control" id="fecha_vencimiento_licencia" disabled readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label>Observaciones</label>
                                        <textarea type="text" class="form-control" id="observaciones" disabled readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-lg-12">
                                <table class="table table-sm table-borderless">
                                    <!-- CREAR NUEVOS TR SOLO VISTA CELULAR PARA LAS FILAS QUE TIENEN 4 DATOS Y OCULTAR LAS COLUMNAS 3 Y 4 DE VISTA PC EN CELULAR-->
                                    <tbody>
                                        <tr class="d-flex" style="background-color:#fff">
                                            <td class="col-md-2 col-6 text-right">Persona:</td>
                                            <td class="col-md-10 col-6" id="z">CUIL: 20-26810704-6</td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-md-2 col-6 text-right">Nombre:</td>
                                            <td class="col-md-10 col-6" id="z">BAEZA, SANTIAGO ANDRES</td>
                                        </tr>
                                        <tr class="d-flex" style="background-color:#fff">
                                            <td class="col-md-2 col-6 text-right">Nro Conductor:</td>
                                            <td class="col-md-10 col-6" id="z">3816</td>
                                        </tr>
                                        <tr class="d-flex" style="background-color:#fff">
                                            <td class="col-md-2 col-3 text-right">Otorgada:</td>
                                            <td class="col-md-6 col-3" id="z">14/11/2019</td>
                                            <td class="col-md-2 col-3 text-right">Vencimiento:</td>
                                            <td class="col-md-2 col-3" id="z">12/11/2020</td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-md-2 col-3 text-right">Tipo Licencia:</td>
                                            <td class="col-md-6 col-3" id="z">D2-Autom. de serv. de trans. mas 8 plazas</td>
                                            <td class="col-md-2 col-3 text-right">Vencimiento Licencia:</td>
                                            <td class="col-md-2 col-3" id="fecha_vencimiento_licencia">30/08/2021</td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-md-2 col-3 text-right">Tipo cambio:</td>
                                            <td class="col-md-6 col-3" id="tipo_cambio">Renovación</td>
                                            <td class="col-md-2 col-3 text-right">Último cambio:</td>
                                            <td class="col-md-2 col-3" id="fecha_ultimo_cambio">14/11/2019</td>
                                        </tr>
                                        <tr class="d-flex" style="background-color:#fff">
                                            <td class="col-md-2 col-6 text-right">Observaciones:</td>
                                            <td class="col-md-10 col-6" id="observaciones">CREDENCIAL DE TAXI OTORGADA HASTA 12/11/2020</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end pb-3">
                                    <div class="buttonsRow">
                                        <button class="btn btn-primary submitBtn" onclick="buscarDatosConductor()">Imprimir Habilitación</button>
                                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

<script src="datos-choferes.js"></script>

</html>