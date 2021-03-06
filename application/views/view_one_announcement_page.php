<?php 
foreach($announcement as $a)
{
  $title = $a->a_title;
  $content = $a->a_content;
  $timestamp = $a->a_timeposted;
}
?>
  	<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">

		                        <h1 class="page-header">Announcements</h1>                               

                                        <div class="panel panel-yellow">
                                              <div class="panel-heading">
                                                 <?php echo $title; ?>
                                             </div>
                                     <div class="panel-body">
                                         <?php echo $content; ?>
                                    </div>
                                 <div class="panel-footer">
                                  <?php echo $timestamp; ?>
                                </div>
                                    </div>
                                    <button onclick="goBack()" class="btn btn-warning btn-sm" style="">Go Back</button>
		                </div>
		                <!-- /.row -->
		            </div>
		            <!-- /.container-fluid -->
		        </div>
		        <!-- /#page-wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>

</body>

</html>
