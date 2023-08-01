
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
	
	
	
	
	
	
	
	 <!--content seos table starts       -->
   <div class="row">

<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">SEO list <button data-toggle="modal" onclick="openModal()" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add SEO</button></h5>
      <div class="table-responsive">
      <table id="mySeosTable" class="table table-hover">
          <thead>
            <tr>
            <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Established</th>
              <th scope="col">Branches</th>
              <th scope="col">Income per annum</th>
              <th scope="col">Expenditure per annum</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id=seoTablepool>
            
            
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>





<!-- add Seo Modal -->
<div class="modal fade text-dark" id="addSeoModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">

      <h4 class="modal-title text-dark">Add SEO</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
     <form id="addSeoForm"> 
      <div class="modal-body">

  
      <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
              <b class="col-6">SEO name</b>
              <input type="" name = "name" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Established year">
              
            
            </div>

            <div class="form-group">
              <b class="col-6">Established</b>
              <input type="number" name = "established" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Established year">
            </div>

            <div class="form-group">
              <b class="col-6">Ownership</b>
              <input type="number" name = "ownership" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Ownership">
            </div>

            <div class="form-group">
              <b class="col-6">Governance</b>
              <input type="number" name = "governance" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter governance">
            </div>


            <div class="form-group">
        <b class="col-6">Primary Country</b>
        <select name ="primaryCountry" class="form-control form-control-rounded" >
          <?php
            include_once('classes/class.country.php');
            foreach((new COUNTRY())->getCountry() as $cou)
            {
                echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
            }
          ?>
        </select>
      </div>

        </div>


        <div class="col-lg-6">

     


      <div class="form-group">
        <b class="col-6">Country Founded</b>
        <select name="countryFounded" class="form-control form-control-rounded" >
          <?php
            include_once('classes/class.country.php');
            foreach((new COUNTRY())->getCountry() as $cou)
            {
                echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
            }
          ?>
        </select>
      </div>


      <div class="form-group">
        <b class="col-6">HQ country</b>
        <select name="hqCountry" class="form-control form-control-rounded" >
          <?php
            include_once('classes/class.country.php');
            foreach((new COUNTRY())->getCountry() as $cou)
            {
                echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
            }
          ?>
        </select>
      </div>



      <div class="form-group">
        <b class="col-6">Income per annum</b>
        <input type="number" name = "incomePerAnnum" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Income per annum">
      </div>


      <div class="form-group">
        <b class="col-6">Expenditure per annum</b>
        <input type="number" name= "expenditurePerAnnum" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Income per annum">
      </div>


      
      </div>


    </div>
    </div>
    <div class="modal-footer">

      <button type="submit"   class="btn btn-info">Save</button>
      <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
    </div>
    </form>
  </div>

</div>
</div>
<!---MOodal ends here-->


<!-- My Moodal -->
<div class="modal fade text-dark" id="editSeoModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 class="modal-title text-dark">EDIT COMPANY</h4><button onclick="$('#editSeo').modal('hide')" type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
      <form id="editSeoForm">
			<div class="modal-body">


				<div class="form-group">
					
          <b class="col-6">Company name</b>
            <input required type="text" name="name" class="form-control form-control-rounded" value="" id="edit_name" placeholder="Enter Currency Name">
            
            <b class="col-6">Established</b>
            <input required type="number" name="established" class="form-control form-control-rounded" value="" id="edit_established" placeholder="Enter Established">
          
            <b class="col-6">Ownership</b>
            <input required type="number" name="ownership" class="form-control form-control-rounded" value="" id="edit_ownership" placeholder="Enter Ownership">
            
            <b class="col-6">Primary Country</b>
            <select name="primaryCountry" class="form-control form-control-rounded" value="" id="edit_primaryCountry">
              <?php
                include_once('classes/class.country.php');
                foreach((new COUNTRY())->getCountry() as $cou)
                {
                    echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
                }
              ?>
            </select> 

            <b class="col-6">Governance</b>
            <input required type="number" name="governance" class="form-control form-control-rounded" value="" id="edit_governance" placeholder="Enter Governance">
            
            <b class="col-6">HQ Country</b>
            
            <select name="hqCountry" class="form-control form-control-rounded" id="edit_hqCountry">
            <?php
                include_once('classes/class.country.php');
                foreach((new COUNTRY())->getCountry() as $cou)
                {
                    echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
                }
            ?>
            </select>

            <b class="col-6">Country Founded</b>            
            <select name="countryFounded" class="form-control form-control-rounded" value="" id="edit_countryFounded">
            <?php
                include_once('classes/class.country.php');
                foreach((new COUNTRY())->getCountry() as $cou)
                {
                    echo '<option value="'.$cou->id.'">'.$cou->name.'</option>';
                }
            ?>
            </select>

            <b class="col-6">Income per Annum</b>
            <input required type="number" name="incomePerAnnum" class="form-control form-control-rounded" value="" id="incomePerAnnum" placeholder="incomePerAnnum">
           
            <b class="col-6">Expenditure per Annum</b>
            <input required type="number" name="expenditurePerAnnum" class="form-control form-control-rounded" value="" id="expenditurePerAnnum" placeholder="expenditurePerAnnum">

            <input required type="hidden" name="id" id='edit_id'/>


          </div>


			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-info">Edit</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
		</div>

