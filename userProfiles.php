
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
  <title>User Profiles || SOCIAL ENTERPRISE ORGANISATION DATABASE</title>
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
      <h5 class="card-title">User Profiles <button onclick="openModal()" data-target="#AddUserProfile" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add User Profile</button></h5>
      <div class="table-responsive">
        <table class="table table-hover" id="myUserProfileTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">USER</th>
              <th scope="col">PROFILE</th>
              <th scope="col">Action</th>

            </tr>
          </thead>
          <tbody id="userProfiles">
          
            
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- add profile Modal -->
<div class="modal fade text-dark" id="AddUserProfile" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->

 
      <div class="modal-content">
      <div class="modal-header">

      <h4 class="modal-title text-dark">Add User Profile</h4><button type="button" onclick="hideModal('AddUserProfile')" class="close" data-dismiss="modal">&times;</button>
      </div> 
      <form id="createForm" class ="form-horizontal" >
      <div class="modal-body">

      
      <div class="form-group">
        <b class="col-6">USER</b>
        <select name ="userId" class="form-control form-control-rounded" >
          <?php
            include_once('classes\class.user.php');
            foreach((new USER())->getUsers() as $usprl)
            {
                echo '<option value="'.$usprl->id.'">'.$usprl->email.'</option>';
            }
          ?>
        </select>
      </div>

      <div class="form-group">
        <b class="col-6">PROFILE</b>
        <select name ="profileId" class="form-control form-control-rounded" >
          <?php
            include_once('classes\class.profile.php');
            foreach((new PROFILE())->getProfiles() as $pr)
            {
                echo '<option value="'.$pr->id.'">'.$pr->name.'</option>';
            }
          ?>
        </select>
      </div>



    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-info">Save</button>
      <button type="button" data-dismiss="modal" class="btn btn-dark" onclick="hideModal('AddUserProfile')">Close</button>

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

      <h4 class="modal-title text-dark">Edit user Profile</h4><button onclick="hideModal('editModal')" type="button" class="close" data-dismiss="modal">&times;</button>
      </div> 
      <form id="editprofileForm" class ="form-horizontal" >
      <div class="modal-body">

      
       <div class="form-group">
        <b class="col-6">USER</b>
        <select name ="userId" id="edit_userId"  class="form-control form-control-rounded" >
          <?php
            include_once('classes\class.user.php');
            foreach((new USER())->getUsers() as $usprl)
            {
                echo '<option value="'.$usprl->id.'">'.$usprl->email.'</option>';
            }
          ?>
        </select>
		<input type="hidden" name="id" id="edit_id">
      </div>

      <div class="form-group">
        <b class="col-6">PROFILE</b>
        <select name="profileId" id="edit_profileId" class="form-control form-control-rounded" >
          <?php
            include_once('classes\class.profile.php');
            foreach((new PROFILE())->getProfiles() as $pr)
            {
                echo '<option value="'.$pr->id.'">'.$pr->name.'</option>';
            }
          ?>
        </select>
      </div>
  

    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-info"> <i class="fa fa-save"></i> Save</button>
      <button type="button" onclick='hideModal("editModal")' class="btn btn-dark">  <i class="fa fa-times"></i> Close</button>
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

      <h4 class="modal-title text-dark">delete User Profile</h4><button type="button" onclick="hideModal('deleteModal')">&times;</button>
      </div> 
      <form id="deleteProfileForm" class ="form-horizontal" >
      <div class="modal-body">
        
      <div class="form-group">
        <b class="col-6">Are you sure you Want to Delete </b>
        <input required type="hidden" name="id" id= 'delete_id' >
      </div>
		  
		</div>
		<div class="modal-footer">

		  <button type="submit"   class="btn btn-danger"> <i class="fa fa-check"></i> Yes</button>
		  <button type="button" data-dismiss="modal" onclick="hideModal('deleteModal')" class="btn btn-info"><i class="fa fa-times" ></i>No</button>
	  </form>
    
    </div>
  </div>

</div>
</div>

<!-- Modal ends here  -->

</div>






<!-- My code  -->

















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


$(document).ready( function (){
		//create form
    //editprofileForm
  
      

    $("#createForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveUserProfile.php",
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
							  getUserProfiles();
							 $("#AddUserProfile").modal("hide");
							 $('#createForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			}));
           
 

      $("#editprofileForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveUserProfile.php",
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
							  getUserProfiles();
							 $("#editModal").modal("hide");
							 $('#editProfileForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			}));

    


      $("#deleteProfileForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteUserProfile.php",
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
							 getUserProfiles();
							 $("#deleteModal").modal("hide");
							 $('#deleteProfileForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			}));






  getUserProfiles(); 
    
	});


function getUserProfiles()
	 {
		 
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function()
		  {
			if (this.readyState == 4 && this.status == 200)
				{
					
					//document.getElementById('userProfiles').innerHTML = this.responseText;
          makeTableData('myUserProfileTable',this.responseText);
					



				}
		  };
		  xhttp.open("POST", "ajax.getUserProfiles.php", true);
		  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  xhttp.send();
	 }

  function editUserProfile(id,userId,profileId)
  {
    
	document.getElementById('edit_id').value= id;
    document.getElementById('edit_userId').value=userId;
    document.getElementById('edit_profileId').value=profileId;
	$('#editModal').modal('show');

  }
  function deleteUserProfile(id)
  {
    document.getElementById('delete_id').value = id;
    $("#deleteModal").modal("show");
  }

  function openModal()
  {
    $("#AddUserProfile").modal("show");
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