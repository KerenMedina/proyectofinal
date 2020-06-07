let borrable;

esBorrable();

$(function() {

    selectTours();
    listarTodos();

    $("#contenidoSelect").on("change", ".g", listar);
    $("#tablaTours").on('click', '.eliminar', eliminarTour);

}); // FIN DE CARGA


function esBorrable() {

    $.ajax({ //aqui van los parametros
            url: "../funciones/esBorrableTour.php",
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

function selectTours() {
    $.ajax({ //aqui van los parametros
            url: "selectTours.php",
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


function listar() {
    if ($("#select_tour").val() == '-1') {
        listarTodos();
    } else {
        //antiguo generar parametros
        let parametros = {
            "codtour": $("#select_tour").val()
        };
        $.ajax({ //aqui van los parametros
                url: "listar.php",
                cache: false, //para que no tire de cache, no hace falta rand
                dataType: "json", //si no pongo nada intenta adivinar que es
                data: parametros,
                method: "POST" //es el por defecto
            })
            .done(function(respuesta) { //respuesta correcta Callback
                let cadena = '<table class="table" style="margin-top:2%; margin-left: 2%;">' +
                    '<thead >' +
                    '<tr style="background-color:#6495ed89">' +
                    '<th>CODIGO</th>' +
                    '<th>TITULO</th>' +
                    '<th>DESCRIPCION</th>' +
                    '<th>PRECIO</th>' +
                    '<th>MODIFICAR</th>' +
                    '<th>ELIMINAR</th>' +
                    '</tr>' +
                    ' </thead>';
                $.each(respuesta, function(index, valor) {
                    cadena += '<tr data-eliminar="' + valor.idTour + '">';
                    cadena += '<td>' + valor.idTour + '</td>' +
                        '<td>' + valor.titulo + '</td>' +
                        '<td>' + valor.descripcion + '</td>' +
                        '<td>' + valor.precio + '</td>' +
                        '<td><form action="../modificarTours/formularioModificar.php" method="post">' +
                        '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                        '<input type="hidden" id="codigoModificar" name="codigoModificar" value="' + valor.idTour + '" ></form></td>';

                    $.each(borrable, function(index, valor2) {
                        if (valor2['idTour'] == valor.idTour && valor2['borrable'] == true) {

                            cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idTour + '"></td>';
                        }
                    });
                    cadena += '</tr >';
                });
                cadena += '</table>';
                $("#tablaTours").html(cadena);
            })
            .fail(function(jqXHR, textStatus, errorThrown) { //fallo
                console.log("No se ha podido obtener la información");
                console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
            })
            .always(function() { //que hacer siempre, falle o no
                $("#cargando").html("")
            });
    }
}

function listarTodos() {
    $.ajax({ //aqui van los parametros
            url: "listarTodos.php",
            cache: false, //para que no tire de cache, no hace falta rand
            dataType: "json", //si no pongo nada intenta adivinar que es
            method: "POST" //es el por defecto
        })
        .done(function(respuesta) { //respuesta correcta Callback
            let cadena = '<table class="table" style="margin-top:2%; margin-left: 2%;">' +
                '<thead>' +
                '<tr style="background-color:#6495ed89">' +
                '<th>CODIGO</th>' +
                '<th>TITULO</th>' +
                '<th>DESCRIPCION</th>' +
                '<th>PRECIO</th>' +
                '<th>MODIFICAR</th>' +
                '<th>ELIMINAR</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {

                cadena += '<tr data-eliminar="' + valor.idTour + '">';
                cadena += '<td>' + valor.idTour + '</td>' +
                    '<td>' + valor.titulo + '</td>' +
                    '<td>' + valor.descripcion + '</td>' +
                    '<td>' + valor.precio + '</td>' +
                    '<td><form action="../modificarTours/formularioModificar.php" method="post">' +
                    '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                    '<input type="hidden" name="codigoModificar" value="' + valor.idTour + '" ></form></td>';

                $.each(borrable, function(index, valor2) {
                    if (valor2['idTour'] == valor.idTour && valor2['borrable'] == true) {

                        cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idTour + '"></td>';
                    }
                });
                cadena += '</tr >';
            });
            cadena += '</table>';
            $("#tablaTours").html(cadena);
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function eliminarTour() {

    idTour = $(this).data('eliminar');

    let parametros = {
        "idTour": idTour
    }
    $.ajax({ //aqui van los parametros
            url: "eliminarTour.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.eliminar) {
                alert("No se ha podido eliminar el tour, vuelva a intentarlo");
            } else {
                alert("Tour eliminado correctamente");
                ($('tr[data-eliminar=' + idTour + ']').remove());
                selectTours();

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