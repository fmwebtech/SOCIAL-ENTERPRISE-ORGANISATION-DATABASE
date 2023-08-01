
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
    <div class="card-content" style="overflow:hidden;">
	
	
	
	
	
	
	
	 <!--content comes here-->
  

<div class="col-lg-12 ">
		<div class="card ">
			<div class="card-body">
				<h5 class="card-title">COUNTRY TABLE <button data-toggle="modal" onclick="openModal()" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add COUNTRY</button></h5>
				<div class="table-responsive">
				<table id="myCountryTable" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">COUNTRY NAME</th>
								<th scope="col">COUNTRY CODE</th>
								<th scope="col">ACTION</th>
							
							</tr>
						</thead>
						<tbody id=countriesTablepool>
							
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
<div class="modal fade text-dark" id="AddSEOModal" role="dialog">
	<div class="modal-dialog">

		
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-dark">Add COUNTRY</h4> <button onclick="$('#AddSEOModal').modal('hide')" type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

      <form id="createForm" class="form-horizontal">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Country Name</b>
					<input required  type="text" name = "name" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter country name" />
				</div>

				<div class="form-group">
					<b class="col-6">Country Code</b>
					<input required type="text" name = "code" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter country code" />
				</div>

				
			</div>
			<div class="modal-footer">

				<button type="submit"  class="btn btn-info">Save</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
      </form>
		</div>

	</div>
</div>
<!-- Modal add branch content ends-->




<!-- Modal edit content start-->

<div class="modal fade text-dark" id="editCountryModal" role="dialog">
	<div class="modal-dialog">

		
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title text-dark">EDIT COUNTRY<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>

      <form id="editCountryForm" class="form-horizontal">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Country Name</b>
					<input required  type="text" name = "name" class="form-control form-control-rounded" value="" id="edit_name" placeholder="Enter country name">
				</div>

				<div class="form-group">
					<b class="col-6">Country Code</b>
					<input required type="text" name = "code" class="form-control form-control-rounded" value="" id="edit_code" placeholder="Enter country code">
          <input  type="hidden" name = "id"  id = "edit_id"/>
        </div>

				



			</div>
			<div class="modal-footer">

				<button type="submit"  class="btn btn-info">Save</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
      </form>
		</div>

	</div>
</div>
<!-- Modal edit content ends-->


<!-- Modal edit content start-->

<div class="modal fade text-dark" id="editCountryModal" role="dialog">
	<div class="modal-dialog">

		
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title text-dark">EDIT COUNTRY<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>

      <form id="editCountryForm" class="form-horizontal">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Country Name</b>
					<input required  type="text" name = "name" class="form-control form-control-rounded" value="" id="edit_name" placeholder="Enter country name">
				</div>

				<div class="form-group">
					<b class="col-6">Country Code</b>
					<input required type="text" name = "code" class="form-control form-control-rounded" value="" id="edit_code" placeholder="Enter country code">
          <input  type="hidden" name = "id"  id = "edit_id"/>
        </div>

				



			</div>
			<div class="modal-footer">

				<button type="submit"  class="btn btn-info">Save</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
      </form>
		</div>

	</div>
</div>
<!-- Modal edit content ends-->

<!-- Modal DELETE content start-->

<div class="modal fade text-dark" id="deleteCountryModal" role="dialog">
	<div class="modal-dialog">

		
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title text-dark">DELETE COUNTRY<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>

      <form id="deleteCountryForm" class="form-horizontal">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Are you sure you want to Delete?</b>
          <input  type="hidden" name = "id"  id = "delete_id"/>
        </div>

				



			</div>
			<div class="modal-footer">

				<button type="submit"  class="btn btn-danger">Yes</button>
				<button type="button" data-dismiss="modal" class="btn btn-info">No</button>
			</div>
      </form>
		</div>

	</div>
</div>
<!-- Modal DELETE content ends-->



<!--JQUERY CODE-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
$(document).ready(function()
{
 // createForm 
    $("#createForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveCountry.php",
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
							openMessageModal('Infomation',r);
							getCountries();
							$("#AddSEOModal").modal("hide");
							 $('#createForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

      //editCountryForm
    $("#editCountryForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editCountry.php",
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
							openMessageModal('Infomation',r);
							getCountries();
							$("#editCountryModal").modal("hide");
							 $('#editCountryForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));




      //deleteCountryForm

      $("#deleteCountryForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteCountry.php",
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
							openMessageModal('Infomation',r);
							getCountries();
							$("#deleteCountryModal").modal("hide");
							 $('#deleteCountryForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
                    getCountries();
});

function getCountries()
 {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
     {

      document.getElementById("countriesTablepool").innerHTML =this.responseText;
	  
					
					
					
					//new DataTable('#myCountryTable');
					
					var table = $('#myCountryTable').DataTable();
 
					new $.fn.dataTable.Buttons( table, {
						buttons: [
							'copy', 'excel', 'pdf'
						]
					} );
					
					table.buttons().container()
					.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
					
					getMenuParentOptions();
				

    }
  };
  xhttp.open("POST", "ajax.getCountry.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("");
}










function editCountry(id)
{

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
     {
      var myObject = JSON.parse(this.responseText);
      document.getElementById('edit_id').value=myObject.id;
      document.getElementById('edit_name').value=myObject.name;
      document.getElementById('edit_code').value=myObject.code;
      //document.getElementById("countriesTablepool").innerHTML =this.responseText;
      $("#editCountryModal").modal("show");
    }
  };
  xhttp.open("POST", "ajax.getCountryObject.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id="+id);



}



function deleteCountry(id)
{
  
  document.getElementById('delete_id').value=id;
  $("#deleteCountryModal").modal("show");
}


function openModal()
{

  $("#AddSEOModal").modal("show");

}











</script>






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
