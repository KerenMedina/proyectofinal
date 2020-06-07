$(function() {
    $("#boton").on("click", accesoUsuarios);
}); // FIN DE CARGA

function accesoUsuarios() {
    let parametros = $("#formulario").serialize();

    console.log(parametros);

    $.ajax({ //aqui van los parametros
            url: "comprobarUsuario.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback

            if (!respuesta.login) {
                $('#respuesta').addClass('alert alert-danger');
                $('#respuesta').html("Error! Usuario o contraseña incorrectos");
            } else {
                if (respuesta.admin) {
                    window.location = "../Administrador/principal/pagPrincipal.php";

                } else if (respuesta.cliente) {
                    window.location = "../Cliente/principal/pagPrincipal.php";

                } else if (respuesta.guia) {
                    window.location = "../Guia/principal/pagPrincipal.php";

                }
            }

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
}