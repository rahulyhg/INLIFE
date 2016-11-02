  
<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><i class="fa fa-home pr-10"></i><a href="<?php echo base_url("home") ?>">Inicio</a></li>
            <li class="active">Recursos Inlife</li>
        </ol>
    </div>
</div>

<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h3 class="page-title"><span class="h2blue"><strong>Herramientas indispensables</strong></span> para tu <span class="h2blue"><strong>Expansi¨®n!</strong></span></h3>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <!-- 
<a href="#" class="btn btn-default-transparent btn-hvr hvr-rectangle-in">IN <strong>MULTIMEDIA</strong></a> 
<a href="#" class="btn btn-default-transparent btn-hvr hvr-rectangle-in">IN <strong>DOCUMENTOS</strong></a> 
<a href="#" class="btn btn-default-transparent btn-hvr hvr-rectangle-in">IN <strong>MEDITACIONES</strong></a>
<br>
<br>
                -->



                <!-- isotope filters start -->
                <div class="filters">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#" data-filter="*"><span class="inlife"><strong>Todos</strong></span></a></li>
 
                        <li class=""><a href="#" data-filter=".filter-1"><span class="inlifenaranja"><i class="fa fa-headphones"></i> Multimedia</span></a></li>
                        <li class=""><a href="#" data-filter=".filter-2"><span class="inlifenaranja"><i class="fa fa-leanpub"></i> Documentos</span></a></li>
                        <li class=""><a href="#" data-filter=".filter-3"><span class="inlifenaranja"><i class="fa fa-mobile-phone"></i> Apps</span></a></li>

                    </ul>
                </div>
                <!-- isotope filters end -->

                <div class="isotope-container-fitrows row grid-space-10" style="display: block; position: relative; height: 855.5px;">


                    <?php
                    foreach ($resource_list as $resource) {




                        echo "<div class='col-sm-6 col-md-3 isotope-item filter-" . $resource["id_tipo_recurso"] . "' style='position: absolute; left: 0px; top: 428px;'>" .
                        "<div class='image-box style-2 mb-20 shadow bordered light-gray-bg text-center'>" .
                        "<div class='overlay-container'>" .
                        "<img src='" . URL_RESOURCES_WEB . $resource["imagen"] . "' alt=''>" .
                        "<div class='overlay-to-top'>" .
                        "<p class='small margin-clear'><em>InLife <br>" . $resource["titulo"] . "</em></p>" .
                        "</div>" .
                        "</div>" .
                        "<div class='body'>" .
                        "<h3>" . $resource["titulo"] . "</h3>" .
                        "<div class='separator'></div>" .
                        "<p>" . $resource["desc_recurso"] . "</p>" .
                        "<a href='" . base_url('resource/show/' . $resource["id_recurso_web"]) . "' class='btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear'>" .
                        "Ver<i class='fa fa-arrow-right pl-10'></i>" .
                        "</a>" .
                        "</div>" .
                        " </div>" .
                        " </div>";
                    }
                    ?>





                </div>

            </div>
            <!-- main end -->

        </div>
    </div>
</section>
