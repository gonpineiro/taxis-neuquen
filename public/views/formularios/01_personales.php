<?php
$ciudades = $ciudadController->index();
$barrios = $barrioController->index();
?>

<div class="">
    <form action="01_personalesPost.php" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form-1" id="form-1" novalidate>
        <div class="card-body mb-5" style="border-bottom-right-radius: 20px;border-bottom-left-radius:20px;">
            <!-- DATOS PERSONALES -->
            <h4 class="text-white">Datos personales</h4>
            <hr>
            <div class="form-group row">
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="email" class="required">Compruebe su direcci&oacute;n de email </label>
                    <input type="email" id="email" class="form-control" value="<?= $email; ?>" placeholder="Email" name="email" maxlength="200">
                    <div class="invalid-feedback">
                        <strong>
                            Por favor ingrese el direcci&oacute;n.
                        </strong>
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="telefono" class="required">Actualice su n&uacute;mero de tel&eacute;fono </label>
                    <input type="number" id="telefono" class="form-control" value="<?= $celular; ?>" placeholder="Tel&eacute;fono" name="telefono" min="0" max="9999999999" pattern="^[0-9]">
                    <div class="invalid-feedback">
                        <strong>
                            Por favor ingrese solo números.
                        </strong>
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="nacionalidad" class="required">Nacionalidad </label>
                    <select id="nacionalidad" class="selectpicker form-control" title="Seleccionar" name='nacionalidad' style="display:block !important;">
                        <option value="1" selected>Argentina</option>
                        <option value="2">Nacionalidad</option>
                    </select>
                    <div class="invalid-feedback">
                        <strong>
                            Por favor ingrese su nacionalidad.
                        </strong>
                    </div>
                </div>
                <!-- DOMICILIO -->
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="ciudad" class="required">Seleccione su ciudad </label>
                    <select id="ciudad" class="custom-select form-control" title="Seleccionar" name='ciudad' style="display:block !important;" required>
                        <option selected disabled value="">Elegir ciudad...</option>
                        <?php while ($row = odbc_fetch_array($ciudades)) { ?>
                            <option value="<?= $row['id'] ?>"><?= utf8_encode($row['nombre']) ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor indique su ciudad.
                    </div>
                </div>
                <div id="div-barrios" style="display: none;" class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="barrio-nqn" class="required">Seleccione su barrio </label>
                    <select id="barrio-nqn" class="custom-select form-control" title="Seleccionar" name='barrio-nqn'>
                        <option selected disabled value="">Elegir barrio...</option>
                        <?php while ($row = odbc_fetch_array($barrios)) { ?>
                            <option value="<?= $row['id'] ?>"><?= utf8_encode($row['nombre']) ?></option>
                        <?php } ?>
                        <option value="0">Otro</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccionar un barrio o ingréselo manualmente seleccionando 'otro'.
                    </div>
                </div>
                <div id="div-barrio-nqn-otro" style="display: none;" class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                    <label for="barrio-nqn-otro" class="required">Escriba su barrio </label>
                    <input type="text" id="barrio-nqn-otro" class="form-control" placeholder="Nombre Barrio" name="barrio-nqn-otro" maxlength="100">

                    <div class="invalid-feedback">
                        Por favor ingrese su barrio.
                    </div>
                </div>
            </div>
            <!-- BARRIO -->
            <div class="form-group row">
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12 ">
                    <label for="direccion-cp" class="required">Código Postal </label>
                    <input type="number" id="direccion-cp" class="form-control" placeholder="Código postal" name="direccion-cp" min="0" max="9999" pattern="^[0-9]" required>

                    <div class="invalid-feedback">
                        Por favor ingrese su código postal. Ejemplo Neuquén: 8300
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12 ">
                    <label for="direccion-calle" class="required">Calle </label>
                    <input type="text" id="direccion-calle" class="form-control" placeholder="Calle" name="direccion-calle" maxlength="200" required>

                    <div class="invalid-feedback">
                        Por favor ingrese su domicilio.
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12 ">
                    <label for="direccion-numero" class="required">Número </label>
                    <input type="number" id="direccion-numero" class="form-control" placeholder="Número" name="direccion-numero" min="0" max="99999" pattern="^[0-9]" required>

                    <div class="invalid-feedback">
                        Por favor ingrese la númeración de su domicilio.
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12 ">
                    <label for="direccion-departamento">Departamento (opcional) </label>
                    <input type="text" id="direccion-departamento" class="form-control" placeholder="Departamento" name="direccion-departamento" maxlength="4">

                    <div class="invalid-feedback">
                        Por favor ingrese un número de departamento si vive en uno.
                    </div>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12 ">
                    <label for="direccion-piso">Piso (opcional) </label>
                    <input type="number" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="direccion-piso" class="form-control" placeholder="Piso" name="direccion-piso" maxlength="2">

                    <div class="invalid-feedback">
                        Por favor ingrese el piso de departamento si vive en uno.
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 ">
                    <label for="adjunto-antecedentes" class="required">Adjuntar certificado de antecedentes penales (.jpg - .jpeg - .png - .pdf) </label>
                    <div class="custom-file" id="adjunto-antecedentes">
                        <input id="antecedentes" class="custom-file-input" type="file" name="antecedentes" accept="image/png, image/jpeg, application/pdf" required>
                        <label for="antecedentes" class="custom-file-label required" id="label-antecedentes"><span style="font-size: 1rem;">Certificado Antecedentes (imagen o pdf)</span></label>
                    </div>
                    <div class="invalid-feedback">
                        Por favor cargue o compruebe que se cargo el adjunto correctamente.
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 ">
                    <label for="nro_recibo" class="required">Nro. de recibo Cannon (solo números) </label>
                    <input type="number" id="nro_recibo" min="0" max="9999999999" pattern="^[0-9]" class="form-control" placeholder="Ej: 257972906" name="nro_recibo" required>
                    <div class="invalid-feedback">
                        Por favor ingrese un n&uacute;mero como el Ej: 257972906
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 ">
                    <label for="div-imagen" class="required">Adjuntar archivo del recibo (.jpg - .jpeg - .png - .pdf) </label>
                    <div class="custom-file" id="div-imagen">
                        <input id="recibo" class="custom-file-input" type="file" name="recibo" accept="image/png, image/jpeg, application/pdf" required>
                        <label for="recibo" class="custom-file-label" id="label-imagen"><span style="font-size: 1rem;">Recibo pagado (imagen o pdf)</span></label>
                    </div>
                    <div class="invalid-feedback">
                        Por favor cargue la imagen correctamente.
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <div class="buttonsRow">
                    <input class="btn btn-primary submitBtn" type="submit" id="submit" value="Confirmar y Guardar" name="personalesSubmit" />
                </div>
                <div class="process" style="display: none;">
                    <div class="spinner-border text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>