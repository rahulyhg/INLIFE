
$(document).ready(function () {
    "use strict";

    $('#send_message').on('click', function () {
	
		var name = $("#name").val();
		var email = $("#email").val();
		var message = $("#message").val();
		
		if(name != "" && email != "" && message != ""){

			if (validateEmail(email)) {
				
				var send_data_contact = {
		            'name': name,
		            'email': email,
		            'message': message 
	        	};
		       
		        $.ajax({
		            url: "http://inlife.com.co/core/contact/contact_user_message",
		            type: "POST",
		            data: send_data_contact,
		            success: function (data) {
		                mostrar_mensaje_exito(name);
		            },
		            error: function () {
						mostrar_mensaje_error ("Lo sentimos, hubo un error de conexión, intentalo de nuevo.");
		            }
		        });
			}else{
				mostrar_mensaje_error ("El correo ingresado no tiene el formato correcto.");
			}
		}else{
			mostrar_mensaje_error ("Todos los campos son obligatorios.");
		} 
    });
});

function mostrar_mensaje_error(mensaje){

	 $("#lbl_msg_error").text(mensaje);

  $("#send_message").fadeOut(2000,function(){
		$(".alert-danger").fadeIn(2000,function(){
			setTimeout(function(){
				$(".alert-danger").fadeOut(2000,function(){
					 $("#send_message").fadeIn(2000,function(){
					});
			   });
			},2000);
		});
   });
}

function mostrar_mensaje_exito(usuario){

	var message = "<b>"+usuario+"</b> gracias por escribirnos, pronto estaras recibiendo respuesta de nosotros.";
   $("#lbl_msg_success").html(message);

   $("#send_message").fadeOut(2000,function(){
		$(".alert-success").fadeIn(2000,function(){
			setTimeout(function(){
				$(".alert-success").fadeOut(2000,function(){
					 $("#send_message").fadeIn(2000,function(){
					});
			   });
			},2000);
		});
   });
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


