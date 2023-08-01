
<?php
	@session_start();
	if(!isset($_SESSION['email']))
	{
		header('location:login.php');
	}
  require_once('classes/class.authorization.php');
	if(!(new AUTHORIZATION($_SESSION['id'],(explode('/',$_SERVER['PHP_SELF'])[sizeof(explode('/',$_SERVER['PHP_SELF']))-1])))->authorize())
	{
		header('location:logout.php');
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
  <title>REPORT || SOCIAL ENTERPRISE ORGANISATION DATABASE</title>
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

  <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
  
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
  

<div class="col-lg-12 ">
		<div class="card ">
			<div class="card-body">
				<h5 class="card-title">SEO BRANCH REPORT <button data-toggle="modal" onclick="openModal()" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">SELECT SEO</button></h5>
				<div class="table-responsive">
				<table id="mySeoBranchTable" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">SEO NAME</th>
								<th scope="col">COUNTRY NAME</th>
								<th scope="col">BRANCH NAME</th>
                <th scope="col">ADDRESS</th>
							
							</tr>
						</thead>
						<tbody id=seosTablepool>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>


<!-- Modal add branch content-->
<div class="modal fade text-dark" id="getSEOModal" role="dialog">
	<div class="modal-dialog">

		
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-dark">SELECT SEO</h4> <button onclick="$('#AddSEOModal').modal('hide')" type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

      <form id="getSEOForm" class="form-horizontal">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">SEO Name</b>
					<select name="id" class="form-control form-control-rounded" id="">
              <?php
                include_once('classes\class.seo.php');
                foreach((new SEO())->getSeo() as $so)
                {
                    echo '<option value="'.$so->id.'">'.$so->name.'</option>';
                }
              ?>
            </select> 


				
			</div>
			<div class="modal-footer">

				<button type="submit"  class="btn btn-info">Submit</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
      </form>
		</div>

	</div>
</div>
<!-- Modal add branch content ends-->







<!--JQUERY CODE-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
$(document).ready(function()
{

  $("#getSEOForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.getSeoBranchReport.php",
					   type: "POST",
					   data:  new FormData(this),
					   contentType: false,
							 cache: false,
					   processData:false,
					   beforeSend : function()
						   {
							// put your check here :)
						   },
					   success: function(r)
						  {
							
                makeTableData('mySeoBranchTable',r);
							$("#getSEOModal").modal("hide");
							 $('#getSEOForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
                      
});





function openModal()
{

  $("#getSEOModal").modal("show");

}

function makeTableData(tt,data)
	 {
	
					tt = '#'+tt;
					if ($.fn.DataTable.isDataTable(tt)) {
					$(tt).DataTable().destroy();
					}
					$(tt+' tbody').empty();
					
					$(tt+' tbody').html(data);
					var table = $(tt).DataTable({
						lengthChange: false,
						buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
						responsive: false,
						language: {
							searchPlaceholder: 'Search...',
							sSearch: '',
							lengthMenu: 'MENU ',
							"bDestroy": true
						}
					});
					table.buttons().container().appendTo( tt+'_wrapper .col-md-6:eq(0)' );		
	
	}




</script>



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

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/DataTables/datatables.min.js"></script>


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
