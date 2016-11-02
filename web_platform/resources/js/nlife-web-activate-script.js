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

    var inputResidencePlace = document.getElementById('inputResidencePlace');
    var autocompleteResidencePlace = new google.maps.places.Autocomplete(inputResidencePlace);


    google.maps.event.addListener(autocompleteResidencePlace, 'place_changed', function () {

        var place = autocompleteResidencePlace.getPlace();

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        setRegisterEvent(lat, lng);

    });

    $("#activate_account_after_email").click(function () {

        var id_user = $("#id_user").val();
        var register_token = $("#register_token").val();

        var data_send = {
            id: id_user,
            event: register_event,
            token: register_token
        };


        if (register_event.date != null) {
            $.ajax({
                url: CORE_SERVICES + "register/activate_acount",
                type: "POST",
                data: data_send,
                success: function (data) {

                    var data_return = parseInt(data);

                    if (data_return === 1) {

                        $("#activate_account_after_email").fadeOut(1000, function () {
                            $("#message_success_register_form").fadeIn(1000, function () {
                            });
                        });


                    } else {
                        showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Hubo un problema al activar tu cuenta, intentalo de nuevo más tarde.");

                    }
                },
                error: function () {
                    showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Hubo un problema al activar tu cuenta, intentalo de nuevo más tarde.");

                }
            });


        } else {
            showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Debes ingresar tu lugar de residencia.");

        }




    });


});


function setRegisterEvent(latitude, longitude) {

    if (latitude > 0) {
        register_event.lat = "+" + latitude;
    } else {
        register_event.lat = latitude;
    }
    if (longitude > 0) {
        register_event.long = "+" + longitude;
    } else {
        register_event.long = longitude;
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