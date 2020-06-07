let array = {
    "guia": false,
    "horario": false,
    "existe": false
};

let existe = false;
let reservas;
let idCliente = $('#idCliente').val();
let idTour = $('#idTour').val();
let idGuia;
let idHorario;

$(function() {
    obtenerReservas();
    $("#confirmarReserva").on("click", añadirReserva);
    $("input[name=horario]").on("click", seleccionarHorario);
    $("#select_guia").on('change', seleccionarGuia);
}); // FIN DE CARGA

function añadirReserva() {
    idCliente = $('#idCliente').val();
    idTour = $('#idTour').val();

    let parametros = {
        "idCliente": idCliente,
        "idTour": idTour,
        "idGuia": idGuia,
        "idHorario": idHorario
    }
    $.ajax({ //aqui van los parametros
            url: "confirmarReserva.php",
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
    idHorario = $(this).val();
    array['horario'] = true;

    comprobarExisteReserva(idHorario);
    comprobarboton();

}

function seleccionarGuia() {
    idGuia = $('#select_guia').val();

    if (idGuia != -1) {
        array['guia'] = true;
    } else {
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

function obtenerReservas() {

    let parametros = {
        "idCliente": idCliente,
        "idTour": idTour,
    }

    $.ajax({ //aqui van los parametros
            url: "../funciones/existeReserva.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            reservas = respuesta;
        })
        .fail(function(jqXHR, textStatus, errorThrown) { //fallo
            console.log("No se ha podido obtener la información");
            console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
        })
        .always(function() { //que hacer siempre, falle o no
            $("#cargando").html("")
        });
}

function comprobarExisteReserva(idHorario) {
    obtenerReservas();
    $.each(reservas, function(indice, reserva) {
        existe = false;
        if (reserva['idHorario'] == idHorario) {
            existe = true;
        }
    });

    if (existe) {
        array['existe'] = false;
        comprobarboton();
    } else {
        array['existe'] = true;
        comprobarboton();
    }
}