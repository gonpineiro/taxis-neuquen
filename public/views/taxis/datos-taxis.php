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
    <?php include('../common/header.php'); ?>
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
        <h1 class="titulo mb-5 mt-5">Taxis y Remises</h1>
        <h5>Administración de Habilitaciones de Transporte Público</h5>
        <!-- BÚSQUEDA DEL VEHÍCULO -->
        <div class="row">
            <div class="form-group col">
                <label for="patente">Patente </label>
                <input type="text" id="patente" class="form-control" placeholder="NYU-067" value="NYU-067" name="patente" required>
                <div class="invalid-feedback">
                    <strong>
                        Por favor ingrese la patente correctamente.
                    </strong>
                </div>
            </div>
            <div class="form-group col">
                <label for="fecha_hasta font-weight-bold" style="visibility: hidden;">Buscar </label>
                <input onclick="buscarConductor()" type="submit" value="Buscar Vehículo" id="buscar-conductor" class="form-control btn-primary" name="buscar-conductor" required style="background-color: #60C1DE;color:white;">

            </div>
        </div>
        <div id="sin-datos">
            <div class="card-body text-center">
                <span id="sin-datos-descrip">Ingrese y busque por número de patente para obtener la información de este. </span>
            </div>
        </div>

        <!-- Transporte Púiblico -->
        <?php include('./components/transportePublico.php') ?>

        <!-- COMIENZO DE TABS/ PESTAÑAS -->
        <div class="container">
            <nav id="nav-tabDescription" style="display: none">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-titular-tab" data-toggle="tab" href="#nav-titular" role="tab" aria-controls="nav-titular" aria-selected="true">Titular/ Responsable</a>
                    <a class="nav-link" id="nav-datos-tab" data-toggle="tab" href="#nav-datos" role="tab" aria-controls="nav-datos" aria-selected="true">Otros Datos</a>

                </div>
            </nav>

            <div class="tab-content bg-light" id="nav-tabContent" style="display: none">
                <div class="tab-pane fade show active" id="nav-titular" role="tabpanel" aria-labelledby="nav-titular-tab">
                    <?php include('./components/titulas.php') ?>
                </div>
                <div class="tab-pane fade show" id="nav-datos" role="tabpanel" aria-labelledby="nav-datos-tab">
                    <?php include('./components/otrosDatos.php') ?>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end pb-3 pr-3">
                            <div class="buttonsRow">
                                <button class="btn btn-primary submitBtn" onclick="alert('imprimir la habilitación');">Imprimir Habilitación</button>
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
<script src="../../../node_modules/jspdf/dist/jspdf.es.js"></script>
<script src="datos-taxis.js"></script>

</html>