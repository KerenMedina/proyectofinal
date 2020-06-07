let array = {
    "titulo": true,
    "descripcion": true,
    "precio": true
};

$(function() {
    comprobarboton();
    $("#titulo").on("blur", tituloTour);
    $("#descripcion").on("blur", descripcionTour);
    $("#precio").on("blur", precioTour);
    $("#boton").on("click", actualizarTour);
}); // FIN DE CARGA


function tituloTour() {
    let titulo = $('#titulo').val();

    let tour = JSON.parse($("#tour").val());

    if (titulo != "") {
        console.log(tour[0]["titulo"]);

        if (titulo != tour[0]["titulo"]) {
            //parametros=$("#nombreIdForm").serialize();
            let parametros = { "titulo": titulo };
            $.ajax({ //aqui van los parametros
                    url: "../funciones/existeTituloTour.php",
                    dataType: "json",
                    cache: false, //para que no tire de cache, no hace falta rand
                    method: "POST", //es el por defecto
                    data: parametros
                })
                .done(function(respuesta) { //respuesta correcta Callback

                    if (respuesta.titulo == true) {
                        array["titulo"] = false;
                        $('#errorTitulo').addClass('alert alert-danger');
                        $('#errorTitulo').html("Error! Titulo no valido");
                    } else {
                        array["titulo"] = true;
                        $('#errorTitulo').removeClass('alert alert-danger');
                        $('#errorTitulo').addClass('alert alert-success');
                        $('#errorTitulo').html("Titulo valido!");
                    }
                    comprobarboton();

                    //$("#respuesta").html(respuesta);
                    //$('div').attr('class', 'contenedor');
                })
                .fail(function(jqXHR, textStatus, errorThrown) { //fallo
                    console.log("No se ha podido obtener la información");
                    console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
                })
                .always(function() { //que hacer siempre, falle o no
                    $("#cargando").html("")
                });
        } else {
            $('#errorTitulo').removeClass('alert alert-danger');
            $('#errorTitulo').addClass('alert alert-success');
            $('#errorTitulo').html("Titulo valido!");
            array["titulo"] = true;

        }
    } else {
        array["titulo"] = false;
        $('#errorTitulo').addClass('alert alert-danger');
        $('#errorTitulo').html("Error! Titulo no puede ser vacio");
    }
    comprobarboton();

}


function descripcionTour() {
    let descripcion = $('#descripcion').val();

    if (descripcion == "") {
        array["descripcion"] = false;
        $('#errorDescripcion').addClass('alert alert-danger');
        $('#errorDescripcion').html("Error! Debes rellenar este campo");
    } else {
        array["descripcion"] = true;
        $('#errorDescripcion').removeClass('alert alert-danger');
        $('#errorDescripcion').addClass('alert alert-success');
        $('#errorDescripcion').html("Campo valido!");
    }
    comprobarboton();
}

function precioTour() {
    let precio = $('#precio').val();

    if (precio == "" || precio < 0) {
        array["precio"] = false;
        $('#errorPrecio').addClass('alert alert-danger');
        $('#errorPrecio').html("Error! Debes rellenar este campo");
    } else {
        array["precio"] = true;
        $('#errorPrecio').removeClass('alert alert-danger');
        $('#errorPrecio').addClass('alert alert-success');
        $('#errorPrecio').html("Campo valido!");
    }
    comprobarboton();
}


function actualizarTour() {
    let parametros = $("#formulario").serialize();
    $.ajax({ //aqui van los parametros
            url: "actualizarTours.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (respuesta.actualizar == false) {
                alert("Actualización no realizada, vuelve a intentarlo");
            } else {
                alert("Actualización correcta");
                window.location = "../listarTours/listarTours.php";
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });

}

function comprobarboton() {
    comprobar = true;
    $.each(array, function(index, valor) {
        if (valor == false) {
            comprobar = false;
        }
    });
    if (comprobar) {
        $("#boton").removeAttr('disabled');
        $('#boton').removeClass('btn-light');
        $('#boton').addClass('btn-primary');
    } else {
        $("boton").attr('disabled', 'disabled');
        $('#boton').addClass('btn-light');
        $('#boton').removeClass('btn-primary');
    }
}

function validateDNI(dni) {
    let numero, l, letra;
    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;

    dni = dni.toUpperCase();

    if (expresion_regular_dni.test(dni) === true) {
        numero = dni.substr(0, dni.length - 1);
        numero = numero.replace('X', 0);
        numero = numero.replace('Y', 1);
        numero = numero.replace('Z', 2);
        l = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != l) {
            //alert('Dni erroneo, la letra del NIF no se corresponde');
            return false;
        } else {
            //alert('Dni correcto');
            return true;
        }
    } else {
        //alert('Dni erroneo, formato no válido');
        return false;
    }
}

function validarEmail(email) {
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (caract.test(email) == false) {

        return false;
    } else {
        return true;
    }
}