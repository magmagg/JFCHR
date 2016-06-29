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

    <!-- Bootstrap  Core CSS -->
    <link href="<?php echo base_url();?>bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <link href="<?php echo base_url();?>css/select2.min.css" rel="stylesheet" />

    <link href="<?php echo base_url();?>css/bootstrap-select.css" rel="stylesheet" />

    <?php
        if($SBU == "JB")
        {
        ?>
            <link href="<?php echo base_url();?>css/custom.css" rel="stylesheet" />
        <?php
        }
        else
        {
        ?>
            <link href="<?php echo base_url();?>css/custom1.css" rel="stylesheet" />
        <?php
        }
    ?>

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="">

    <div id='cssmenu'>
<ul>
   <li class="active"><a href='<?php echo base_url()?>'><span>HR-MDP</span></a></li>
   <li><a href='<?php echo base_url();?>user/announcements'><span>Announcements</span></a></li>
   <li class='has-sub'><a href='#'><span>Policies</span></a>
      <ul>
            <?php
                foreach($policycateg as $pc)
                {?>
         <li class='has-sub'><a href='#'><span><?php echo $pc->policy_category; ?></span></a>
            <ul>
                <?php
                    $id = $pc->policy_category_id;

                    foreach($policies as $p)
                    {
                        if($p->policy_category_fk == $id)
                        {
                ?>
               <li><a href="<?php echo base_url();?>user/view_policy/<?php echo $p->policy_id ?>"><span><?php echo $p->policy_header;?></span></a></li>
                <?php
                        }
                    }
                ?>
            </ul>
            <?php
                }
            ?>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Forms</span></a>
        <ul>
           <li><a href='<?php echo base_url();?>user/view_forms'><span>Available Forms</span></a></li>
           <li class='last'><a href="<?php echo base_url();?>user/view_archives"><span>Archived Forms</span></a></li>
        </ul>
    </li>
   <li class='has-sub'><a href='#'><span>Benefits</span></a>
        <ul>
           <li><a href="<?php echo base_url();?>user/view_benefits_enrollment"><span>Benefits Enrolment</span></a></li>
        </ul>
    </li>
    <li class='has-sub'><a href='#'><span>Quitclaim</span></a>
        <ul>
           <li><a href='<?php echo base_url();?>user/view_quitclaim'><span>Activate Quitclaim</span></a></li>
           <li class='last'><a href="<?php echo base_url();?>user/view1_quitclaim_to_be_approved"><span>Accountabilities</span></a></li>
        </ul>
    </li>
   <li><a href='<?php echo base_url();?>User/view_values'><span>Values</span></a></li>
   <li class=''><a href='<?php echo base_url();?>User/view_hotlines'><span>Hotlines</span></a></li>
   <li class='has-sub'><a href='#'><span>DCS</span></a>
        <ul>
           <li><a href="<?php echo base_url();?>user/view1_dcs_progress"><span>Submitted Documents</span></a></li>
           <li><a href="<?php echo base_url();?>user/view2_dcs_requests"><span>Documents to Approve</span></a></li>
           <li><a href="<?php echo base_url();?>user/DCS"><span>New DCS</span></a></li>
           <li><a href="<?php echo base_url();?>user/DCS/view_documents"><span>Approved Documents</span></a></li>
        </ul>
    </li>
</ul>
<ul>
  <li class='has-sub'><a href='#'><span><i class="fa fa-envelope fa-fw"></i></span></a>
        <ul>
          <?php
            if(!empty($messages))
            {
              foreach($messages as $m)
              {
                echo '<li>';
                echo '<a href="#">';
                echo '<div>';
                echo '<strong>' . $m->message_sender_name . '</strong>';
                echo '<span class="pull-right text-muted">';
                echo '<em>' . $m->message_timestamp . '</em>';
                echo '</span>';
                echo '</div>';
                echo '<div>' . $m->message_content . '</div>';
                echo '</a>';
                echo '</li>';
                echo '<li class="divider"></li>'; 
              }
            }
            else if(empty($messages))
            {
              echo '<div class="alert alert-danger text-center">No messages.</div>';
            }
          ?>
          <li>
            <a class="text-center" href="<?php echo base_url();?>user/view_messages">
              <strong>Read All Messages</strong>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
    </li>
    <li class='has-sub'><a href='#'><span><i class="fa fa-bell fa-fw"></i></span></a>
        <ul>
          <li>
            <a href="#">
              <div>
                <i class="fa fa-comment fa-fw"></i> New Comment
               <span class="pull-right text-muted small">4 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                <span class="pull-right text-muted small">12 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="fa fa-envelope fa-fw"></i> Message Sent
                <span class="pull-right text-muted small">4 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="fa fa-tasks fa-fw"></i> New Task
                <span class="pull-right text-muted small">4 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                <span class="pull-right text-muted small">4 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a class="text-center" href="#">
              <strong>See All Alerts</strong>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
    </li>
    <li class='has-sub'><a href='#'><span><i class="fa fa-user fa-fw"></i></span></a>
        <ul>
            <li><a href="<?php echo base_url();?>User/dashboard"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
    </li>
</ul>
</div>