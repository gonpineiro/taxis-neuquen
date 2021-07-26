(function() {
    'use strict';
    window.addEventListener('load', function() {
        validate();
        checkboxes();
    }, false);
})();

function validate() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', (event) => {
            let inputs = $('.form-control:invalid');
            let inputsSelectize = $('.invalid');
            $('.invalid').css({ "border-color": "#b94a48" });
            $('.full').css({ "border-color": "#28a745" });
            if (inputsSelectize.length != 0) {
                let targetEle = inputsSelectize.closest('.form-group');
                animateToInput(targetEle);
            } else if (inputs.length != 0) {
                let targetEle = $(`#${inputs[0].id}`).closest('.form-group');
                animateToInput(targetEle);
            }
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $(".buttonsRow").hide();
                $(".process").show();
            }
            form.classList.add('was-validated');
            bsSelectValidation();

        }, false);
    });
}

function processText(inputText) {
    var output = [];
    var json = inputText.split(' ');
    json.forEach(function(item) {
        output.push(item.replace(/\'/g, '').split(/(\d+)/).filter(Boolean));
    });
    return output;
}

$(function() {

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    dibujarAsteriscos();

    $("input[type='number']").on('keydown', function(e) {
        if (e.which === 38 || e.which === 40) {
            e.preventDefault();
        }
    });
    $('input').on('keydown', function(event) {
        if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
            var $t = $(this);
            event.preventDefault();
            var char = String.fromCharCode(event.keyCode);
            $t.val(char + $t.val().slice(this.selectionEnd));
            this.setSelectionRange(1, 1);
        }
    });

    $("#form").on('change', function() {
        $('.invalid').css({ "border-color": "#b94a48" });
        $('.full').css({ "border-color": "#28a745" });
        validate();
        bsSelectValidation();
        var form = document.getElementsByClassName('needs-validation');

    });

    $('#ciudad').on('change', function(e) {
        if (this.value == 1) {
            $('#div-barrios').show(500);
            $('#div-barrios :input').attr('required', true);
        } else {
            $('#div-barrios').hide(500);
            $('#div-barrio-nqn-otro').hide(500);
            $('#div-barrios :input').attr('required', false);
        }
    });
    $('#barrio-nqn').on('change', function(e) {
        if (this.value == 0) {
            $('#div-barrio-nqn-otro').show(500);
            $('#div-barrio-nqn-otro :input').attr('required', true);
        } else {
            $('#div-barrio-nqn-otro').hide(500);
            $('#div-barrio-nqn-otro :input').attr('required', false);
        }
    });
    $('#path_certificado').on('change', function(e) {
        checkArchivo(this);
    });

    $('#path_comprobante_pago').on('change', function(e) {
        checkArchivo(this);
    });

    $('#terminosycondiciones').on('change', terminosycondicionescheck(this))

});

function checkArchivo(file) {
    var fileSize = file.files[0].size / 1024 / 1024, // in MB 
        fileType = $(file).val().toLowerCase(),
        fileName = $(file).val().replace(/C:\\fakepath\\/i, ''),
        regex = new RegExp("(.*?)\.(pdf|jpg|png|jpeg)$", 'i'),
        max_file_size = 10;

    if (fileSize > max_file_size) {
        $(file).val(null);
        $(file).closest(".form-group").find(".invalid-feedback").addClass("d-block");
        alert(`El tamaño del archivo max es de ${max_file_size} MB. Su archivo pesa ${~~fileSize} MB`);

    } else {
        //* se verifica tipo de archivo
        if (!(regex.test(fileType))) {
            $(file).val(null);
            $(file).closest(".form-group").find(".invalid-feedback").addClass("d-block");
            alert('Formato de archivo no aceptado. Por favor ingrese un archivo del tipo pdf, jpg, png o jpeg.');
        } else {
            $(`#labelAdjunto-${file.id}`).html(fileName);
        }
    }
}

function mostrarInputOtro(value) {
    if (value == null || value.length == 0) {
        $('#rubro_emprendimiento_div').show(500);
        $('#rubro_emprendimiento').attr('name', 'rubro_emprendimiento');
        $('#rubro_emprendimiento').attr('required', true);
        $('#rubro_emprendimiento_select').attr('name', '');
    } else {
        $('#rubro_emprendimiento_div').hide(500);
        $('#rubro_emprendimiento').attr('name', '');
        $('#rubro_emprendimiento').attr('required', false);
        $('#rubro_emprendimiento_select').attr('name', 'rubro_emprendimiento');
    }
}

function animateToInput(targetEle) {
    $('html, body').stop().animate({
        'scrollTop': targetEle.offset().top
    }, 800, 'swing');
}

function dibujarAsteriscos() {
    $("input[type='text'][required]").siblings("label").addClass("required");
    $("textarea[required]").siblings("label").addClass("required");
    $("input[type='number'][required]").siblings("label").addClass("required");
    $("input[type='file'][required]").siblings("label").addClass("required");
    $("input[type='date'][required]").siblings("label").addClass("required");
    $("select[required]").siblings("label").addClass("required");
    $("input[type='radio'][required]").parent().siblings("label").addClass("required");
    $("input[type='file'][required]").parent().siblings("label").addClass("required");
}

function bsSelectValidation() {
    if ($("#form").hasClass('was-validated')) {
        $(".selectpicker").each(function(i, el) {
            if ($(el).is(":invalid")) {
                $(el).closest(".form-group").find(".invalid-feedback").addClass("d-block");
            } else {
                $(el).closest(".form-group").find(".invalid-feedback").removeClass("d-block");
            }
        });
    }
}

 function terminosycondicionescheck() {
    var terminos = $('#terminosycondiciones');
    var clausula = $('#clausulavalidezddjj');
    if (terminos.is(":checked") && clausula.is(":checked")) {
        $('#condicionesSubmit').prop('disabled', false);
    } else {
        $('#condicionesSubmit').prop('disabled', true);
    }
} 
/**
 * Sirve para realizar llamadas ajax GET
 * @param {string} url Url a realizar la llamada
 * @return {object} data json object
 */
function llamadaAjax(url) {
    var data = function() {
        var tmp = null;
        $.ajax({
            'async': false,
            'type': 'GET',
            'global': false,
            'dataType': 'html',
            'url': url,
            'success': function(data) {
                tmp = JSON.parse(data);
            },
            'error': function() {
                console.log(url, tmp, 'Error en llamaa Ajax!');
            }
        });
        return tmp;
    }();

    return data;
}

function mostrarErrorEnAlta() {
    let targetEle = $("#form").parent();
    animateToInput(targetEle);
    $(`#alertaErrorCarga`).show(500);
}


function otroTitulo() {
    var numInputs = document.getElementById('inputs-titulos').getElementsByTagName('input').length;
    var max_fields = 20;
    var total_fields = $("#inputs-titulos")[0].childNodes.length;
    if (total_fields < max_fields) {
        $("#inputs-titulos").append(

            "<div class='form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 '>" +
            "<label for='tipo-titulo-" + numInputs + "' class='required'>Elegir título y/o curso " + numInputs + " </label>" +
            "<select id='tipo-titulo-" + numInputs + "' class='custom-select form-control' style='display:block!important' title='Seleccionar' name='titulos[]' required>" +
            "<option selected disabled value=''>Elegir título o curso</option>" +
            "<option value='1'>Lic. Educación Física (Título Terciario)</option>" +
            "<option value='2'>Master Educación Física (Título Terciario)</option>" +
            "<option value='3'>Profesorado Educación Física (Título Terciario)</option>" +
            "<option value='4'>Técnico Nacional (Título Federación u organismo estatal o privado reconocido por el Ministerio de Educación de Nación)</option>" +
            "<option value='5'>Técnico Provincial (Título Federación u organismo estatal con reconocimiento de C.P.E.)</option>" +
            "<option value='6'>Instructor Nacional (Título Federación Nacional o Institución privada con reconocimiento Nacional)</option>" +
            "<option value='7'>Instructor Deportivo (habilitación nacional-provincial o de federación u organismo municipal)</option>" +
            "<option value='8'>Instructor de Artes Marciales (habilitación Federación c/cinturón acorde)</option>" +
            "<option value='9'>Instructor Aerobic y/o aparatos y/o musculación (con habilitación oficial)</option>" +
            "<option value='10'>Instructor/profesor de prácticas introyectivas</option>" +
            "<option value='11'>Instructor/profesor de prácticas acrobáticas</option>" +
            "</select>" +
            "<div class='invalid-feedback'>Por favor seleccionar un título/ curso.</div>" +
            "</div>" +
            "<div class='form-group col-lg-6 col-md-6 col-sd-12 col-xs-12'>" +
            "<label for='div-adjunto-titulo-" + numInputs + "' class='required'>Título o certificado " + numInputs + " (Formatos: .jpg - .jpeg - .png) </label>" +
            "<div class='custom-file' id='div-adjunto-titulo-" + numInputs + "'>" +
            "<input id='imagen-titulo-" + numInputs + "' class='custom-file-input imagen' type='file' name='imagenTitulos[]' accept='image/png, image/jpeg' required>" +
            "<label for='imagen-titulo-" + numInputs + "' class='custom-file-label' id='label-imagen-titulo'><span style='font-size: 1rem;'>Título o certificado (imagen o pdf)</span></label>" +
            "</div>" +
            "<div class='invalid-feedback'>Por favor cargue la imagen correctamente. </div>" +
            "</div>"
        );
    }
}

function sacarOtroTitulo() {
    wrapper = $("#inputs-titulos");
    var total_fields = wrapper[0].childNodes.length;
    if (total_fields > 5) {
        $("#inputs-titulos")[0].childNodes[total_fields - 1].remove();
        $("#inputs-titulos")[0].childNodes[total_fields - 2].remove();
    }
}

function otroLugarTrabajo() {
    var numInputs = document.getElementById('inputs-lugar-trabajo').getElementsByTagName('input').length;
    var max_fields = 20;
    var total_fields = $("#inputs-lugar-trabajo")[0].childNodes.length;
    if (total_fields < max_fields) {
        $("#inputs-lugar-trabajo").append(

            "<div class='form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 '>" +
            "<label for='lugar-trabajo" + numInputs + "' class='required'>Ingresar lugar de trabajo " + numInputs + " </label>" +
            "<input type='text' id='lugar-trabajo" + numInputs + "' class='form-control' placeholder='Lugar local de trabajo' name='lugarTrabajo[]' required>" +
            "<div class='invalid-feedback'> Por favor ingrese un lugar de trabajo.</div>" +
            "</div>" +
            "<div class='form-group col-lg-6 col-md-6 col-sd-12 col-xs-12'>" +
            "<label for='div-certificacion-lugar-" + numInputs + "' class='required'>Imagen " + numInputs + " (Formatos: .jpg - .jpeg - .png) </label>" +
            "<div class='custom-file' id='div-certificacion-lugar-" + numInputs + "'>" +
            "<input id='imagen-certificacion-lugar-" + numInputs + "' class='custom-file-input' type='file' name='imagenLugares[]' accept='image/png, image/jpeg'>" +
            "<label for='imagen-certificacion-lugar-" + numInputs + "' class='custom-file-label' id='label-imagen-certificacion-lugar-0'><span style='font-size: 1rem;'>Adjuntar imagen formato JPEG/PNG</span></label>" +
            "</div>" +
            "<div class='invalid-feedback'>Por favor cargue la imagen correctamente.</div>" +
            "</div>"
        );
    }
}

function sacarOtroLugarTrabajo() {
    wrapper = $("#inputs-lugar-trabajo");
    var total_fields = wrapper[0].childNodes.length;
    if (total_fields > 7) {
        $("#inputs-lugar-trabajo")[0].childNodes[total_fields - 1].remove();
        $("#inputs-lugar-trabajo")[0].childNodes[total_fields - 2].remove();
    }
}

document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementsByClassName("imagen").files[0].name;
    alert(fileName)
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = fileName
})

function reiniciarForm(){
    const mensaje = '¿Está seguro de reiniciar el formulario?';
    if (confirm(mensaje)){
        $.ajax({
            url: "../../views/formularios/reiniciar.php",
            type: "POST",
            async: false,
            success: function () {
                window.location.href = "../../views/formularios/inscripcion.php";
            },
            error: function (errorThrown) {
                alert('Error en el reinicio. Intente nuevamente.')
                console.log(errorThrown);
            }
        });
    }
        
}

function checkboxes(){
    var boxes = $('.checkboxes');
    boxes.on('change', function () {
        $('#actividadesSubmit').prop('disabled', !boxes.filter(':checked').length);
    }).trigger('change');
}
