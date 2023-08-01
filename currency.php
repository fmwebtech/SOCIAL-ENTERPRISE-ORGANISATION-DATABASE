
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
    <div class="card-content">
	
<div class="row">

  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">CURRENCY MANAGEMENT <button data-toggle="modal" onclick="openModal()" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add CURRENCY</button></h5>
        <div class="table-responsive">
		<table id="myCurrencyTable" class="table table-hover">

            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Currency Name</th>
				<th scope="col">Currency Code</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody id=CurrencyTablepool>
              
            </tbody>


          </table>
        </div>
      </div>
    </div>
  </div>
</div>
 <!--content comes here-->
 
  
<!-- add branch Modal -->
<div class="modal fade text-dark" id="AddSEOModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 class="modal-title text-dark">ADD CURRENCY</h4><button onclick="hideModal('AddSEOModal')" type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form id="newCurrency">
			    <div class="modal-body">


				  <div class="form-group">
					<b class="col-6">Currency Name</b>
					<input required type="text" name="name" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Currency Name">
				  </div>

				  <div class="form-group">
					<b class="col-6">Currency Code</b>
					<input required type="text" name="code" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Currency Name">
				  </div>
          </div>
			    <div class="modal-footer">

				  <button type="submit" class="btn btn-info">Add</button>
				  <button type="button" data-dismiss="modal" class="btn btn-dark" onclick="hideModal('AddSEOModal')">Close</button>
			    </div>
          </form>
		      </div>
	</div>
</div>

		<!-- Modal ends here-->





    
     


		
<!-- My Moodal -->
<div class="modal fade text-dark" id="editCurrency" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 class="modal-title text-dark">EDIT CURRENCY</h4><button onclick="hideModal('editCurrency')" type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
      <form id="editCurrencyForm">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Currency Name</b>
					<input required type="text" name="name" class="form-control form-control-rounded" value="" id="edit_name" placeholder="Enter Currency Name">
          


        </div>

		<div class="form-group">
					<b class="col-6">Currency Code</b>
					<input required type="text" name="code" class="form-control form-control-rounded" value="" id="edit_code" placeholder="Enter Currency Name">
          <input required type="hidden" name="id" id='edit_id'/>


        </div>


			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-info">Edit</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark" onclick="hideModal('editCurrency')">Close</button>
			</div>
		</div>

</form>
	</div>
</div>
<!---MOodal ends here-->


<!-- My Moodal -->
<div class="modal fade text-dark" id="deleteCurrency" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 class="modal-title text-dark">DELETE CURRENCY<button  onclick="hideModal('deleteCurrency')" type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>
      <form id="deleteCurrencyForm">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Are you sure you want to delete ?</b>
          <input required type="hidden" name="id" id='delete_id'/>


        </div>


			</div>
      <div class="modal-footer">

<button type="submit" class="btn btn-danger">Delete</button>
<button type="button" data-dismiss="modal" class="btn btn-info" onclick="hideModal('deleteCurrency')">Close</button>
</div>

</form>
	</div>
</div>
<!---MOodal ends here-->



	</div>
	</div>
    <!--tart overlay-->
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
<script src="assets/plugins/DataTables/datatables.min.js"></script>


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

<script>
$(document).ready( function ()
{
  //createForm
  //editCurrencyForm

  
  $("#newCurrency").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveCurrency.php",
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
							 getCurrency();
							$("#AddSEOModal").modal("hide");
							 $('#newCurrency').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

       $("#editCurrencyForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editCurrency.php",
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
							 getCurrency();
							$("#editCurrency").modal("hide");
							 $('#editCurrencyForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

       $("#deleteCurrencyForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteCurrency.php",
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
							 getCurrency();
							$("#deleteCurrency").modal("hide");
							 $('#deleteCurrencyForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));


  getCurrency();
		// code goes here ;
	});

	function getCurrency()
	 {
		 
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function()
		  {
			if (this.readyState == 4 && this.status == 200)
				{
					
					document.getElementById('CurrencyTablepool').innerHTML = this.responseText;	{
					
					//new DataTable('#myCurrencyTable');
					
 
					makeTableData('myCurrencyTable',this.responseText);
				}
					
				}
		  };
		  xhttp.open("POST", "ajax.getCurrency.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  xhttp.send();
	 }

   function editCurrency(id)
   {
//editCurrency is my id


  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function()
		  {
			if (this.readyState == 4 && this.status == 200)
				{
          var myObject=JSON.parse(this.responseText);
          document.getElementById('edit_id').value=myObject.id;
          document.getElementById('edit_name').value=myObject.name;
		  document.getElementById('edit_code').value=myObject.code;
					// document.getElementById('CurrencyTablepool').innerHTML = this.responseText;
          $("#editCurrency").modal("show");
				}
		  };
		  xhttp.open("POST", "ajax.getCurrencyObject.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  xhttp.send("id="+id);

    }
  function deleteCurrency(id)
    {
      document.getElementById('delete_id').value=id;
      $("#deleteCurrency").modal("show");
    }
function openModal()
{
  $("#AddSEOModal").modal("show");

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
