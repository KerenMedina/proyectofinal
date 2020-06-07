let borrable;

esBorrable();

$(function() {
    selectGuias();
    listarTodos();

    $("#contenidoSelect").on("change", ".g", listar);
    $("#tablaGuias").on('click', '.eliminar', eliminarGuia);

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

function esBorrable() {

    $.ajax({ //aqui van los parametros
            url: "../funciones/esBorrableGuia.php",
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
    if ($("#select_guia").val() == '-1') {
        listarTodos();
    } else {
        //antiguo generar parametros
        let parametros = {
            "codGuia": $("#select_guia").val()
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
                    '<th>FOTO PERFIL</th>' +
                    '<th>NICK</th>' +
                    '<th>CONTRASEÑA</th>' +
                    '<th>DNI</th>' +
                    '<th>EMAIL</th>' +
                    '<th>TELEFONO</th>' +
                    '<th>IDIOMAS</th>' +
                    '<th>MODIFICAR</th>' +
                    '<th>ELIMINAR</th>' +
                    '</tr>' +
                    ' </thead>';
                $.each(respuesta, function(index, valor) {
                    cadena += '<tr data-eliminar="' + valor.idGuia + '">';
                    cadena += '<td>' + valor.idGuia + '</td>' +
                        '<td>';

                    if (valor.imagen != "") {
                        cadena += '<img class="imagenPerfilenTabla" src="../../imagenesGuia/' + valor.imagen + '" >';
                    }

                    cadena += '<form action="../añadirImagen/añadirImagenGuia.php" method="post">' +
                        '<input type="submit" class="seleccionarImagen btn btn-primary btn-sm" value="Seleccionar imagen">' +
                        '<input type="hidden" id="codigoGuiaImagen" name="codigoGuiaImagen" value="' + valor.idGuia + '" ></form></td>' +
                        '<td>' + valor.nick + '</td>' +
                        '<td>' + valor.contrasenya + '</td>' +
                        '<td>' + valor.DNI + '</td>' +
                        '<td>' + valor.email + '</td>' +
                        '<td>' + valor.telefono + '</td>' +
                        '<td>' + valor.idioma1 + " " + valor.idioma2 + " " + valor.idioma3 + '</td>' +
                        '<td><form action="../modificarGuias/formularioModificar.php" method="post">' +
                        '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                        '<input type="hidden" id="codigoModificar" name="codigoModificar" value="' + valor.idGuia + '" ></form></td>';

                    $.each(borrable, function(index, valor2) {
                        if (valor2['idGuia'] == valor.idGuia && valor2['borrable'] == true) {

                            cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idGuia + '"></td>';
                        }
                    });
                    cadena += '</tr >';
                });
                cadena += '</table>';
                $("#tablaGuias").html(cadena);
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
                '<th>FOTO PERFIL</th>' +
                '<th>NICK</th>' +
                '<th>CONTRASEÑA</th>' +
                '<th>DNI</th>' +
                '<th>EMAIL</th>' +
                '<th>TELEFONO</th>' +
                '<th>IDIOMAS</th>' +
                '<th>MODIFICAR</th>' +
                '<th>ELIMINAR</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {

                cadena += '<tr data-eliminar="' + valor.idGuia + '">';
                cadena += '<td>' + valor.idGuia + '</td>' +
                    '<td>';

                if (valor.imagen != "") {
                    cadena += '<img class="imagenPerfilenTabla" src="../../imagenesGuia/' + valor.imagen + '" >';
                }

                cadena += '<form action="../añadirImagen/añadirImagenGuia.php" method="post">' +
                    '<input type="submit"  class="seleccionarImagen btn btn-primary btn-sm" value="Seleccionar imagen">' +
                    '<input type="hidden" id="codigoGuiaImagen" name="codigoGuiaImagen" value="' + valor.idGuia + '" ></form></td>' +
                    '<td>' + valor.nick + '</td>' +
                    '<td>' + valor.contrasenya + '</td>' +
                    '<td>' + valor.DNI + '</td>' +
                    '<td>' + valor.email + '</td>' +
                    '<td>' + valor.telefono + '</td>' +
                    '<td>' + valor.idioma1 + " " + valor.idioma2 + " " + valor.idioma3 + '</td>' +
                    '<td><form action="../modificarGuias/formularioModificar.php" method="post">' +
                    '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                    '<input type="hidden" id="codigoModificar" name="codigoModificar" value="' + valor.idGuia + '" ></form></td>';

                $.each(borrable, function(index, valor2) {
                    if (valor2['idGuia'] == valor.idGuia && valor2['borrable'] == true) {

                        cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idGuia + '"></td>';
                    }
                });
                cadena += '</tr >';
            });
            cadena += '</table>';
            $("#tablaGuias").html(cadena);
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function eliminarGuia() {

    idGuia = $(this).data('eliminar');

    let parametros = {
        "idGuia": idGuia
    }
    $.ajax({ //aqui van los parametros
            url: "eliminarGuia.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.eliminar) {
                alert("No se ha podido eliminar el guia, vuelva a intentarlo");
            } else {
                alert("Guia eliminado correctamente");
                ($('tr[data-eliminar=' + idGuia + ']').remove());
                selectGuias();


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