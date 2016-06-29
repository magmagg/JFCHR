<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" href="<?php echo base_url();?>css/images/hr.png" type="image/png" sizes="16x16">

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iHR: Employee's Online Portal</title>

    <link rel="stylesheet" href="<?php echo base_url();?>css/styles.css">
    <script src="<?php echo base_url();?>js/jq.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>css/script1.js"></script>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="<?php echo base_url(); ?>production/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>production/css/custom.css" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

    <script type="text/javascript" src="<?php echo base_url();?>js/chat.js"></script>
              <script type="text/javascript">
                var chat = new Chat('<?php echo $file?>');

                chat.init();
                var name = '<?php echo $employeeID;?>';
                var chatname = '<?php echo $lname;?>';
                var quitclaimid= '<?php echo $quitclaimID?>';
              </script>
              <script type="text/javascript" src="<?php echo base_url();?>js/settings.js"></script>


    <link href="<?php echo base_url();?>css/select2.min.css" rel="stylesheet" />


    <!--
    <link href="<?php echo base_url();?>css/select2.min.css" rel="stylesheet" />

    <link href="<?php echo base_url();?>css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>css/custom.css" rel="stylesheet" />

    <!-- DataTables CSS
    <link href="<?php echo base_url();?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS
    <link href="<?php echo base_url();?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>" class="site_title"><span>Jollibee Foods Corporation</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>User/dashboard"><i class="fa fa-user pull-right"></i> <font size="3"> Profile</font></a>
                    </li>
                    <li><a href="<?php echo base_url();?>quitclaim/logout"><i class="fa fa-sign-out pull-right"></i> <font size="3"> Log Out</font></a>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                    <?php
                      if(!empty($messages))
                      {
                        foreach($messages as $m)
                        {
                    ?>

                    <li>
                      <a>
                        <span class="image">
                                          <img src="<?php echo base_url(); ?>production/images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span><?php echo $m->message_sender_name; ?></span>
                        <span class="time"><?php echo $m->message_timestamp; ?></span>
                        </span>
                        <span class="message"><?php echo $m->message_content; ?></span>
                      </a>
                    </li>

                    <?php
                        }
                      }
                      else if(empty($messages))
                      {
                    ?>

                        <li>
                          <div class="x_content bs-example-popovers">
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              Your inbox is <strong>Empty.</strong>
                            </div>
                          </div>
                        </li>

                    <?php
                      }
                    ?>
                    <li>
                      <div class="text-center">
                        <a href="inbox.html">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->
