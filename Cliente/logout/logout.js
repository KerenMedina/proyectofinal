$(function() {
    $("#logout").on("click", cerrarSesion);
});


function cerrarSesion() {
    $.ajax({ //aqui van los parametros
            url: "../logout/logout.php",
            cache: false, //para que no tire de cache, no hace falta rand
            dataType: "json",
            method: "POST" //es el por defecto
        })
        .done(function(respuesta) { //respuesta correcta Callback
            console.log(respuesta['logout']);
            if (respuesta['logout'] == true) {
                alert("Has cerrado sesión");
                window.location = "../../login/login.html";

            } else {
                alert("No se puede cerrar sesión");

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