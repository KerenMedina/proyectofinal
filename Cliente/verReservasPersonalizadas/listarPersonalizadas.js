$(function() {
    listarTodos();

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
                '<th>IDIOMA</th>' +
                '<th>ESTADO</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {

                cadena += '<tr><td>' + valor.tour + '</td>' +
                    '<td>' + valor.guia + '</td>' +
                    '<td>' + valor.horario + '</td>' +
                    '<td>' + valor.idioma + '</td>';

                if (valor.estado == 'espera') {
                    cadena += '<td><p style="color:gold">EN ESPERA</p></td>';

                }
                if (valor.estado == "aceptado") {
                    cadena += '<td><p style="color:green">ACEPTADO</p></td>';
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