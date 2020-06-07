let array = {
    "nick": false,
    "contraseña": false,
    "dni": false,
    "email": false,
    "telefono": false,
    "idomas": true
};
let contador = 0;

$(function() {
    $("#nick").on("blur", nickGuia);
    $("#dni").on("blur", dniGuia);
    $("#pass").on("blur", passGuia);
    $("#email").on("blur", emailGuia);
    $("#telefono").on("blur", telefonoGuia);
    $("#masIdiomas").on("click", masIdiomas);
    $("#boton").on("click", añadirGuia);
}); // FIN DE CARGA


function nickGuia() {
    let nick = $('#nick').val();

    if (nick != "") {
        //parametros=$("#nombreIdForm").serialize();

        let parametros = { "nick": nick };
        $.ajax({ //aqui van los parametros
                url: "../funciones/existeNickGuia.php",
                dataType: "json",
                cache: false, //para que no tire de cache, no hace falta rand
                method: "POST", //es el por defecto
                data: parametros
            })
            .done(function(respuesta) { //respuesta correcta Callback

                if (respuesta.nick == true) {
                    array["nick"] = false;
                    $('#errorNick').addClass('alert alert-danger');
                    $('#errorNick').html("Error! Nick no valido");
                } else {
                    array["nick"] = true;
                    $('#errorNick').removeClass('alert alert-danger');
                    $('#errorNick').addClass('alert alert-success');
                    $('#errorNick').html("Nick valido!");
                }
                comprobarboton();

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
    } else {
        $('#errorNick').addClass('alert alert-danger');
        $('#errorNick').html("Error! Nick no puede ser vacio");
    }
}

function dniGuia() {
    let dni = $('#dni').val();

    if (dni != "") {
        valido = validateDNI(dni);
        console.log(valido);
        if (valido) {
            //parametros=$("#nombreIdForm").serialize();

            let parametros = { "dni": dni };
            $.ajax({ //aqui van los parametros
                    url: "../funciones/existeDniGuia.php",
                    dataType: "json",
                    cache: false, //para que no tire de cache, no hace falta rand
                    method: "POST", //es el por defecto
                    data: parametros
                })
                .done(function(respuesta) { //respuesta correcta Callback

                    if (respuesta.dni == true) {
                        array["dni"] = false;
                        $('#errorDNI').addClass('alert alert-danger');
                        $('#errorDNI').html("Error! DNI no valido");
                    } else {
                        array["dni"] = true;
                        $('#errorDNI').removeClass('alert alert-danger');
                        $('#errorDNI').addClass('alert alert-success');
                        $('#errorDNI').html("DNI valido!");
                    }
                    comprobarboton();

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
        } else {
            $('#errorDNI').addClass('alert alert-danger');
            $('#errorDNI').html("Error! DNI formato no valido");
        }
    } else {
        $('#errorDNI').addClass('alert alert-danger');
        $('#errorDNI').html("Error! DNI no puede ser vacio");
    }
}

function passGuia() {
    let pass = $('#pass').val();

    if (pass.length < 8) {
        array["contraseña"] = false;
        $('#errorPass').addClass('alert alert-danger');
        $('#errorPass').html("Error! La contraseña tiene que tener minimo 8 digitos");
    } else {
        array["contraseña"] = true;
        $('#errorPass').removeClass('alert alert-danger');
        $('#errorPass').addClass('alert alert-success');
        $('#errorPass').html("Contraseña valida!");
    }
    comprobarboton();
}

function emailGuia() {
    let email = $('#email').val();

    if (!validarEmail(email)) {
        array["email"] = false;
        $('#errorEmail').addClass('alert alert-danger');
        $('#errorEmail').html("Error! Formato email incorrecto");
    } else {
        array["email"] = true;
        $('#errorEmail').removeClass('alert alert-danger');
        $('#errorEmail').addClass('alert alert-success');
        $('#errorEmail').html("Campo valido!");
    }
    comprobarboton();
}

function telefonoGuia() {
    let tel = $('#telefono').val();
    esNum = Number.isInteger(tel);
    if (tel.length == 9 && isNaN(tel) == false) {
        array["telefono"] = true;
        $('#errorTel').removeClass('alert alert-danger');
        $('#errorTel').addClass('alert alert-success');
        $('#errorTel').html("Campo valido!");

    } else {
        array["telefono"] = false;
        $('#errorTel').addClass('alert alert-danger');
        $('#errorTel').html("Error! Formato de telefono incorrecto");
    }
    comprobarboton();
}

function masIdiomas() {
    contador++;
    let parametros = { "contador": contador };

    $.ajax({ //aqui van los parametros
            url: "selectIdiomas.php",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (contador == 1) {
                $("#selectIdiomas2").html(respuesta);
            }
            if (contador == 2) {
                $("#selectIdiomas3").html(respuesta);
                $("#iconoMas").remove();
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

function añadirGuia() {
    let parametros = $("#formulario").serialize();

    $.ajax({ //aqui van los parametros
            url: "insertarGuia.php",
            dataType: "json",
            cache: false, //para que no tire de cache, no hace falta rand
            method: "POST", //es el por defecto
            data: parametros
        })
        .done(function(respuesta) { //respuesta correcta Callback
            if (!respuesta.insertar) {
                alert("Insercion no realizada, vuelve a intentarlo");
            } else {
                alert("Insercion correcta");
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

function comprobarboton() {
    comprobar = true;
    $.each(array, function(index, valor) {
        if (valor == false) {
            comprobar = false;
        }
    });
    if (comprobar) {
        $("#boton").removeAttr('disabled');
        $('#boton').removeClass('btn-light');
        $('#boton').addClass('btn-primary');
    } else {
        $("boton").attr('disabled', 'disabled');
        $('#boton').addClass('btn-light');
        $('#boton').removeClass('btn-primary');
    }
}

function validateDNI(dni) {
    let numero, l, letra;
    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;

    dni = dni.toUpperCase();

    if (expresion_regular_dni.test(dni) === true) {
        numero = dni.substr(0, dni.length - 1);
        numero = numero.replace('X', 0);
        numero = numero.replace('Y', 1);
        numero = numero.replace('Z', 2);
        l = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != l) {
            //alert('Dni erroneo, la letra del NIF no se corresponde');
            return false;
        } else {
            //alert('Dni correcto');
            return true;
        }
    } else {
        //alert('Dni erroneo, formato no válido');
        return false;
    }
}

function validarEmail(email) {
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (caract.test(email) == false) {

        return false;
    } else {
        return true;
    }
}