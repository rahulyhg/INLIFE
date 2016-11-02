  
<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home pr-10"></i>
                <a class="link-dark" href="<?php echo base_url("home") ?>">Inicio</a>
            </li>
            <li class="active"> <a class="link-dark" href="<?php echo base_url("resource") ?>">Recursos</a></li>
            <li class="active">  <?php
                $id_tipo_recurso_actividad = intval($resource_item[0]["id_tipo_recurso"]);

                if ($id_tipo_recurso_actividad == 1) {

                    echo "Multimedia";
                } else if ($id_tipo_recurso_actividad == 2) {
                    echo "Documentos";
                }
                ?></li>
        </ol>
    </div>
</div>
<section class="clearfix pv-30">


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src='<?php echo URL_RESOURCES_WEB . $resource_item[0]["imagen"]; ?>' alt='' style="width: 100%; "> 
                <br>
                <div class="body">
                    <div class="pv-15 visible-lg"></div>
                    <h3><strong><?php echo $resource_item[0]["titulo"]; ?></strong></h3>
                    <div class="separator-2"></div>
                    <p class="margin-clear txt-justify">
                        <?php echo $resource_item[0]["desc_recurso"]; ?>    
                    </p>
                    <br>

                </div>

            </div>
            <div class="col-md-9">

                <p class="margin-clear txt-justify">
                    <?php
                    $id_tipo_recurso_actividad = intval($resource_item[0]["id_tipo_recurso"]);

                    if ($id_tipo_recurso_actividad == 1) {

                        echo "<video controls autoplay style='width:100%;'>" .
                        "<source src='" . URL_RESOURCES_WEB . $resource_item[0]["url"] . "'>" .
                        "</video>";
                    } else if ($id_tipo_recurso_actividad == 2) {

                        echo "<p style='text-align:justify;'>" . $resource_item[0]["contenido"] . "</p>";

                        //  echo "<embed src='" . URL_RESOURCES_WEB . $resource_item[0]["url"] . "' style='width:100%;height:450px;' type='application/pdf'>";
                    }
                    ?>
                </p>
                <br>

            </div>
        </div>
    </div>
</section>
