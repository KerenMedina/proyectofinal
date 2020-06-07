let borrable;

esBorrable();

$(function() {
    selectClientes();
    listarTodos();

    $("#contenidoSelect").on("change", ".c", listar);
    $("#tablaClientes").on('click', '.eliminar', eliminarCliente);

}); // FIN DE CARGA

function selectClientes() {
    $.ajax({ //aqui van los parametros
            url: "selectClientes.php",
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
            url: "../funciones/esBorrableCliente.php",
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
    if ($("#select_cliente").val() == '-1') {
        listarTodos();
    } else {
        //antiguo generar parametros
        let parametros = {
            "codCliente": $("#select_cliente").val()
        };
        $.ajax({ //aqui van los parametros
                url: "listar.php",
                cache: false, //para que no tire de cache, no hace falta rand
                dataType: "json", //si no pongo nada intenta adivinar que es
                data: parametros,
                method: "POST" //es el por defecto
            })
            .done(function(respuesta) { //respuesta correcta Callback
                let cadena = '<table class="table" style="margin-top:2%;">' +
                    '<thead >' +
                    '<tr style="background-color:#6495ed89">' +
                    '<th>CODIGO</th>' +
                    '<th>FOTO PERFIL</th>' +
                    '<th>NICK</th>' +
                    '<th>CONTRASEÑA</th>' +
                    '<th>DNI</th>' +
                    '<th>DIRECCIÓN</th>' +
                    '<th>CIUDAD</th>' +
                    '<th>EMAIL</th>' +
                    '<th>TELEFONO</th>' +
                    '<th>MODIFICAR</th>' +
                    '<th>ELIMINAR</th>' +
                    '</tr>' +
                    ' </thead>';
                $.each(respuesta, function(index, valor) {

                    cadena += '<tr data-eliminar="' + valor.idCliente + '">';
                    cadena += '<td>' + valor.idCliente + '</td>' +
                        '<td>';

                    if (valor.imagen != "") {
                        cadena += '<img class="imagenPerfilenTabla" src="../../imagenesCliente/' + valor.imagen + '" >';
                    }

                    cadena += '<form action="../añadirImagen/añadirImagenCliente.php" method="post">' +
                        '<input type="submit" class="seleccionarImagen btn btn-primary btn-sm" value="Seleccionar imagen">' +
                        '<input type="hidden" id="codigoClienteImagen" name="codigoClienteImagen" value="' + valor.idCliente + '" ></form></td>' +
                        '<td>' + valor.nick + '</td>' +
                        '<td>' + valor.contrasenya + '</td>' +
                        '<td>' + valor.DNI + '</td>' +
                        '<td>' + valor.direccion + '</td>' +
                        '<td>' + valor.ciudad + '</td>' +
                        '<td>' + valor.email + '</td>' +
                        '<td>' + valor.telefono + '</td>' +
                        '<td><form action="../modificarClientes/formularioModificar.php" method="post">' +
                        '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                        '<input type="hidden" id="codigoModificar" name="codigoModificar" value="' + valor.idCliente + '" ></form></td>';

                    $.each(borrable, function(index, valor2) {
                        if (valor2['idCliente'] == valor.idCliente && valor2['borrable'] == true) {

                            cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idCliente + '"></td>';
                        }
                    });
                    cadena += '</tr >';
                });
                cadena += '</table>';
                $("#tablaClientes").html(cadena);
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
            let cadena = '<table class="table" style="margin-top:2%;">' +
                '<thead>' +
                '<tr style="background-color:#6495ed89">' +
                '<th>CODIGO</th>' +
                '<th>FOTO PERFIL</th>' +
                '<th>NICK</th>' +
                '<th>CONTRASEÑA</th>' +
                '<th>DNI</th>' +
                '<th>DIRECCIÓN</th>' +
                '<th>CIUDAD</th>' +
                '<th>EMAIL</th>' +
                '<th>TELEFONO</th>' +
                '<th>MODIFICAR</th>' +
                '<th>ELIMINAR</th>' +
                '</tr>' +
                ' </thead>';
            $.each(respuesta, function(index, valor) {
                //la fila guardamos un valor de fila
                // que será igual al valor de botón
                cadena += '<tr data-eliminar="' + valor.idCliente + '">';
                cadena += '<td>' + valor.idCliente + '</td>' +
                    '<td>';

                if (valor.imagen != "") {
                    cadena += '<img class="imagenPerfilenTabla" src="../../imagenesCliente/' + valor.imagen + '" >';
                }

                cadena += '<form action="../añadirImagen/añadirImagenCliente.php" method="post">' +
                    '<input type="submit" class="seleccionarImagen btn btn-primary btn-sm" value="Seleccionar imagen">' +
                    '<input type="hidden" id="codigoClienteImagen" name="codigoClienteImagen" value="' + valor.idCliente + '" ></form></td>' +
                    '<td>' + valor.nick + '</td>' +
                    '<td>' + valor.contrasenya + '</td>' +
                    '<td>' + valor.DNI + '</td>' +
                    '<td>' + valor.direccion + '</td>' +
                    '<td>' + valor.ciudad + '</td>' +
                    '<td>' + valor.email + '</td>' +
                    '<td>' + valor.telefono + '</td>' +
                    '<td><form action="../modificarClientes/formularioModificar.php" method="post">' +
                    '<input type="submit" class="modificar btn btn-primary" value="Modificar">' +
                    '<input type="hidden" id="codigoModificar" name="codigoModificar" value="' + valor.idCliente + '" ></form></td>';

                $.each(borrable, function(index, valor2) {
                    if (valor2['idCliente'] == valor.idCliente && valor2['borrable'] == true) {

                        cadena += '<td><input type="button" class="eliminar btn btn-danger" value="Eliminar" data-eliminar="' + valor.idCliente + '"></td>';
                    }
                });
                cadena += '</tr >';
            });
            cadena += '</table>';
            $("#tablaClientes").html(cadena);
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}


function eliminarCliente() {

    idCliente = $(this).data('eliminar');

    let parametros = {
        "idCliente": idCliente
    }
    $.ajax({ //aqui van los parametros
            url: "eliminarCliente.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.eliminar) {
                alert("No se ha podido eliminar el cliente, vuelva a intentarlo");
            } else {
                alert("Cliente eliminado correctamente");
                ($('tr[data-eliminar=' + idCliente + ']').remove());
                selectClientes();

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