 
<div class="page-wrapper">


    <div class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb">
                <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="<?php echo base_url("home")?>">Inicio</a></li>
                <li class="active">Contacto</li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->
    <div id="main-wrapper">
        <main id=" " class="background contact-galaxy " data-image="<?php echo base_url("resources/images/partical-bg.jpg") ?>" style=" background-image: url('<?php echo base_url("resources/images/partical-bg.jpg") ?>')!important;background-size: cover!important;">
            <div class="overlay" style="background-color: rgba(0,0,0,0.6)"></div>
            <div class="nc-content-section index nc-active vhm">
                <div id="particles-js" style="height: 320px!important;">
                    <div id="ajax-page" class=" vhm-item" style="
                         /* left: 50%!important; */
                         width: 96%!important;
                         top: 180px;
                         /* margin-top: -282px; */
                         position: absolute;">

                        <div class="container contact-info-galaxy-container" >
                            <div class="row" style="margin-top: 5%;">
                                <div class="col-md-12 col-sm-12 col-lg-12 ">
                                    <h1 class="page-title text-center" style="color:white;">Conéctate con Nosotros</h1>
                                    <div class="separator"></div>

                                    <ul class="list-inline mb-20 text-center"  style="color:white;">
                                        <li><i class="text-default fa fa-map-marker pr-5"></i>Cali, Colombia</li>
                                        <li> <i class="text-default fa fa-phone pl-10 pr-5"></i>+57 304 244 5029 </li>
                                        <li> <i class="text-default fa fa-envelope-o pl-10 pr-5"></i>info@inlife.com.co </li>
                                    </ul>
                                    <div class="separator"></div>
                                    <ul class="social-links circle animated-effect-1 margin-clear" style=" 
                                        width: 185px;
                                        margin: 0 auto;
                                        ">
                                        <li class="facebook"><a target="_blank" href="https://www.facebook.com/InLifeTech"><i class="fa fa-facebook"></i></a></li>
                                        <li class="instagram"><a target="_blank" href="https://instagram.com/inlife_group"><i class="fa fa-instagram"></i></i></a></li>
                                        <li class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UCvP63_5_WN-o4vnb5wO8qgg/videos"><i class="fa fa-youtube"></i></a></li>
                                        <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/inlife-tecnolog%C3%ADa-al-servicio-del-ser-?trk=biz-companies-cym"><i class="fa fa-linkedin"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="nc-overlay"></div>
        </main>
    </div>





    <!-- banner end -->

    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">

        <div class="container">
            <div class="row">

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-12 space-bottom">

                    <div class="row">
                        <div class="col-md-8">
                            <h4><strong>¡Escríbenos! Estamos para escucharte</strong></h4>
                            <div class="separator-2"></div>
                            <div class="alert alert-success hidden" id="MessageSent">
                                We have received your message, we will contact you very soon.
                            </div>
                            <div class="alert alert-danger hidden" id="MessageNotSent">
                                Oops! Something went wrong please refresh the page and try again.
                            </div>
                            <div class="contact-form">
                                <form   class="margin-clear"  >
                                    <div class="form-group has-feedback">
                                        <label for="name">Nombre*</label>
                                        <input type="text" class="form-control" id="npt_contac_name" name="name" placeholder="">
                                        <i class="fa fa-user form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">E-mail*</label>
                                        <input type="email" class="form-control" id="npt_contac_email" name="email" placeholder="">
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="subject">Asunto*</label>
                                        <input type="text" class="form-control" id="npt_contac_subject" name="subject" placeholder="">
                                        <i class="fa fa-navicon form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="message">Mensaje*</label>
                                        <textarea class="form-control" rows="6" id="npt_contac_message" name="message" placeholder=""></textarea>
                                        <i class="fa fa-pencil form-control-feedback"></i>
                                    </div>
                                    <input id="btn_send_user_message" type="button" value="Enviar" class="submit-button btn btn-default">
                                
                                
                                <div style="display: none;" class="alert alert-danger required-fileds-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Todos los campos son obligatorios
                                    </div>
                                    <div  style="display: none;" class="alert alert-danger invalid-contact-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Ingresa un correo válido
                                    </div>
                                   
                                    <div  style="display: none;" class="alert alert-success success-contact-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Hemos recibido tu mensaje, en breve te estaremos contactando.
                                    </div>
                                
                                
                                
                                </form>
                            </div>
                        </div>     

                    </div>
                </div>
                <!-- main end -->
            </div>
        </div>
    </section>
    <!-- main-container end -->

    <!-- section start -->
    <!-- ================ -->

    <div class="clearfix"></div>
    <!-- section end -->
    <section class="section light-gray-bg pv-10 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-action text-center">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <h2 class="title">Suscríbete a Nuestra Comunidad!</h2>
                                <p>Recibe en tu correo nuestras novedades y próximos eventos</p>
                                <div class="separator"></div>
                                <form class="form-inline margin-clear">
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="subscribe2">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email_home_user_suscribe" placeholder="Escribe tu Correo" name="subscribe2" required>
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                    </div>
                                    <button   id="btn_home_user_suscript" type="button" class="btn btn-default-transparent btn-sm btn-hvr hvr-shutter-in-horizontal">Suscribirme <i class="fa fa-send"></i></button>

                                    <div style="display: none;" class="alert alert-danger empty-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Ingresa un correo para que hagas parte de nuestra comunidad.
                                    </div>
                                    <div  style="display: none;" class="alert alert-danger invalid-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Ingresa un correo válido
                                    </div>
                                    <div  style="display: none;" class="alert alert-danger exist-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        El correo ingresado ya se encuentra inscrito
                                    </div>
                                    <div  style="display: none;" class="alert alert-success success-mail-message" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Gracias por suscribirte, pronto enviaremos información a tu correo.
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 

</div>
