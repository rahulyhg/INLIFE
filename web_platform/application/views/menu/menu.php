<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
<div class="page-wrapper">
    <div class="header-container">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2 col-sm-8 col-md-8 col-lg-8 ">
                        <div class="header-top-first clearfix">
                            <ul class="list-inline hidden-sm hidden-xs">
                                <li><i class="fa fa-map-marker pr-5 pl-10"></i>Cali, Colombia</li>
                                <li><i class="fa fa-phone pr-5 pl-10"></i>+57 304 244 5029</li>
                                <li><i class="fa fa-envelope-o pr-5 pl-10"></i> info@inlife.com.co</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                        <div class="btn-group">
                            <a href="<?php echo base_url("community"); ?>" class="btn btn-default btn-sm"> 
                                <i class="fa fa-user pr-10"></i> 
                                Regístrate
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                        <div class="btn-group dropdown">
                            <!--  
                              <a href="http://inlife.com.co/diagnostic_platform/" class="btn btn-default btn-sm">
                                 <i class="fa fa-lock pr-10"></i> 
                            <?php echo $this->lang->line('menu_top_user_login'); ?>
                             </a>-->

                            <a href="http://inlife.com.co/diagnostic_platform"   class="btn btn-default btn-sm"  target="_blank">
                                <i class="fa fa-lock pr-10"></i> 
                                <?php echo $this->lang->line('menu_top_user_login'); ?>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<header class="header  fixed   clearfix" style="    padding: 11px!important;">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="  clearfix">
                    <div id="logo" class="logo">
                        <a href="<?php echo base_url("home"); ?>">
                            <img id="logo_img" src="<?php echo base_url("resources/images/logo_light_blue.png") ?>" alt="The Project">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="header-right clearfix">
                    <div class="main-navigation  animated with-dropdown-buttons">
                        <nav class="navbar navbar-default" role="navigation" style="z-index: 99999;">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav ">
                                        <li class="  active">
                                            <a href="<?php echo base_url("home"); ?>">
                                                <?php echo $this->lang->line('menu_home'); ?>
                                            </a>
                                        </li>
                                        <li class=" mega-menu">
                                            <a href="<?php echo base_url("who_we_are"); ?>" >

                                                <?php echo $this->lang->line('menu_who_we_are'); ?>
                                            </a>
                                        </li>
                                        <li class="dropdown" style="">
                                            <a  class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('menu_services'); ?></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo base_url("personal"); ?>">
                                                        <?php echo $this->lang->line('menu_services_personal'); ?>
                                                    </a></li>
                                                <li><a href="<?php echo base_url("business"); ?>">
                                                        <?php echo $this->lang->line('menu_services_business'); ?>
                                                    </a></li>
                                                <li><a href="<?php echo base_url("lab"); ?>">
                                                        <?php echo $this->lang->line('menu_services_lab'); ?>
                                                    </a><br>
                                                </li>
                                            </ul>
                                        </li>										
                                        <li class="mega-menu narrow">
                                            <a href="<?php echo base_url("resource"); ?>" >
                                                <?php echo $this->lang->line('menu_resources'); ?>
                                            </a>
                                        </li>
                                        <!--  <li class="">
                                              <a href="<?php echo base_url("community"); ?>" >
                                        <?php echo $this->lang->line('menu_community'); ?>
                                              </a></li>-->
                                        <li class="">
                                            <a href="<?php echo base_url("contact"); ?>" >
                                                <?php echo $this->lang->line('menu_contact'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</header>


