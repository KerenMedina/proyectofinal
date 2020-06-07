$(function() {
    listarTodos();

    $("#tablaReservas").on('click', '.eliminar', eliminarReserva);

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
                '<th>GUIA</th>' +
                '<th>HORARIO</th>' +
                '<th>ELIMINAR</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {

                cadena += '<tr data-eliminar="' + valor.idReserva + '"><td>' + valor.tour + '</td>' +
                    '<td>' + valor.guia + '</td>' +
                    '<td>' + valor.horario + '</td>' +
                    '<td>' +
                    '<input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idReserva + '">' +
                    '</td></tr >';
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


function eliminarReserva() {

    idReserva = $(this).data('eliminar');

    let parametros = {
        "idReserva": idReserva
    }
    $.ajax({ //aqui van los parametros
            url: "eliminarReserva.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.eliminar) {
                alert("No se ha podido eliminar la reserva, vuelva a intentarlo");
            } else {
                alert("Reserva eliminada correctamente");
                ($('tr[data-eliminar=' + idReserva + ']').remove());

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