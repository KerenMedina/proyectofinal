$(function() {
    listarTodos();

    $("#tablaReservas").on('click', '.aceptar', aceptarReserva);

    $("#tablaReservas").on('click', '.denegar', denegarReserva);

}); // FIN DE CARGA


function listarTodos() {

    $.ajax({ //aqui van los parametros
            url: "listar.php",
            cache: false, //para que no tire de cache, no hace falta rand
            dataType: "json", //si no pongo nada intenta adivinar que es
            method: "POST" //es el por defecto
        })
        .done(function(respuesta) { //respuesta correcta Callback
            let cadena = '<table class="table" style="margin-top:2%;">' +
                '<thead>' +
                '<tr style="background-color:#6495ed89">' +
                '<th>TOUR</th>' +
                '<th>CLIENTE</th>' +
                '<th>HORARIO</th>' +
                '<th>IDIOMA</th>' +
                '<th>ACEPTAR</th>' +
                '<th>DENEGAR</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {

                cadena += '<tr data-cambios="' + valor.idReserva + '"><td>' + valor.tour + '</td>' +
                    '<td>' + valor.cliente + '</td>' +
                    '<td>' + valor.horario + '</td>' +
                    '<td>' + valor.idioma + '</td>';

                if (valor.estado == 'espera') {
                    cadena += '<td>' +
                        '<input type="button" class="aceptar btn btn-success" data-aceptar="' + valor.idReserva + '" value="Aceptar"></td>';
                    cadena += '<td><div id="botonDenegar">' +
                        '<input type="button" class="denegar btn btn-danger" data-denegar="' + valor.idReserva + '" value="Denegar"></td>';
                }
                if (valor.estado == "aceptado") {
                    cadena += '<td><p style="color:green">ACEPTADO</p></td><td></td>';
                }
                '</tr >';
            });
            cadena += '</table>';
            $("#tablaReservas").html(cadena);
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function aceptarReserva() {

    idReserva = $(this).data('aceptar');

    let parametros = {
        "idReserva": idReserva
    }
    $.ajax({ //aqui van los parametros
            url: "aceptarReserva.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.aceptar) {
                alert("No se ha podido aceptar la reserva, vuelva a intentarlo");
            } else {
                alert("Reserva aceptada correctamente");
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

function denegarReserva() {

    idReserva = $(this).data('denegar');

    let parametros = {
        "idReserva": idReserva
    }
    $.ajax({ //aqui van los parametros
            url: "denegarReserva.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.denegar) {
                alert("No se ha podido denegar la reserva, vuelva a intentarlo");
            } else {
                alert("Reserva denegada correctamente");
                ($('tr[data-cambios=' + idReserva + ']').remove());
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