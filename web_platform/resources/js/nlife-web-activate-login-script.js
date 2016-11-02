//**********************************************************************
//*******CONEXION       ************************************************
//**********************************************************************

var CORE_SERVICES = INLIFE_URL_CONNECTIONS.core;

//**********************************************************************


var register_event = {
    date: null,
    hour: null,
    long: null,
    lat: null
};



$(document).ready(function () {

    navigator.geolocation.getCurrentPosition(showPosition);



    $("#btn_activate_login_user").click(function () {


        var is_empty_files = false;

        $(".form-control").each(function () {

            if ($(this).val() === "" || $(this).val() === " ")
                is_empty_files = true;
        });


        if (!is_empty_files) {

            var email = $("#inputEmail").val();

            if (validateEmail(email)) {

                var pass = $("#inputPassword").val();


                var data_send = {
                    event: register_event,
                    email: email,
                    pass: pass
                };


                $.ajax({
                    url: CORE_SERVICES + "register/activate_login_user",
                    type: "POST",
                    data: data_send,
                    success: function (data) {

                        var data_return = parseInt(data);

                        if (data_return === 1) {
                            location.href = "../../../community/success_activate_login";

                        } else {
                            showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Hubo un problema al activar tu cuenta, intentalo de nuevo más tarde.");

                        }
                    },
                    error: function () {
                        showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Hubo un problema de conexión, intentalo de nuevo más tarde.");
                    }
                });


            } else {
                showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El correo electrónico no es correcto.");
            }
        } else {
            showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Todos los campos son obligatorios.");
        }
    });

});



function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function hide_show_message(message_container) {
    $(message_container).fadeIn(1000, function () {
        setTimeout(function () {
            $(message_container).fadeOut(1000, function () {
            });
        }, 2000);
    });
}

function showErrorFormMessage(id_container, id_label, message) {


    $(id_label).text(message);

    $(id_container).fadeIn(1000, function () {
        setTimeout(function () {

            $(id_container).fadeOut(1000, function () {

            });


        }, 2000);
    });

} 



function showPosition(position) {

    console.log("showPosition");

    if (position.coords.latitude > 0) {
        register_event.lat = "+" + position.coords.latitude;
    } else {
        register_event.lat = position.coords.latitude;
    }
    if (position.coords.longitude > 0) {
        register_event.long = "+" + position.coords.longitude;
    } else {
        register_event.long = position.coords.longitude;
    }


    var today = new Date();

    var event_day = today.getUTCDate();
    var event_month = today.getUTCMonth() + 1;
    var event_year = today.getUTCFullYear();
    var event_hour = today.getUTCHours();
    var event_min = today.getUTCMinutes();
    var event_sec = today.getUTCSeconds();


    if (event_hour < 10) {
        event_hour = "0" + event_hour;
    }
    if (event_min < 10) {
        event_min = "0" + event_min;
    }
    if (event_sec < 10) {
        event_sec = "0" + event_sec;
    }



    var register_hour = event_hour + ":" + event_min + ":" + event_sec;
    var register_date = event_day + "." + event_month + "." + event_year;

    register_event.date = register_date;
    register_event.hour = register_hour;
}