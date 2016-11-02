 
<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home pr-10"></i>
                <a class="link-dark" href="<?php echo base_url("home") ?>">Inicio</a>
            </li>

            <li class="active">Comunidad</li>
        </ol>
    </div>
</div> 
<section class="clearfix pv-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="separator"></div>
                <!-- pills start -->
                <!-- ================ -->
                <div class="process">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills" role="tablist">
                        <li class="active"><a href="#pill-pr-1" role="tab" data-toggle="tab" title="Step 1"><span class="inlifenaranja"><i class="icon-user-1"></i></span> <span class="inlife"><strong>Regístrate</strong></span></a></li>
                        <li><a href="#pill-pr-2" role="tab" data-toggle="tab" title="Step 2"><span class="inlifenaranja"><i class="icon-user-add-1"></i></span> <span class="inlife"><strong>Accede al Panel Personal </strong></span></a></li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content clear-style">


                        <div class="tab-pane active" id="pill-pr-1">
                            <div class="separator-2"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="title"><strong>¿Quieres ser parte de InLife?</strong></h4>
                                    <p>
                                        Ser parte de nuestra comunidad te permitirá acceder a recursos exclusivos que complementan las actividades personalizadas de los procesos de  crecimiento y desarrollo integral, tanto personal como empresarial. <br><br>
                                        Adicionalmente, te permitirá estar conectado con los demás miembros de la comunidad que, al igual que tú, han iniciado un camino hacia el autodescubrimiento y aprovechamiento de las potencialidades que permanecen dormidas a la espera de su despertar. <br>
                                        <br>
                                        Recibirás información y notificaciones de primera mano de los programas, recursos, eventos y talleres ofrecidos por nuestra organización. Inscríbete!
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="center-block border-clear">
                                        <h2 class="title">REGÍSTRATE</h2>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control required-input-form" id="inputName" placeholder="Nombre" required>
                                                    <i class="fa fa-pencil form-control-feedback"></i>
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control required-input-form" id="inputLastName" placeholder="Apellido" required>
                                                    <i class="fa fa-pencil form-control-feedback"></i>
                                                </div>
                                            </div>


                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control required-input-form" id="inputBornPlace" placeholder="Lugar Nacimiento" required>
                                                    <i class="fa fa-map form-control-feedback"></i>
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control required-input-form" id="inputResidencePlace" placeholder="Lugar Residencia" required>
                                                    <i class="fa fa-map form-control-feedback"></i>
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input data-date-format="yyyy-mm-dd" type="text" class="form-control required-input-form" id="inputBornDate" placeholder="Fecha Nacimiento"  required>
                                                    <i class="fa fa-calendar form-control-feedback"></i>
                                                </div>
                                            </div>


                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control required-input-form" id="inputEmail" placeholder="E-mail" required>
                                                    <i class="fa fa-envelope form-control-feedback"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control required-input-form" id="inputTel1" placeholder="Teléfono #1" required>
                                                    <i class="fa fa-phone form-control-feedback"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="inputTel2" placeholder="Teléfono #2" required>
                                                    <i class="fa fa-phone form-control-feedback"></i>
                                                </div>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control  required-input-form" id="inputPassword" placeholder="Contraseña" required>
                                                    <i class="fa fa-lock form-control-feedback"></i>
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control required-input-form" id="inputPasswordConfirm" placeholder="Confirmar Contraseña" required>
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
                            </div><br>

                            <div class="separator-2"></div>








                        </div>
                        <!-- fin pri-1 -->

                        <div class="tab-pane" id="pill-pr-2">
                            <div class="separator-2"></div>
                            <div class="row">
                                <div class="col-md-3">

                                </div>

                                <div class="col-md-6 align-center">
                                    <h3 class="title align-center">Zona exclusiva para usuarios y empresas que se encuentran <strong>vinculados a programas personalizados InLife</strong>.</h3>
                                    <br>
                                    <a href="http://inlife.com.co/diagnostic_platform/login" tager="_blank" class="btn btn-group btn-default btn-animated align-center">Iniciar Sesión <i class="fa fa-lock"></i></a>

                                </div>
                                <div class="col-md-3">

                                </div>
                            </div><br>



                        </div><br>




                    </div>
                    <!-- fin pri-2 -->

                </div>
                <!-- fin pri-3 -->













            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- pills end -->		

<!-- pricing tables start -->
<!-- ================ -->

<!-- pricing tables end -->

</div>
</div>
</div>
</section>

