<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="icon" href="<?php echo base_url();?>css/images/hr.png" type="image/png" sizes="16x16">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>HR Manual Document Process</title>
        

        <link rel="stylesheet" href="<?php echo base_url();?>css/styles.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>css/script1.js"></script>


        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url(); ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>dist/css/sb-admin-2.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>css/customLogin.css" rel="stylesheet">


        <link href="<?php echo base_url(); ?>css/themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>css/themes/1/js-image-slider.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>css/generic.css" rel="stylesheet" type="text/css" />

        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg">

        <div id='cssmenu'>
            <ul>
               <li class="active"><a href='<?php echo base_url()?>'><span><font size="3">Jollibee Foods Corporation</font></span></a></li>
            </ul>
        </div>

        <div class="container">
            <div class="row" style="">
                
                <table border="0" width="100%" height="100%" align="center" class="tbl">
                    <tr>
                        <td width="75%">
                                <div class="login-panel panel panel-default panel1" style="">
                                        <!--
                                        <div class="panel-heading">
                                            <h3 class="panel-title" style="color: rgb(254,117,16);">Announcements</h3>
                                        </div>
                                        -->
                                        <div class="panel-body">
                                            <!--
                                            <p>
                                                Hello from the other side.<br><br>
                                                Palagay nalang ng announcements dito.<br>
                                                Di ko nilagyan ng ganito yung admin. Feeling ko di necessary sakanila. IDK haha<br><br>
                                                Tsaka pala hiniwalay ko yung available documents sa archived.
                                            </p>

                                            <p style="float: right; padding-top: 15%;">
                                                -- Ruslie Joy "GANDA" Dela Torre
                                            </p>
                                            -->
                                            <div id="sliderFrame" style="margin-top:10px;">
                                                <div id="slider">
                                                    <img src="<?php echo base_url()?>css/images/ihr.png" alt="" />
                                                    <img src="<?php echo base_url()?>css/images/ihr1.png" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                        <td style="padding-left: 2%;">
                                <div class="login-panel panel panel-default panel2" style="">
                                    <div class="panel-heading">
                                        <h3 class="panel-title" style="">Employee Login</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo form_open(base_url().'login/doLogin') ?>
                                            <fieldset style="padding-top: 2%;">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                                                   <span class="text-danger"><?php echo form_error('username'); ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                                </div>
                                                <!-- Change this to a button or input when using this as a form -->
                                                <input id="btn_login" name="btn_login" type="submit" class="btn btn-lg btn-info btn-block" value="Login"/>
                                                <a href="<?php echo base_url();?>LoginA"><div style="float:right; padding-top: 5%;"> I am an admin </div> </a>
                                            </fieldset>
                                        <?php echo form_close(); ?>

                                        <?php
                                        echo "<br>"; 
                                        echo $this->session->flashdata('msg'); ?>
                                    </div>
                                </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>dist/js/sb-admin-2.js"></script>

    </body>

</html>