</form>
	</div>
</div>
<!---MOodal ends here-->



<!-- My For deleting Company Moodal -->
<div class="modal fade text-dark" id="deleteCompany" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 class="modal-title text-dark">DELETE COMPANY<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>
      <form id="deleteSeoForm">
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">Are you sure you want to delete ?</b>
          <input required type="hidden" name="id" id='delete_id'/>


        </div>


			</div>
      <div class="modal-footer">

<button type="submit" class="btn btn-danger">Yes</button>
<button type="button" data-dismiss="modal" class="btn btn-dark">No</button>
</div>

</form>
	</div>
</div>
<!---MOodal ends here-->





<!--JQUERY CODE STARTS       --> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function()
{
 
 // addSeoForm 
    $("#addSeoForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveSeo.php",
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
							getSeo();
							$("#addSeoModal").modal("hide");
							 $('#addSeoForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
     
    //   //editCompanyForm
    $("#editSeoForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editSeo.php",
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
							getSeo();
							$("#editSeoModal").modal("hide");
							 $('#editSeoForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));




      //deleteCompanyForm

      $("#deleteSeoForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteSeo.php",
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
							getSeo();
							$("#deleteCompany").modal("hide");
							 $('#deleteSeoForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
                    getSeo();
});





function getSeo()
 {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
      {
          
        document.getElementById("seoTablepool").innerHTML =this.responseText;

            //new DataTable('#mySeosTable');
            
            var table = $('#mySeosTable').DataTable();
  
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
  xhttp.open("POST", "ajax.getSeo.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("");
}




function editSeo(id)
{

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
     {
      var myObject = JSON.parse(this.responseText);
      document.getElementById('edit_id').value=myObject.id;
      document.getElementById('edit_name').value=myObject.name;
      document.getElementById('edit_established').value=myObject.established;
      document.getElementById('edit_ownership').value=myObject.ownership;
      document.getElementById('edit_governance').value=myObject.governance;

      //document.getElementById("countriesTablepool").innerHTML =this.responseText;


      var ele = document.getElementById("edit_countryFounded");
      for(var i=0;i< ele.options.length;i++)
					{
						if(ele.options[i].value == myObject.countryFounded)
						{ ele.options[i].selected = true;}
            else { ele.options[i].selected = false;} 
					}

          var ele = document.getElementById("edit_primaryCountry");
      for(var i=0;i< ele.options.length;i++)
					{
						if(ele.options[i].value == myObject.primaryCountry)
						{ ele.options[i].selected = true;}
            else { ele.options[i].selected = false;} 
					}

          var ele = document.getElementById("edit_hqCountry");
      for(var i=0;i< ele.options.length;i++)
					{
						if(ele.options[i].value == myObject.hqCountry)
						{ ele.options[i].selected = true;}
            else { ele.options[i].selected = false;} 
					}
          




      $("#editSeoModal").modal("show");
    }
  };
  xhttp.open("POST", "ajax.getSeoObject.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id="+id);



}



function deleteSeo(id)
{
  
  document.getElementById('delete_id').value=id;
  $("#deleteCompany").modal("show");
}


function openModal()
{

  $("#addSeoModal").modal("show");

}
function goToSeo(id)
{
window.location.assign("seosDetails.php?id="+id);
}


</script>
<!--JQUERY CODE ENDS       -->














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
