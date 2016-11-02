//**********************************************************************
//*******CONEXION       ************************************************
//**********************************************************************


var CORE_SERVICES = INLIFE_URL_CONNECTIONS.core;



//**********************************************************************

var register_user_data = {
    nombre: null,
    apellido: null,
    fecha_nacimiento: null,
    hora_nacimiento: "00:00:00",
    password: null,
    mail: null,
    namePais: null,
    lng: null,
    lat: null,
    nameDpto: null,
    nombreCiudad: null,
    gmtOffset: null,
    dstOffset: null,
    timeZoneId: null,
    countryCode: null,
    nombreCiudadResidencia: null,
    nameDptoResidencia: null,
    namePaisResidencia: null,
    countryCodeResidencia: null,
    latResidencia: null,
    lngResidencia: null,
    gmtOffsetResidencia: null,
    dstOffsetResidencia: null,
    phone1: null,
    phone2: null,
    timeZoneIdResidencia: null
};

var register_event = {
    date: null,
    hour: null,
    long: null,
    lat: null
};


var is_google_places_active = false;

var only_letters = /^[a-zA-Z\s]*$/;
var only_numbers = /[0-9]|\./;

$(document).ready(function () {

    var inputBornPlace = document.getElementById('inputBornPlace');
    var inputResidencePlace = document.getElementById('inputResidencePlace');
    var autocompleteBornPlace = new google.maps.places.Autocomplete(inputBornPlace);
    var autocompleteResidencePlace = new google.maps.places.Autocomplete(inputResidencePlace);

    console.log("Autocomplete");

    google.maps.event.addListener(autocompleteResidencePlace, 'place_changed', function () {

        var place = autocompleteResidencePlace.getPlace();



        var dpt_position = (place.address_components.length) - 2;
        var country_position = (place.address_components.length) - 1;

        register_user_data.nombreCiudadResidencia = place.name;
        register_user_data.nameDptoResidencia = place.address_components[dpt_position].long_name;
        register_user_data.namePaisResidencia = place.address_components[country_position].long_name;
        register_user_data.countryCodeResidencia = place.address_components[country_position].short_name;
        register_user_data.latResidencia = place.geometry.location.lat();
        register_user_data.lngResidencia = place.geometry.location.lng();

        is_google_places_active = true;

        $.ajax({
            url: "http://api.geonames.org/searchJSON",
            dataType: "jsonp",
            data: {
                featureClass: "P",
                style: "full",
                lang: "es",
                maxRows: 3,
                name_equals: register_user_data.nombreCiudadResidencia,
                username: "lgmdevel"
            },
            success: function (data) {


                var dataStringify = JSON.stringify(data.geonames);
                var dataParse = JSON.parse(dataStringify);
                for (var i = 0; i < dataParse.length; i++) {
                    if (dataParse[i].adminName1 === register_user_data.nameDptoResidencia) {
                        register_user_data.gmtOffsetResidencia = dataParse[i].timezone.gmtOffset;

                        register_user_data.dstOffsetResidencia = dataParse[i].timezone.dstOffset;
                        register_user_data.timeZoneIdResidencia = dataParse[i].timezone.timeZoneId;
                    }
                }
            }
        });



    });
    google.maps.event.addListener(autocompleteBornPlace, 'place_changed', function () {

        var place = autocompleteBornPlace.getPlace();



        var dpt_position = (place.address_components.length) - 2;
        var country_position = (place.address_components.length) - 1;

        register_user_data.nombreCiudad = place.name;
        register_user_data.nameDpto = place.address_components[dpt_position].long_name;
        register_user_data.namePais = place.address_components[country_position].long_name;
        register_user_data.countryCode = place.address_components[country_position].short_name;
        register_user_data.lat = place.geometry.location.lat();
        register_user_data.lng = place.geometry.location.lng();

        is_google_places_active = true;

        $.ajax({
            url: "http://api.geonames.org/searchJSON",
            dataType: "jsonp",
            data: {
                featureClass: "P",
                style: "full",
                lang: "es",
                maxRows: 3,
                name_equals: register_user_data.nombreCiudad,
                username: "lgmdevel"
            },
            success: function (data) {


                var dataStringify = JSON.stringify(data.geonames);
                var dataParse = JSON.parse(dataStringify);
                for (var i = 0; i < dataParse.length; i++) {
                    if (dataParse[i].adminName1 === register_user_data.nameDpto) {
                        register_user_data.gmtOffset = dataParse[i].timezone.gmtOffset;

                        register_user_data.dstOffset = dataParse[i].timezone.dstOffset;
                        register_user_data.timeZoneId = dataParse[i].timezone.timeZoneId;
                    }
                }
            }
        });



    });


    $('#inputBornDate').datepicker({
        language: 'en',
        startDate: new Date("1980-02-01")
    });

    $("#btn_register_user").click(function () {

        var born_date = $("#inputBornDate").val();
        var born_date_array = born_date.split("-");

        var day = born_date_array[2];
        var month = born_date_array[1];
        var year = born_date_array[0];

        var date_compare = new Date(year + "/" + month + "/" + day);
        var today = new Date();


        var day_replace = day.replace("0", "");
        var month_replace = month.replace("0", "");
        var replace_born_date = day_replace + "." + month_replace + "." + year;
        
        console.log("---date_compare------->"+date_compare);
        console.log("---replace_born_date------->"+replace_born_date);


    });
    $("#btn_register_userrrr").click(function () {
        var is_empty_files = false;

        $(".required-input-form").each(function () {

            if ($(this).val() === "" || $(this).val() === " ")
                is_empty_files = true;
        });
        if (!is_empty_files) {

            var email = $("#inputEmail").val();

            if (true) {
                if (is_google_places_active) {
                    var pass = $("#inputPassword").val();
                    var pass_confirm = $("#inputPasswordConfirm").val();

                    if (pass === pass_confirm) {

                        var name = $("#inputName").val();
                        var last_name = $("#inputLastName").val();

                        var inputTel1 = $("#inputTel1").val();
                        var inputTel2 = $("#inputTel2").val();

                        console.log("----->" + inputTel2);
                        console.log("----->" + typeof inputTel2);

                        if (typeof inputTel2 === 'string') {
                            inputTel2 = 0;
                        }

                        console.log("----->" + inputTel2);
                        console.log("----->" + typeof inputTel2);


                        if (name.match(only_letters)) {
                            if (last_name.match(only_letters)) {
                                if (inputTel1.match(only_numbers)) {

                                    var born_date = $("#inputBornDate").val();
                                    var born_date_array = born_date.split("-");

                                    var day = born_date_array[2];
                                    var month = born_date_array[1];
                                    var year = born_date_array[0];

                                    var date_compare = new Date(year + "/" + month + "/" + day);
                                    var today = new Date();

                                    if (today > date_compare) {

                                        var day_replace = day.replace("0", "");
                                        var month_replace = month.replace("0", "");
                                        var replace_born_date = day_replace + "." + month_replace + "." + year;

                                        register_user_data.nombre = name;
                                        register_user_data.phone1 = inputTel1;
                                        register_user_data.phone2 = inputTel2;
                                        register_user_data.apellido = last_name;
                                        register_user_data.mail = email;
                                        register_user_data.fecha_nacimiento = replace_born_date;
                                        register_user_data.password = pass;

                                        setRegisterEvent(register_user_data.latResidencia, register_user_data.lngResidencia);

                                        var data_send = {
                                            data_user: register_user_data,
                                            event: register_event
                                        };

                                        $.ajax({
                                            url: CORE_SERVICES + "register/register_user",
                                            type: "POST",
                                            data: data_send,
                                            success: function (data) {

                                                var is_success_register = parseInt(data);
                                                if (is_success_register === 1) {
                                                    $("#btn_register_user").fadeOut(1000, function () {
                                                        $("#message_success_register_form").fadeIn(1000, function () {
                                                        });
                                                    });
                                                } else {
                                                    showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El correo ingresado ya se encuentra registrado.");
                                                }
                                            },
                                            error: function () {
                                                showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Hubo un problema de conexión, intentalo de nuevo más tarde.");
                                            }
                                        });
                                    } else {
                                        showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "La fecha de nacimiento no debe ser mayor a la fecha actual");

                                    }


                                } else {
                                    showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El texto ingresado en los campos de teléfono deben ser numéricos.");
                                }


                            } else {
                                showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El apellido no debe contener números ni caracteres especiales");
                            }
                        } else {
                            showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El nombre no debe contener números ni caracteres especiales");
                        }
                    } else {
                        showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Las contraseñas no coinciden.");
                    }
                } else {
                    showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "El correo electrónico no es correcto.");
                }
            } else {
                showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Debes ingresar tu lugar de nacimiento");
            }
        } else {
            showErrorFormMessage("#message_register_form", "#community_register_form_error_message", "Todos los campos son obligatorios.");
        }
    });

    $("#close_vide_modal").click(function () {
        var iframe = document.getElementById('video_iframe');
        iframe.src = iframe.src;
    });


    $("#btn_send_user_message").click(function () {



        var name = $("#npt_contac_name").val();
        var email = $("#npt_contac_email").val();
        var subject = $("#npt_contac_subject").val();
        var message = $("#npt_contac_message").val();

        if (name == "" || email == "" || subject == "" || message == "") {
            hide_show_message(".required-fileds-message");
        } else {
            if (validateEmail(email)) {


                var contact_send = {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                };


                $.ajax({
                    url: "contact/send_contact_message",
                    type: "POST",
                    data: contact_send,
                    success: function (data) {
                        $("#npt_contac_name").val("");
                        $("#npt_contac_email").val("");
                        $("#npt_contac_subject").val("");
                        $("#npt_contac_message").val("");
                        hide_show_message(".success-contact-mail-message");
                    },
                    error: function () {
                        onOffline();
                    }
                });
            } else {
                hide_show_message(".invalid-contact-mail-message");
            }
        }
    });
    $("#btn_home_user_suscript").click(function () {
        var email_user = $("#email_home_user_suscribe").val();
        send_suscribe_mail(email_user);
    });
    $("#show_video_modal").click(function () {
        $('#video_modal').modal("show");
    });
    $("#btn_user_suscript").click(function () {
        var email_user = $("#email_user_suscribe").val();
        send_suscribe_mail(email_user);
    });
});

function send_suscribe_mail(email_user) {
    if (email_user != "") {
        if (validateEmail(email_user)) {

            var mail_send = {
                mail: email_user
            };


            $.ajax({
                url: "contact/suscribe_user",
                type: "POST",
                data: mail_send,
                success: function (data) {

                    if (data == 1) {
                        $("#email_user_suscribe").val("");
                        hide_show_message(".success-mail-message");
                    } else {
                        hide_show_message(".exist-mail-message");
                    }


                },
                error: function () {
                    alert("error");
                }
            });

        } else {
            hide_show_message(".invalid-mail-message");

        }
    } else {
        hide_show_message(".empty-mail-message");

    }

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