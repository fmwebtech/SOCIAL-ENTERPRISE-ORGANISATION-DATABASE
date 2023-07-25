
<?php
	@session_start();

    require_once('classes\class.country.php');
    $mycountry = new COUNTRY();
	if(!isset($_SESSION['email']))
	{
		header('location:login.php');






	}

            


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>SOCIAL ENTERPRISE ORGANISATION DATABASE</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme11">

  <!-- Start wrapper-->
  <div id="wrapper">

  <!--Statr sidebar-wrapper-->
  <?php
	include('sideBar.php');
  ?>
  <!--End sidebar-wrapper-->

  <!--Start topbar header-->
	<?php include('topBar.php')?>
  <!--End topbar header-->

<div class="clearfix"></div>

<div class="content-wrapper">
  <div class="container-fluid" id="mainContent">

    <div class="card mt-3">
    <div class="card-content">
	
	
	
	
	
	
	
	 <!--content comes here-->
     <div class="row">

<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Country Table</h5>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Country Name</th>
              <th scope="col">Country Code</th> 
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td><?php echo $mycountry->name; ?></td>
              <td>Admin</td> 

              <td>
                <select class="form-control">
                  <option> User</option>
                  <option> Admin</option>
                </select>
              </td>
              <td>
                <select class="form-control">
                  <option> Active</option>
                  <option> inactive</option>
                </select>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Maguyva</td>
              <td>User</td>

              <td>
                <select class="form-control">
                  <option> User</option>
                  <option> Admin</option>
                </select>
              </td>
              <td>
                <select class="form-control">
                  <option> Active</option>
                  <option> inactive</option>
                </select>
              </td>

            </tr>



            <tr>
              <th scope="row">3</th> 
              <td>Prince Charlse</td>
              <td>User</td>

              <td>
                <select class="form-control">
                  <option> User</option>
                  <option> Admin</option>
                </select>
              </td>
              <td>
                <select class="form-control">
                  <option> Active</option>
                  <option> inactive</option>
                </select>
              </td>

            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
     <div >

      <h5 class="card-title">Add user</h5>
      <form>


        <div class="form-group">
          <label for="username" class="sr-only">Name</label>
          <div class="position-relative has-icon-right">
            <input type="text" id="username" class="form-control input-shadow" placeholder="Enter username">
            <div class="form-control-position">
              <i class="icon-user"></i>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="fullname" class="sr-only">Name</label>
          <div class="position-relative has-icon-right">
            <input type="text" id="fullname" class="form-control input-shadow" placeholder="Enter full name">
            <div class="form-control-position">
              <i class="icon-user"></i>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="phonenumber" class="sr-only">Name</label>
          <div class="position-relative has-icon-right">
            <input type="text" id="phonenumber" class="form-control input-shadow" placeholder="Enter phone number">
            <div class="form-control-position">
              <i class="icon-user"></i>
            </div>
          </div>
        </div>





        <button type="button" class="btn btn-light btn-block waves-effect waves-light">Add user</button>



      </form>
    </div>
  </div>
</div>
</div>

</div>

<!--content comes here-->










































	</div>
	</div>
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->

  </div>
  <!-- End container-fluid-->

</div><!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<!--Start footer-->
	<?php include('footer.php')?>
<!--End footer-->

</div><!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<!-- Chart js -->

<script src="assets/plugins/Chart.js/Chart.min.js"></script>

<!-- Index js -->
<script src="assets/js/index.js"></script>

<script type="text/javascript">

  function goTo(url , id)
  {
   $('#'+id).html('<img class="col-12" src="assets/images/loading.gif" />');
   $.ajax({ url: url,
    data: { },

    type: 'post',
    success: function(output) {

      $('#'+id).html(output);
    }
  });
 }
</script>

</body>
</html>
