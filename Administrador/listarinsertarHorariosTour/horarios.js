let array = {
    "añadir": false
};

let borrable;
esBorrable();

let numHorarios = 0;
let numAñadir = 0;
let codTour;
$(function() {
    selectTours();

    $("#contenidoSelect").on("change", ".t", listar);
    $("#contenido").on("click", ".botonAñadirHorario", añadirHorario);
    $("#contenido").on("click", ".botonGuardarCambios", guardar);
    $("#contenido").on("click", ".e", eliminar);

}); // FIN DE CARGA

function selectTours() {
    $.ajax({ //aqui van los parametros
            url: "selectTour.php",
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

function esBorrable() {

    $.ajax({ //aqui van los parametros
            url: "../funciones/esBorrableHorario.php",
            cache: false, //para que no tire de cache, no hace falta rand
            dataType: "json", //si no pongo nada intenta adivinar que es
        })
        .done(function(respuesta) { //respuesta correcta Callback
            borrable = respuesta;
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function listar() {
    if ($("#select_tour").val() != '-1') {

        codTour = $("#select_tour").val();
        //antiguo generar parametros
        let parametros = {
            "codTour": $("#select_tour").val()
        }
        $.ajax({ //aqui van los parametros
                url: "listar.php",
                cache: false, //para que no tire de cache, no hace falta rand
                dataType: "json", //si no pongo nada intenta adivinar que es
                data: parametros,
                method: "POST" //es el por defecto
            })
            .done(function(respuesta) { //respuesta correcta Callback
                let cadena = '<div class="container align-items-center pagina">' +
                    '<div class="row">' +
                    '<div class="col-10 offset-md-2 formAñadirCliente">';
                cadena += '<h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Horarios tour ' + $("#select_tour").val() + '</h2>';

                $.each(respuesta, function(index, valor) {
                    numHorarios++;
                    cadena += '<div class="row">' +
                        '<label for="horario' + numHorarios + '" class="col-md-8 offset-2 col-form-label ">Horario ' + numHorarios + ' </label>' +
                        '<div class="col-md-8 offset-2">';

                    $.each(borrable, function(index, valor2) {
                        if (valor2['idHorario'] == valor.idHorario && valor2['borrable'] == true) {

                            cadena += '<img src="../imagenXEliminar.png" class="imagenXEliminar e" id="eliminar" data-idhorario="' + valor.idHorario + '">';

                        }
                    });

                    cadena += '<input type="text" disabled class="form-control h col-10" name="horario' + numHorarios + '" id="horario' + numHorarios + '" value="' + valor.horario + '">' +
                        '</div></div>';


                });
                cadena += '<form method="POST" id="formulario"><div id="añadir"></div><div class="col-md-8 offset-2">' +
                    '<input type="button" id="botonAñadir" class="btn btn-link botonAñadirHorario" value="Añadir horario">' +
                    '</div>';
                cadena += '<div class="col-md-3 offset-9">' +
                    '<input type="button" id="botonGuardar" disabled class="btn btn-light botonGuardarCambios" value="Guardar">' +
                    '</div></form>';
                cadena += '</div></div></div>';
                $("#contenido").html(cadena);
            })
            .fail(function(jqXHR, textStatus, errorThrown) { //fallo
                console.log("No se ha podido obtener la información");
                console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
            })
            .always(function() { //que hacer siempre, falle o no
                $("#cargando").html("")
            });
    } else {
        let cadena = '<div class="container col-12 align-items-center pagina">' +
            '<div class="col-12 ">' +
            '<div class="col-10 offset-md-1 formAñadirCliente">' +
            '<p style="color:red;"> Seleccione un tour</p>' +
            '</div></div></div>';
        $("#contenido").html(cadena);
    }
}

function añadirHorario() {
    array['añadir'] = true;
    comprobarBoton();
    numAñadir++;
    let cadena = '<div class="form-group row ">' +
        '<label for="anyadir' + numAñadir + '" class="col-md-8 offset-2 col-form-label ">Añadir ' + numAñadir + ' </label>' +
        '<div class="col-md-8 offset-2">' +
        '<input type="datetime-local" class="form-control h" name="anyadir' + numAñadir + '" id="anyadir' + numAñadir + '">' +
        '</div></div>';


    $("#añadir").append(cadena);

}


function guardar() {
    let parametros = $("#formulario").serialize() + "&numAnyadir=" + numAñadir + "&idTour=" + codTour;


    $.ajax({ //aqui van los parametros
            url: "insertarHorario.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "GET", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.insertar) {
                alert("Insercion no realizada, vuelva a intentarlo");
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

function eliminar() {
    idHorarioEliminar = $(this).data("idhorario");

    let parametros = { "idHorario": idHorarioEliminar };

    $.ajax({ //aqui van los parametros
            url: "eliminarHorario.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.eliminar) {
                alert("No se ha podido eliminar, vuelva a intentarlo");
            } else {
                alert("Registro eliminado correctamente");
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

function comprobarBoton() {
    comprobar = true;
    $.each(array, function(index, valor) {
        if (valor == false) {
            comprobar = false;
        }
    });
    if (comprobar) {
        $("#botonGuardar").removeAttr('disabled');
        $('#botonGuardar').removeClass('btn-light');
        $('#botonGuardar').addClass('btn-primary');
    } else {
        $("botonGuardar").attr('disabled', 'disabled');
        $('#botonGuardar').addClass('btn-light');
        $('#botonGuardar').removeClass('btn-primary');
    }
}