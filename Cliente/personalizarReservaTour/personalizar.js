let array = {
    "guia": false,
    "horario": false,
    "idioma": false,
};

let existe = false;
let reservas;
let idCliente = $('#idCliente').val();
let idTour = $('#idTour').val();
let idGuia;
let horario;
let idioma;

$(function() {
    $("#confirmarReserva").on("click", añadirReserva);
    $("input[name=horarioPers]").on("blur", seleccionarHorario);
    $("#select_idioma").on('change', seleccionarIdioma);
    $("#contenidoSelect").on('change', '.g', seleccionarGuia);
}); // FIN DE CARGA

function añadirReserva() {
    idCliente = $('#idCliente').val();
    idTour = $('#idTour').val();

    let parametros = {
        "idCliente": idCliente,
        "idTour": idTour,
        "idGuia": idGuia,
        "horario": horario,
        "idioma": idioma
    }
    $.ajax({ //aqui van los parametros
            url: "confirmarReservaPersonalizada.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.insertar) {
                alert("No se ha podido realizar la reserva, vuelva a intentarlo");
            } else {
                alert("Reserva realizada correctamente");
                window.location = "../tours/verTodos.php";
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

function seleccionarHorario() {
    horario = $('#horarioPers').val();
    array['horario'] = true;

    comprobarboton();

}

function seleccionarGuia() {
    idGuia = $('#select_guia').val();
    array['guia'] = true;

    comprobarboton();

}

function seleccionarIdioma() {
    idioma = $('#select_idioma').val();

    if (idioma != -1) {
        array['idioma'] = true;
        let parametros = {
            "idioma": idioma
        }

        console.log(idioma);

        $.ajax({ //aqui van los parametros
                url: "selectGuia.php",
                cache: false, //para que no tire de cache, no hace falta rand
                dataType: "json", //si no pongo nada intenta adivinar que es
                data: parametros,
                method: "POST" //es el por defecto
            })
            .done(function(respuesta) { //respuesta correcta Callback
                cadena = "<select id='select_guia' class='g form-control col-5' style='margin-top:10px'>";
                cadena += "<option value='-1'>Elije Guia </option>";

                $.each(respuesta, function($indice, guia) {
                    cod = guia['idGuia'];
                    nick = guia["nick"];
                    cadena += "<option value='" + cod + "'>" + cod + " - " + nick + " </option>";

                });
                cadena += "</select>";

                $("#contenidoSelect").html(cadena);
            })
            .fail(function(jqXHR, textStatus, errorThrown) { //fallo
                console.log("No se ha podido obtener la información");
                console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
            })
            .always(function() { //que hacer siempre, falle o no
                $("#cargando").html("")
            });
    } else {
        array['idioma'] = false;
        $("#contenidoSelect").html("");
        array['guia'] = false;
    }
    comprobarboton();

}

function comprobarboton() {

    comprobar = true;
    $.each(array, function(index, valor) {
        if (valor == false) {
            comprobar = false;
        }
    });
    if (comprobar) {
        $("#confirmarReserva").removeAttr('disabled');
        $('#confirmarReserva').removeClass('btn-light');
        $('#confirmarReserva').addClass('btn-primary');
    } else {
        $("#confirmarReserva").attr('disabled', 'disabled');
        $('#confirmarReserva').addClass('btn-light');
        $('#confirmarReserva').removeClass('btn-primary');
    }
}