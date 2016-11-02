<!DOCTYPE html>
<html>

    <!-- Mirrored from ashobiz.asia/olsonadmin15/ by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 11 Jul 2014 00:20:54 GMT -->
    <head>
        <meta charset="utf-8">
        <!-- Title here -->
        <title>Domu Merkatus Admin</title>
        <!-- Description, Keywords and Author -->
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your,Keywords">
        <meta name="author" content="ResponsiveWebInc">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo base_url(CSS . "bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "animate.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "jquery.gritter.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "fullcalendar.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "bootstrap-switch.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "bootstrap-datetimepicker.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "rateit.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "jquery.cleditor.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "jquery-ui.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "prettyPhoto.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(CSS . "style.css"); ?>">



    </head>
    <!--    <body data-spy="scroll">-->

    <body >






        <?php echo $body ?>


        <script src="<?php echo base_url(JS . "jquery.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "bootstrap.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery-ui-1.10.2.custom.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "peity.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "fullcalendar.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.rateit.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.prettyPhoto.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.flot.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.flot.pie.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.flot.stack.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.flot.resize.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.gritter.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "jquery.cleditor.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "bootstrap-datetimepicker.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "bootstrap-switch.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "respond.min.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "html5shiv.js"); ?>"></script>
        <script src="<?php echo base_url(JS . "custom.js"); ?>"></script>


        <script type="text/javascript">


            $(function() {

                /* Bar Chart starts */

                var d1 = [];
                for (var i = 0; i <= 35; i += 1)
                    d1.push([i, parseInt(Math.random() * 30)]);

                var d2 = [];
                for (var i = 0; i <= 35; i += 1)
                    d2.push([i, parseInt(Math.random() * 30)]);


                var stack = 0, bars = true, lines = false, steps = false;

                function plotWithOptions() {
                    $.plot($("#home-chart"), [d1, d2], {
                        series: {
                            stack: stack,
                            lines: {show: lines, fill: true, steps: steps},
                            bars: {show: bars, barWidth: 0.8}
                        },
                        grid: {
                            borderWidth: 0, hoverable: true, color: "#777"
                        },
                        colors: ["#16cbe6", "#0fa6bc"],
                        bars: {
                            show: true,
                            lineWidth: 0,
                            fill: true,
                            fillColor: {colors: [{opacity: 0.9}, {opacity: 0.8}]}
                        }
                    });
                }

                plotWithOptions();

                $(".stackControls input").click(function(e) {
                    e.preventDefault();
                    stack = $(this).val() == "With stacking" ? true : null;
                    plotWithOptions();
                });
                $(".graphControls input").click(function(e) {
                    e.preventDefault();
                    bars = $(this).val().indexOf("Bars") != -1;
                    lines = $(this).val().indexOf("Lines") != -1;
                    steps = $(this).val().indexOf("steps") != -1;
                    plotWithOptions();
                });

                /* Bar chart ends */

            });



        </script>


    </body>
</html>
