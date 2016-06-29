<!DOCTYPE html>
<html lang="en">

<head>


<script src="<?php echo base_url();?>js/tinymce/tinymce.dev.js"></script>
<script>
function init() {
    tinymce.init({
        mode: "textareas",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste"
        ],
        valid_elements: '*[*]',
        add_unload_trigger : false,
        editor_selector : 'editable',
        content_css: 'css/gecko_caret.css'
    });
}

function reInit10x() {
    tinymce.execCommand('mceRemoveEditor', false, 'elm3');

    for (var i = 0; i < 10; i++) {
        tinymce.execCommand('mceRemoveEditor', false, 'elm3');
        tinymce.execCommand('mceAddEditor', false, 'elm3');
    }
}

init();
</script>



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
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/bootstrap-select.min.css">
    <!-- jVectorMap -->
    <link href="<?php echo base_url(); ?>production/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>production/css/custom.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


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

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url();?>Admin"><i class="fa fa-home"></i> Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-lightbulb-o"></i> Manage Announcements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/make_announcement"> Make Announcements</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/view_edit_announcement"> Edit Announcements</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Manage Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/view_users"> View Users</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/import_users"> Import Users</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-laptop"></i> Manage Website <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/make_new_policies"> Make New Policy</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/manage_sbus">Manage SBU'S</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/manage_positions">Manage Positions</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/manage_ranks">Manage Ranks</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-copy"></i> Manage Document <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/view_forms_view"> View Documents </a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/view_archive_view"> View Archive</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/view_forms_upload"> Upload Documents </a>
                      </li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-sign-out"></i> Manage Quitclaim <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/view_quitclaim_workflow_new"> View Quitclaim </a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/load_quitclaim_workflow"> Load Quitclaim Workflow</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/edit_current_quitclaim"> Undergoing Quitclaim </a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-heartbeat"></i> Manage Benefit <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/upload_benefits_summary"> Upload Files</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/benefits_summary_files"> View Files</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-phone"></i> Manage Hotlines <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>admin/view_hotlines"> View All Hotlines</a>
                      </li>
                      <li><a href="<?php echo base_url();?>admin/manage_hotlines"> New Hotine</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

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
                    Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-sign-out pull-right"></i> <font size="3"> Log Out</font></a>
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
                              Your inbox is <strong>empty.</strong>
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
                              Your notification is <strong>empty.</strong>
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

              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->
