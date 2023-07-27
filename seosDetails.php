
<?php
	@session_start();
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
	
	
	
	
	
	
	
	 <!--content SEO DETAILS START      -->

   <button onclick="goTo('Views/SEO_table.php' , 'mainContent')" type="button" class="btn btn-light btn-round px-5">
  <!-- <i class="icon-lock"></i>  -->
Go back</button>

<div class="row mt-3">
  <div class="col-lg-6">
   <div class="card">
     <div class="card-body">
       <div class="card-title">Bana Peter's Chickens</div>
       <hr>
       <form>

         <div class="row">
          <label class="col-6">Established</label>
          <label class="col-6"></label>
        </div>
        <hr>
        <div class="row" onclick="goTo('Views/seo_branches.php' , 'seo_specific_details_box')">
          <label class="col-6">Branches</label>
          <label class="col-6"><i class="pull-right fa fa-arrow-right"></i> </label>
        </div>
        <hr>

        <div class="row" onclick="goTo('Views/seo_products.php' , 'seo_specific_details_box')">
          <label class="col-6">Products</label>
          <label class="col-6"> <i class="pull-right fa fa-arrow-right"></i></label>
        </div>
        <hr>

        <div class="row" onclick="goTo('Views/seo_services.php' , 'seo_specific_details_box')">
          <label class="col-6">Services</label>
          <label class="col-6"><i class="pull-right fa fa-arrow-right"></i></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Income per annum </label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Expenditure per annum</label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Founded in</label>
          <label class="col-6"></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Founding Country</label>
          <label class="col-6"></label>
        </div>
        <hr>

        <div class="row">
          <label class="col-6">Primary Country</label>
          <label class="col-6"></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">HQ In</label>
          
        </div>

        <hr>


           <!-- <div class="form-group">
            <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
          </div> -->
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card">
     <div class="card-body" id="seo_specific_details_box">

     </div>
   </div>
 </div>
</div>


 <!--content SEO DETAILS END    -->



























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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="assets/plugins/Chart.js/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
