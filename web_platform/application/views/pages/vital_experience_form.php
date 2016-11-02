<!-- section start -->
<!-- ================ -->
<section class="section light-gray-bg pv-40 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-center ">
                <div class="call-to-action  ">
                    <div class="row align-center ">
                        <div class="col-sm-2  ">
                        </div>
                        <div class="col-sm-8 align-center ">
                            <br>
                            <div align="center">

                                <img style="margin:0 auto;display: block;"
                                     src="<?php echo base_url("resources/images/vital_experience_2.jpg"); ?>"> 
                                <br>
                                <input style="display: none;" type="text" class="form-control" id="inputIdEvent" value="<?php echo $id_event; ?>" >


                             
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input-required-form-experience" id="inputName" placeholder="Nombre" required>
                                                <i class="fa fa-pencil form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input-required-form-experience" id="inputLastName" placeholder="Apellido" required>
                                                <i class="fa fa-pencil form-control-feedback"></i>
                                            </div>
                                        </div>


                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input-required-form-experience" id="inputBornPlace" placeholder="Lugar Nacimiento" required>
                                                <i class="fa fa-map form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input-required-form-experience" id="inputResidencePlace" placeholder="Lugar Residencia" required>
                                                <i class="fa fa-map form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input data-date-format="yyyy-mm-dd" type="text" class="form-control input-required-form-experience" id="inputBornDate" placeholder="Fecha Nacimiento"  required>
                                                <i class="fa fa-calendar form-control-feedback"></i>
                                            </div>
                                        </div>


                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control input-required-form-experience" id="inputEmail" placeholder="E-mail" required>
                                                <i class="fa fa-envelope form-control-feedback"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control input-required-form-experience" id="inputPhone1" placeholder="Teléfono contacto #1" required>
                                                <i class="fa fa-phone form-control-feedback"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control" id="inputPhone2" placeholder="Teléfono contacto #2" required>
                                                <i class="fa fa-phone form-control-feedback"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control input-required-form-experience" id="inputPassword" placeholder="Contraseña" required>
                                                <i class="fa fa-lock form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control input-required-form-experience" id="inputPasswordConfirm" placeholder="Confirmar Contraseña" required>
                                                <i class="fa fa-lock form-control-feedback"></i>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="  col-sm-12">
                                                <button style="float: right;" type="button" id="btn_register_user" class="btn btn-group btn-default btn-animated">Regístrate <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>


                                        <div id="message_register_form" class="alert  alert-icon alert-danger" role="alert" style="display: none;">
                                            <i class="fa fa-times"></i>
                                            <b>Error:</b><p id="community_register_form_error_message"></p>
                                        </div>


                                        <div id="message_success_register_form"  class="alert alert-icon alert-success" role="alert" style="display: none;">
                                            <i class="fa fa-check"></i>
                                            <b>Registro Exitoso:</b>
                                            <p>En breve enviaremos un correo para confirmar tus datos
                                                y activar tu cuenta; de no recibirlo en tu bandeja de entrada, verifícalo en
                                                la bandeja de correo no deseado y márcalo como correo seguro.</p>
                                        </div>

                                    </form>


                                
                            </div>
                        </div>
                        <div class="col-sm-2  ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

</section>
<!-- section end -->




