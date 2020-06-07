let array = {
    "titulo": false,
    "descripcion": false,
    "precio": false,
    "guia": false
};

let idGuia;

$(function() {
    selectGuias();

    $("#titulo").on("blur", tituloTour);
    $("#descripcion").on("blur", descripcionTour);
    $("#precio").on("blur", precioTour);
    $("#boton").on("click", añadirTour);
    $("#contenidoSelect").on("change", ".g", guiaTour);

}); // FIN DE CARGA


function selectGuias() {
    $.ajax({ //aqui van los parametros
            url: "selectGuias.php",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST" //es el por defecto
        })
        .done(function(respuesta) { //respuesta correcta Callback
            $("#contenidoSelect").html(respuesta);
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function guiaTour() {
    if ($("#select_guia").val() == '-1') {
        array["guia"] = false;
        $('#errorGuia').addClass('alert alert-danger');
        $('#errorGuia').html("Error! Guia no valido");

    } else {

        idGuia = $("#select_guia").val();
        array["guia"] = true;
        $('#errorGuia').removeClass('alert alert-danger');
        $('#errorGuia').addClass('alert alert-success');
        $('#errorGuia').html("Guia valido!");
    }
    comprobarboton();

}

function tituloTour() {
    let titulo = $('#titulo').val();

    if (titulo != "") {
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
        $('#errorTitulo').addClass('alert alert-danger');
        $('#errorTitulo').html("Error! Titulo no puede ser vacio");
    }
}

function descripcionTour() {
    let descripcion = $('#descripcion').val();

    if (descripcion.length == " ") {
        array["descripcion"] = false;
        $('#errorDescripcion').addClass('alert alert-danger');
        $('#errorDescripcion').html("Error! La descripcion no puede ser vacia");
    } else {
        array["descripcion"] = true;
        $('#errorDescripcion').removeClass('alert alert-danger');
        $('#errorDescripcion').addClass('alert alert-success');
        $('#errorDescripcion').html("Descipción valida!");
    }
    comprobarboton();
}

function precioTour() {
    let precio = $('#precio').val();

    if (precio < 0) {
        array["precio"] = false;
        $('#errorPrecio').addClass('alert alert-danger');
        $('#errorPrecio').html("Error! El precio no puede ser menor de 0");
    } else {
        array["precio"] = true;
        $('#errorPrecio').removeClass('alert alert-danger');
        $('#errorPrecio').addClass('alert alert-success');
        $('#errorPrecio').html("Precio valido!");
    }
    comprobarboton();
}

function añadirTour() {
    let parametros = $("#formulario").serialize();


    $.ajax({ //aqui van los parametros
            url: "insertarTour.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.insertar) {
                alert("Insercion no realizada, vuelve a intentarlo");
            } else {
                alert("Insercion correcta");
                location.reload(true);
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