<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

$errores = [];
$id_wapusuarios = $_SESSION['usuario']['referenciaID'];
$dni = $_SESSION['usuario']['documento'];
$datosPersonales = $_SESSION['usuario']['datosPersonales'];
$direccionRenaper = $datosPersonales['domicilioReal']['direccion'] . ' ' . $datosPersonales['domicilioReal']['codigoPostal']['ciudad'];
$nroTramite = $datosPersonales['properties']['renaperID'];
$id_wappersonas = $datosPersonales['referenciaID'];
$email = $_SESSION['usuario']['correoElectronico'];
$celular = $_SESSION['usuario']['celular'];
$fechanacimiento = date('d-m-Y', strtotime($_SESSION['usuario']['fechaNacimiento']));
$genero = $_SESSION['usuario']['genero'];
$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);
$razonSocial = $_SESSION['usuario']["razonSocial"];
$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];

// si tiene certificación se visualiza el botón con el collapse para verlo en el modal
$certificado = true;

$solicitudController = new SolicitudController();
$solicitudesNuevas = $solicitudController->getSolicitudesWhereEstado('Nuevo');
$solicitudesAprobadas = $solicitudController->getSolicitudesWhereEstado('Aprobado');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <link rel="stylesheet" href="../../estilos/menu/menu.css">
    <link rel="stylesheet" type="text/css" href="../../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../node_modules/bootstrap-icons/font/bootstrap-icons.css">


    <title>Solicitudes Nuevas y Aprobadas - Libreta Sanitaria</title>    
</head>

<body>
    <?php include('../formularios/components/header.php'); ?>
    <div id="divUserInfo" class="container py-4" style="display: table-cell;float: right;">
        <table id="tableWidth" style="float: right; margin-right: 30px;">
            <tbody>
                <tr onclick="usrOptions.style.display='block'" onmouseleave="usrOptions.style.display='none'" style="cursor: pointer;">
                    <td>
                        <img alt="" style="width: 25px;" src="../../estilos/menu/icono-login.png">
                    </td>
                    <td style="display: inline-flex; padding: 5px;">
                        <div style="color: #109AD6;"><?php echo "$apellido $nombre"; ?></div>
                    </td>
                    <td>
                        <img alt="" src="../../estilos/menu/arrDown.jpg">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div onmouseover="this.style.display='block'" onmouseleave="this.style.display='none'" id="usrOptions" style="z-index: 999; background-color: transparent; display: none; position: absolute; margin-top: -5px; width: 307px;">
                            <div onclick="window.location.href = './index.php'" class="whiteButton" style="margin-top: 5px;">Regresar</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="body container" style="padding-bottom: 50px;">

        <!-- Tabla solicitudes nuevas -->
        <?php include './components/solicitudes_nuevas.php' ?>

        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>

        <!-- Tabla solicitudes aprobadas -->
        <?php include './components/solicitudes_aprobadas.php' ?>

        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <a href="./index.php" class="btn btn-primary">Regresar</a>

        <!-- Modal Ficha Nueva Solicitud-->
        <?php include './components/modal_ficha_nueva.php' ?>

        <!-- Modal Ficha Aprobada-->
        <?php include './components/modal_ficha_aprobada.php' ?>
    </div>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script src="../../js/administrar/nuevas_solicitudes.js"></script>
</html>