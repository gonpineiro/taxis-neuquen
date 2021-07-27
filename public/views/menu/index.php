<?php
include '../../../app/config/config.php';

if (isset($_SESSION['userProfiles']) && $_SESSION['userProfiles'] != (3 || 2)) {
    header('Location: ' . WEBLOGIN);
    exit();
}

$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);

$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administración de Habilitaciones de Transporte Público Neuquén</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/menu/menu.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- <tbody>
        <tr>
            <td style="padding: 35px;">
                <div class="header">
                    <img class="logo" alt="" src="../../estilos/menu/webLoginLogoReduced.png" style="display: inline-block; width: max-content; max-width: 80%;">
                    <div onclick="pago()" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.1)'" onmouseleave="this.style.backgroundColor='transparent'" style="cursor: pointer; color: rgb(16, 154, 214); font-size: 8pt; display: inline-block; padding: 10px; border-radius: 10px; background-color: transparent;">contacto: soporte@muninqn.gov.ar</div>
                    <div id="divUserInfo" style="display: table-cell;">
                        <table id="tableWidth" style="float: right; margin-right: 30px;">
                            <tbody>
                                <tr onclick="usrOptions.style.display='block'" onmouseleave="usrOptions.style.display='none'" style="cursor: pointer;">
                                    <td>
                                        <img alt="" style="width: 25px;" src="../../estilos/menu/icono-login.png">
                                    </td>
                                    <td style="display: inline-flex; padding: 5px;">
                                        <div style="color: #109AD6;" id="lblVarUSUARIO"><?php echo "$apellido $nombre"; ?></div>
                                    </td>
                                    <td>
                                        <img alt="" src="../../estilos/menu/arrDown.jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div onmouseover="this.style.display='block'" onmouseleave="this.style.display='none'" id="usrOptions" style="z-index: 999; background-color: transparent; display: none; position: absolute; margin-top: -10px; width: 307px;">
                                            <div onclick="window.location.href = 'https://weblogin.muninqn.gov.ar'" class="whiteButton" style="margin-top: 5px;">Regresar</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </tbody> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: transparent !important;">
        <div class="container-fluid p-md-5 p-sm-1">
            <a class="navbar-brand" href="#"><img class="municipalidad-logo" src="../../estilos/menu/webLoginLogoReduced.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto d-lg-none d-xl-block">
                    <li class="nav-item contacto-logo">
                        <a class="nav-link" target="_blank" href="mailto:soporte@muninqn.gov.ar">
                            <span class="text-info">contacto: soporte@muninqn.gov.ar</span>
                        </a>
                    </li>
                </ul>
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

    <div class="container pt-5">
        <div class="row pt-5">
            <div class='col-sm d-flex justify-content-center'>
                <div class='opcion' onclick='window.location.href = "../taxis/datos-taxis.php"'>
                    <table style='width: 100%;'>
                        <tbody>
                            <tr>
                                <td>
                                    <div class='icono' style='background-image: url(../../estilos/menu/icono-admin.png);'></div>
                                </td>
                            </tr>
                            <tr style='height: 60px;'>
                                <td class='opcion-titulo text-center'>TAXIS/ REMISES</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='opcion' onclick='window.location.href = "../choferes/datos-choferes.php"'>
                    <table style='width: 100%;'>
                        <tbody>
                            <tr>
                                <td>
                                    <div class='icono' style='background-image: url(../../estilos/menu/icono-admin.png);'></div>
                                </td>
                            </tr>
                            <tr style='height: 60px;'>
                                <td class='opcion-titulo text-center'>CHOFERES</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>