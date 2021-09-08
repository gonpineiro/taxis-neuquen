<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['userProfiles'] != 3) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

$file = basename(__FILE__, '.php');
$usuarioController = new UsuarioController();

/* datos de la sesión */
include('../common/session.php');
?>

<?php include('../common/header.php'); ?>
<div class="body container" style="margin-bottom: 5em;">

    <h1 class="titulo mb-5 mt-5">Taxis y Remises</h1>
    <h5>Administración de Habilitaciones de Transporte Público</h5>
    <!-- BÚSQUEDA DEL VEHÍCULO -->
    <div class="row">
        <div class="form-group col-md-4">
            <label for="habTipo">Tipo Habilitación</label>
            <select id="habTipo" name="habTipo" class="form-control">
                <option value="TAX" selected>TAX</option>
                <option value="REM">REM</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="habilitacionID">Número Habilitación</label>
            <input type="number" class="form-control" id="habilitacionID" name="habilitacionID" placeholder="492" value="492">
        </div>
        <div class="form-group col">
            <label for="fecha_hasta font-weight-bold" style="visibility: hidden;">Buscar </label>
            <input onclick="buscarConductor();" type="submit" value="Buscar Vehículo" id="buscar-conductor" class="form-control btn-primary" name="buscar-conductor" required style="background-color: #60C1DE;color:white;">

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

        <div class="tab-content bg-light rounded-bottom" id="nav-tabContent" style="display: none">
            <!-- CODIGO QR -->
            <div style="display: none;" id="qr_code">
            </div>
            <!-- CODIGO QR -->
            <div class="tab-pane fade show active" id="nav-titular" role="tabpanel" aria-labelledby="nav-titular-tab">
                <?php include('./components/titular.php') ?>
            </div>
            <div class="tab-pane fade show" id="nav-datos" role="tabpanel" aria-labelledby="nav-datos-tab">
                <?php include('./components/otrosDatos.php') ?>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end pb-3 pr-3">
                        <div class="buttonsRow">
                            <button class="btn btn-primary submitBtn" onclick="buscarDatosHabilitacion();">Imprimir Habilitación</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../common/footer.php') ?>