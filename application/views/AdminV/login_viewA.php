<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HR Manual Document Process</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>production/css/custom.css" rel="stylesheet">
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            <?php echo form_open(base_url().'loginA/doLogin') ?>
              <h1>Admin Login</h1>
              <div>
                <input name="username" type="text" class="form-control" placeholder="Username" required=""  autofocus/>
                <span class="text-danger"><?php echo form_error('username'); ?></span>
              </div>
              <div>
                <input name="password" type="password" class="form-control" placeholder="Password" required="" />
                <span class="text-danger"><?php echo form_error('password'); ?></span>
              </div>
              <div>
                <input style="margin-left: 40%;" class="btn btn-default" type="submit" name="btn_login" value="Login">
              </div>
              <div class="clearfix"></div>
              <div class="separator">

                <p class="change_link">Not an admin?
                  <a href="<?php echo base_url(); ?>login" class="to_register"> Go to Employee Login </a>
                </p>
                <div class="clearfix"></div>
                <div>
                    <?php
                        echo $this->session->flashdata('msg'); 
                    ?>

                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
                        <?php echo form_close(); ?>
          </section>
        </div>

        <div id="register" class=" form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">

                <p class="change_link">Already a member ?
                  <a href="#tologin" class="to_register"> Log in </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                  <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>