 
<section class="main-container border-clear light-gray-bg padding-bottom-clear">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <div class="image-box space-top style-4">
                    <div class="row grid-space-0">
                        <div class="col-md-6">
                            <div class="overlay-container">
                                <input value="<?php echo $id_user ?>"  id="id_user" style="display: none;"/>
                                <input value="<?php echo $register_token ?>"  id="register_token" style="display: none;"/>
                                <img src="<?php echo base_url("resources/images/lifepersonalindex.png") ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="body">
                                <div class="pv-30 visible-lg"></div>
                                <span class="h2blue"> <strong>Activaci��n de cuenta</strong></span>
                                <div class="separator-2"></div>
                                <p class="margin-clear txt-justify">
                                    Gracias por se parte de nuestra comunidad
                                    <strong>InLife</strong>, confirmanos en que ciudad te encuentras para brindarte una mejor experiencia y activar tu cuenta!
                                </p>
                                <br>
                                <div class="form-group has-feedback">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="inputResidencePlace" placeholder="En que ciudad te encuentras?" required>
                                    </div>
                                </div>
                                <a id="activate_account_after_email"  class="btn btn-default-transparent btn-hvr hvr-radial-in"><strong>ACTIVAR CUENTA</strong>!</a>
                            </div>
                            <div id="message_register_form" class="alert  alert-icon alert-danger" role="alert" style="display: none;">
                                <i class="fa fa-times"></i>
                                <b>Error:</b><p id="community_register_form_error_message"></p>
                            </div>
                            <div id="message_success_register_form"  class="alert alert-icon alert-success" role="alert" style="display: none;">
                                <i class="fa fa-check"></i>
                                <b>Cuenta Activada:</b>
                                <p>
                                    Tu cuenta ha sido activada, ya puedes iniciar sesi��n en nuestra plataforma InLife
                                    <a href="http://inlife.com.co/diagnostic_platform/login" target="_blank" ><b>www.inlife.com.co/diagnostic_platform</b></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="separator-3"></div><br>
            </div>
        </div>
    </div>
</section> 
