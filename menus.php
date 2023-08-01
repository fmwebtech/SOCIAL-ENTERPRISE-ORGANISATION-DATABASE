
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
  <title> MENUS || SOCIAL ENTERPRISE ORGANISATION DATABASE</title>
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
	
	
	
	
    <div class="row">

		<div class="col-lg-12">
		  <div class="card">
			<div class="card-body">
			  <h5 class="card-title">Menus <button onclick="openModal()" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add Menu</button></h5>
			  <div class="table-responsive">
				<table class="table table-hover">
				  <thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">NAME</th>
					  <th scope="col">URL</th>
					  <th scope="col">ICON</th>
					  <th scope="col">ORDERING</th>
					  <th scope="col">PARENT MENU</th>
					  <th scope="col">ACTION</th>

					</tr>
				  </thead>
				  <tbody id="MenusPool">
				  
					
				   
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
		</div>
		</div>

<!-- add profile Modal -->
<div class="modal fade text-dark" id="addMenuModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">

      <h4 class="modal-title text-dark">Add Menu</h4><button type="button" onclick="hideModal('addMenuModal')" class="close" >&times;</button>
      </div> 
      <form id="createForm" class ="form-horizontal" >
      <div class="modal-body">

      <div class="form-group">
        <b class="col-6">Name</b>
        <input type="text" required name="name" id='name' class="form-control form-control-rounded" placeholder="Enter Name">
      </div>

      <div class="form-group">
        <b class="col-6">URL</b>
         <input type="text" required name="url" id='url' class="form-control form-control-rounded" placeholder="Enter url" />
      </div>

	<div class="form-group">
        <b class="col-6">ICON</b>
         <input type="text" required name="icon" id='icon' class="form-control form-control-rounded" placeholder="e.g fa fa-save" />
      </div>
	  
	  <div class="form-group">
        <b class="col-6">PARENT MENU</b>
		 <select name="parentId" id='parentOptions1' class="form-control form-control-rounded">
		
		 </select>
		 
      </div>
	  
	  <div class="form-group">
        <b class="col-6">ORDER</b>
         <input type="number" required name="ordering" id='order' class="form-control form-control-rounded" placeholder="Enter order of appearance">
      </div>
	  

    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-info"> <i class="fa fa-save"></i> Save</button>
      <button type="button" onclick="hideModal('addMenuModal')" data-dismiss="modal" class="btn btn-dark">  <i class="fa fa-times"></i> Close</button>

    </div>
    </form>
  </div>

</div>
</div>
<!-- Modal ends here -->


<!-- add editModal new model -->
<!-- add profile Modal -->
<div class="modal fade text-dark" id="editModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">

      <h4 class="modal-title text-dark">Edit user</h4><button onclick="himeModal('editModal')" type="button" class="close" data-dismiss="modal">x</button>
      </div> 
      <form id="editForm" class ="form-horizontal" >
      <div class="modal-body">

     
	  <div class="form-group">
        <b class="col-6">Name</b>
        <input type="text" required name="name" id='edit_name' class="form-control form-control-rounded" placeholder="Enter Name">
		<input name="id" type="hidden" id="edit_id">
      </div>

      <div class="form-group">
        <b class="col-6">URL</b>
         <input type="text" required name="url" id='edit_url' class="form-control form-control-rounded" placeholder="Enter url" />
      </div>

	<div class="form-group">
        <b class="col-6">ICON</b>
         <input type="text" required name="icon" id='edit_icon' class="form-control form-control-rounded" placeholder="e.g fa fa-save" />
      </div>
	  
	  <div class="form-group">
        <b class="col-6">PARENT MENU</b>
		 <select name="parentId" id='parentOptions2' class="form-control form-control-rounded">
		
		 </select>
		 
      </div>
	  
	  <div class="form-group">
        <b class="col-6">ORDER</b>
         <input type="number" required name="ordering" id='edit_ordering' class="form-control form-control-rounded" placeholder="Enter order of appearance">
      </div>



    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-info"> <i class="fa fa-save"></i> Save</button>
      <button type="button" onclick="hideModal('editModal')" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i> Close</button>
  </form>
    
    </div>
  </div>

</div>
</div>
<!-- Modal ends here  -->



<!-- add deleteModal new model -->
<!-- add profile Modal -->
<div class="modal fade text-dark" id="deleteModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">

      <h4 class="modal-title text-dark">User Profile</h4><button onclick="hideModal('deleteModal')" type="button" class="close" data-dismiss="modal">&times;</button>
      </div> 
      <form id="deleteForm" class ="form-horizontal" >
      <div class="modal-body">

      
      <div class="form-group">
        <b class="col-6">Are you sure you want to delete this user? </b>
        <input required type="hidden" name="id" id= 'delete_id' >

      </div>
    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-danger"><i class="fa fa-check"></i> Yes</button>
      <button type="button" onclick="hideModal('deleteModal')" data-dismiss="modal" class="btn btn-info"> <i class="fa fa-times"></i> No</button>
  </form>
    
    </div>
  </div>

</div>
</div>

<!-- Modal ends here  -->

</div>




</html>

<!-- End of my code  -->


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



</body>
</html>



 
<script>


$(document).ready( function (){
		

    $("#createForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveMenu.php",
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
							  getMenus();
							 $("#addMenuModal").modal("hide");
							 $('#createForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			}));
           
 
      $("#editForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveMenu.php",
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
							  getMenus();
							 $("#editModal").modal("hide");
							 $('#editForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			}));




      $("#deleteForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteMenu.php",
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
							  getMenus();
							 $("#deleteModal").modal("hide");
							 $('#deleteForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
		}));

  getMenus(); 
    
	});


	function getMenus()
	 {
		 
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function()
		  {
			if (this.readyState == 4 && this.status == 200)
				{
					
					document.getElementById('MenusPool').innerHTML = this.responseText;
					getMenuParentOptions();
				}
		  };
		  xhttp.open("POST", "ajax.getMenus.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  xhttp.send();
	}

  function editMenu(id,name,url,icon,ordering,parentId)
  {

	document.getElementById('edit_id').value = id;
	document.getElementById('edit_name').value = name;
	document.getElementById('edit_url').value = url;
	document.getElementById('edit_icon').value = icon;
	document.getElementById('edit_ordering').value = ordering;
	 for(var i=0;i< document.getElementById("parentOptions2").options.length;i++)
		{
			//alert(document.getElementById("parentOptions2").options[i].value);
			if(document.getElementById("parentOptions2").options[i].value == parentId)
			{
				document.getElementById("parentOptions2").options[i].selected = true;
			}else
			{
				document.getElementById("parentOptions2").options[i].selected = false;
			}
		}
					
	
	$("#editModal").modal("show");
  }
  
  function deleteMenu(id)
  {
    document.getElementById('delete_id').value = id;
    $("#deleteModal").modal("show");
  }

  function openModal()
  {
    $("#addMenuModal").modal("show");
  }
  
  function closeModal()
  {
    $("#addMenuModal").modal("hide");
  }


function getMenuParentOptions()
	 {
		 
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function()
		  {
			if (this.readyState == 4 && this.status == 200)
				{
					document.getElementById("parentOptions1").innerHTML = this.responseText;
					document.getElementById("parentOptions2").innerHTML = this.responseText;
				}
		  };
		  xhttp.open("POST", "ajax.getMenuParentOptions.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  xhttp.send("");
		 
	 }
	 
</script>