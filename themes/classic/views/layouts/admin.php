<!DOCTYPE html>
<html lang="en">

    <!--================================================================================
            Item Name: Materialize - Material Design Admin Template
            Version: 1.0
            Author: GeeksLabs
            Author URL: http://www.themeforest.net/user/geekslabs
    ================================================================================ -->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
        <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
        <title>Materialize - Material Design Admin Template</title>

        <!-- Favicons-->
        <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/favicon/favicon-32x32.png" sizes="32x32">
        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
        <!-- For iPhone -->
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/favicon/mstile-144x144.png">
        <!-- For Windows Phone -->


        <!-- CORE CSS-->    
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">


        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/material-preloader/materialPreloader.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.min.js"></script>
    </head>

    <body>
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
            <div id="loader"></div>        
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START HEADER -->
        <header id="header" class="page-topbar">
            <!-- start header nav-->
            <div class="navbar-fixed">
                <nav class="cyan">
                    <div class="nav-wrapper">
                        <h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1>
                        <ul class="right hide-on-med-and-down">
                            <li class="search-out">
                                <input type="text" class="search-out-text">
                            </li>
                            <li>    
                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light show-search"><i class="mdi-action-search"></i></a>                              
                            </li>
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                            </li>
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                            </li>
                            <!-- Dropdown Trigger -->                        
                            <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- end header nav-->
        </header>
        <!-- END HEADER -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START MAIN -->
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

                <?php $this->renderPartial('//layouts/leftSideBarAdmin') ?>

                <!-- //////////////////////////////////////////////////////////////////////////// -->

                <!-- START CONTENT -->
                <section id="content">

                    <!--start container-->
                    <div class="container">
                        <?php echo $content; ?>
                    </div>
                    <!--end container-->
                </section>
                <!-- END CONTENT -->
            </div>
            <!-- END WRAPPER -->

        </div>
        <!-- END MAIN -->



        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START FOOTER -->
        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">Meboo Team</a> All rights reserved.
                  
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->


        <!-- ================================================
        Scripts
        ================================================ -->

        <!-- jQuery Library -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-1.11.2.min.js"></script>    
        <!--materialize js-->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/materialize.min.js"></script>
        <!--scrollbar-->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/material-preloader/materialPreloader.js"></script>   


        <!-- sparkline -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/sparkline/sparkline-script.js"></script>

        <!--jvectormap-->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jvectormap/vectormap-script.js"></script>
        <!-- data-tables -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/data-tables/data-tables-script.js"></script>

        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins.js"></script>
        <!-- Toast Notification -->
        <script type="text/javascript">
            // Toast Notification
//            $(window).load(function() {
//                setTimeout(function() {
//                    Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
//                }, 1500);
//                setTimeout(function() {
//                    Materialize.toast('<span>You can swipe me too!</span>', 3000);
//                }, 5000);
//                setTimeout(function() {
//                    Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
//                }, 15000);
//            });

        </script>
    </body>

</html>