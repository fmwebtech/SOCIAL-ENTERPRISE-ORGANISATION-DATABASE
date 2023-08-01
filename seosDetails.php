
<?php
	@session_start();
  require_once('classes\class.seo.php');
  require_once('classes\class.Product.php');
  require_once('classes\class.Service.php');
  require_once('classes\class.branch.php');
  require_once('classes\class.country.php');
  require_once('classes/class.authorization.php');
  
	if(!isset($_SESSION['email']))
	{
		header('location:login.php');
	}
  
	if(!(new AUTHORIZATION($_SESSION['id'],(explode('/',$_SERVER['PHP_SELF'])[sizeof(explode('/',$_SERVER['PHP_SELF']))-1])))->authorize())
	{
		header('location:logout.php');
	}






    if(isset($_GET['id']))
    {
      extract($_GET);
      $myseosDetails = new SEO($id);
      



      $pros = sizeof((new PRODUCTS())->getProducts($myseosDetails->id));
      $services = sizeof((new SERVICES())->getServices($myseosDetails->id));
      $brans = sizeof((new BRANCH())->getBranchBySeo($myseosDetails->id));
     
      // var_dump($myseosDetails);
    }
    else
    {
        header('location:seos.php');
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



<div class="row mt-3">
  <div class="col-lg-6">
   <div class="card">
     <div class="card-body">
       <div class="card-title" onclick="goToSeos()"> <i class="fa fa-arrow-left"></i><?php echo "            "; echo $myseosDetails->name;  ?> </div>
       <hr>
       <form>

         <div class="row">
          <label class="col-6">Established</label>
          <label class="col-6"><?php echo $myseosDetails->established;  ?></label>
        </div>
        <hr>
        <div class="row" onclick="getSeoBranches(<?php echo $myseosDetails->id?>)">
          <label class="col-6">Branches</label>
          <label class="col-6"><i class="pull-right fa fa-arrow-right"></i><?php echo $brans ?></label>
        </div>
        <hr>

        <div class="row" onclick="getProducts(<?php echo $myseosDetails->id?>)">
          <label class="col-6">Products</label>
          <label class="col-6"> <i class="pull-right fa fa-arrow-right"></i><?php echo $pros ?></label>
        </div>

        <hr>
        <div class="row" onclick="getServices(<?php echo $myseosDetails->id?>)">
          <label class="col-6">Services</label>
          <label class="col-6"><i class="pull-right fa fa-arrow-right"></i><?php echo $services ?></label>
        </div>

        <hr>
        <div class="row">
          <label class="col-6">Income per annum </label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="<?php echo $myseosDetails->incomePerAnnum;  ?>">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Expenditure per annum</label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="<?php echo $myseosDetails->expenditurePerAnnum;  ?>">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Ownership</label>
          <label class="col-6"><?php echo $myseosDetails->ownership; ?></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Governance</label>
          <label class="col-6"><?php echo $myseosDetails->governance; ?></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Founding Country</label>
          <label class="col-6"><?php echo (new COUNTRY($myseosDetails->countryFounded))->name;  ?></label>
        </div>
        <hr>

        <div class="row">
          <label class="col-6">Primary Country</label>
          <label class="col-6"><?php echo (new COUNTRY($myseosDetails->primaryCountry))->name;  ?></label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">HQ In</label>
          <label class="col-6"><?php  echo (new COUNTRY($myseosDetails->hqCountry))->name;?></label>
          
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





<!-- add branch Modal -->
<div class="modal fade text-dark" id="addCountryModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Country</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id='addseoCountryForm'>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Select Country</b>
          <input id='seoId' type="hidden" name='seoId' />
          <select name='countryId' class="form-control form-control-rounded"> 

               <?php
               require_once('classes/class.country.php');
               foreach((new COUNTRY())->getCountry() as $c)
               {
                  echo '<option value="'.$c->id.'">'.$c->name.'</option>';
               }
               ?>        
                      
                        
          </select>
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
<script>
  function addCountry(seoId)
  {
    //addCountryModal
    document.getElementById('seoId').value =seoId;
    $('#addCountryModal').modal('show');
  }
</script>






<!-- add branch Modal -->
<div class="modal fade text-dark" id="addBranchModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Branch</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id='addBranchForm'>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Branch name</b>
          <input type="text" required class="form-control form-control-rounded" name="name" placeholder="Enter branch name">
        </div>

        <div class="form-group">
          <b class="col-6">Address</b>
          <input type="text" required class="form-control form-control-rounded"  name="address" placeholder="Enter branch address">
          <input type='hidden' name='seoId' id='branch_seoId'>
        </div>

        <div class="form-group">
          <b class="col-6">Select Country</b>
          <select name='countryId' class="form-control form-control-rounded"> 

               <?php
               require_once('classes/class.country.php');
               foreach((new COUNTRY())->getCountry() as $c)
               {
                  echo '<option value="'.$c->id.'">'.$c->name.'</option>';
               }
               ?>        
                      
                        
          </select>
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-info"><i class="fa fa-save"></i> Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i> Close</button>
      </div>
  </form>
    </div>

  </div>
</div>

<script>
  function addBranch(seoId)
  {
       document.getElementById('branch_seoId').value =seoId;
    $('#addBranchModal').modal('show');
  }
</script>



<!-- EDIT branch Modal -->
<div class="modal fade text-dark" id="editBranchModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Branch</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id='editBranchForm'>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Branch name</b>
          <input type="text" required class="form-control form-control-rounded" name="name" id= "editbranch_name" placeholder="Enter branch name">
        </div>

        <div class="form-group">
          <b class="col-6">Address</b>
          <input type="text" required class="form-control form-control-rounded"  name="address" id="editbranch_address" placeholder="Enter branch address">
          <input type='hidden' name='seoId' id='editbranch_seoId'>
          <input type='hidden' name='id' id='editbranch_id'>
        </div>

        <div class="form-group">
          <b class="col-6">Select Country</b>
          <select name='countryId' class="form-control form-control-rounded" id="editbranch_country"> 

               <?php
               require_once('classes/class.country.php');
               foreach((new COUNTRY())->getCountry() as $c)
               {
                  echo '<option value="'.$c->id.'">'.$c->name.'</option>';
               }
               ?>        
                      
                        
          </select>
          
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-info"><i class="fa fa-save"></i> Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i> Close</button>
      </div>
  </form>
    </div>

  </div>
</div>

<!-- My Moodal -->
<div class="modal fade text-dark" id="deleteBranchModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            

            <h4 class="modal-title text-dark">Delete Branch <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
          </div>
          <form id="deleteBranchForm">
          <div class="modal-body">


            <div class="form-group">
              <b class="col-6">Are you sure you want to delete ?</b>
              <input required type="hidden" name="id" id='deletebranch_id'/>
            </div>


          </div>
          <div class="modal-footer">

          <button type="submit"  class="btn btn-info"> <i class="fa fa-dangaer"></i>Yes</button>
            <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i>No</button>
          </div>

    </form>
      </div>
    </div>
   </div>

<script>
   function deleteBranch(id, seoId)
{
  document.getElementById('deletebranch_id').value=id;
  $("#deleteBranchModal").modal("show");
}
</script>




<!-- add branch Modal -->
<div class="modal fade text-dark" id="AddProductModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Product</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="addProductForm">
      <div class="modal-body">

       
        <div class="form-group">
          <b class="col-6">Product name</b>
          <input required type="text" name="name" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <b class="col-6">Currency name</b>
          <select name="currency" class="form-control form-control-rounded" value="" id="save_currency">
              <?php
                include_once('classes\class.currency.php');
                foreach((new CURRENCY())->getCurrency() as $cu)
                {
                    echo '<option value="'.$cu->id.'">'.$cu->name.'  ('.$cu->code.')</option>';
                }
              ?>
            </select> 
        </div>

        <div class="form-group">
          <b class="col-6">Product Price</b>
          <input required type="number" name="price" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter product price">
          <input type='hidden' name='seoId' id='product_seoId'>
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

<script>
  function addProduct(seoId)
  {
   
    document.getElementById('product_seoId').value =seoId;
    $('#AddProductModal').modal('show');
  }
</script>


<!-- add branch Modal -->
<div class="modal fade text-dark" id="editServiceModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Service</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="editServiceForm">
      <div class="modal-body">

       
        <div class="form-group">
          <b class="col-6">Service name</b>
          <input required type="text" name="name" class="form-control form-control-rounded" value="" id="editService_name" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <b class="col-6">Currency name</b>
          <select name="currency" class="form-control form-control-rounded" value="" id="editService_currency">
              <?php
                include_once('classes\class.currency.php');
                foreach((new CURRENCY())->getCurrency() as $cu)
                {
                    echo '<option value="'.$cu->id.'">'.$cu->name.'  ('.$cu->code.')</option>';
                }
              ?>
            </select> 
        </div>

        <div class="form-group">
          <b class="col-6">Service Price</b>
          <input required type="number" name="price" class="form-control form-control-rounded" value="" id="editService_price" placeholder="Enter Service price">
          <input type='hidden' name='seoId' id='editService_seoId'>
          <input type='hidden' name='id' id='editService_id'>
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

<!--jq starts here-->

<script>
  function deleteService(seoId)
  {
   
    document.getElementById('service_seoId').value =seoId;
    $('#deleteServiceModal').modal('show');
  }
</script>






<!-- add branch Modal -->
<div class="modal fade text-dark" id="AddServiceModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Service</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="addServiceForm">
      <div class="modal-body">

       
        <div class="form-group">
          <b class="col-6">Service name</b>
          <input required type="text" name="name" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <b class="col-6">Currency name</b>
          <select name="currency" class="form-control form-control-rounded" value="" id="save_currency">
              <?php
                include_once('classes\class.currency.php');
                foreach((new CURRENCY())->getCurrency() as $cu)
                {
                    echo '<option value="'.$cu->id.'">'.$cu->name.'  ('.$cu->code.')</option>';
                }
              ?>
            </select> 
        </div>

        <div class="form-group">
          <b class="col-6">Service Price</b>
          <input required type="number" name="price" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Service price">
          <input type='hidden' name='seoId' id='service_seoId'>
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

<!--jq starts here-->

<script>
  function addService(seoId)
  {
   
    document.getElementById('service_seoId').value =seoId;
    $('#AddServiceModal').modal('show');
  }
</script>

<!--jq starts here-->





<!-- add branch Modal -->
<div class="modal fade text-dark" id="editProductModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Product</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="editProductForm">
      <div class="modal-body">

       
        <div class="form-group">
          <b class="col-6">Product name</b>
          <input required type="text" name="name" class="form-control form-control-rounded" value="" id="edit_name" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <b class="col-6">Currency name</b>
          <select name="currency" class="form-control form-control-rounded" id="edit_currency">
              <?php
                include_once('classes\class.currency.php');
                foreach((new CURRENCY())->getCurrency() as $cu)
                {
                    echo '<option value="'.$cu->id.'">'.$cu->name.'</option>';
                }
              ?>
            </select> 
        </div>

        <div class="form-group">
          <b class="col-6">Product Price</b>
          <input required type="number" name="price" class="form-control form-control-rounded" value="" id="edit_price" placeholder="Enter product price">
          <input type='hidden' name='id' id='product_Id'>
          <input type='hidden' name='seoId' id='product_seoId'>
        </div>
                   

      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-info"> <i class="fa fa-save"></i> Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i> Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<!---MOodal ends here-->



<!-- add product Modal -->



<!-- My Moodal -->
    <div class="modal fade text-dark" id="deleteProductModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            

            <h4 class="modal-title text-dark">Delete Product<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
          </div>
          <form id="deleteProductForm">
          <div class="modal-body">


            <div class="form-group">
              <b class="col-6">Are you sure you want to delete ?</b>
              <input required type="hidden" name="id" id='deleteProduct_id'/>
            </div>


          </div>
          <div class="modal-footer">

          <button type="submit"  class="btn btn-info"> <i class="fa fa-dangaer"></i>Yes</button>
            <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i>No</button>
          </div>

    </form>
      </div>
    </div>
   </div>

    
<!-- My Moodal -->
<div class="modal fade text-dark" id="deleteServiceModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            

            <h4 class="modal-title text-dark">Delete Service<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
          </div>
          <form id="deleteServiceForm">
          <div class="modal-body">


            <div class="form-group">
              <b class="col-6">Are you sure you want to delete ?</b>
              <input required type="hidden" name="id" id='deleteService_id'/>
            </div>


          </div>
          <div class="modal-footer">

          <button type="submit"  class="btn btn-info"> <i class="fa fa-dangaer"></i>Yes</button>
            <button type="button" data-dismiss="modal" class="btn btn-dark"> <i class="fa fa-times"></i>No</button>
          </div>

    </form>
      </div>
    </div>
    </div>



    <script>
  function editBranch(id,name,address,country,seoId)
  {
   //
    document.getElementById('editbranch_id').value =id;
    document.getElementById('editbranch_name').value =name;
    document.getElementById('editbranch_address').value =address;
    document.getElementById('editbranch_country').value =country;
    document.getElementById('editbranch_seoId').value =seoId;
    $('#editBranchModal').modal('show');
  }
</script>

<script>
  function editProduct(id,name,currency,price,seoId)
  {
   //
    document.getElementById('product_Id').value =id;
    document.getElementById('edit_name').value =name;
    document.getElementById('edit_currency').value =currency;
    document.getElementById('edit_price').value =price;
    document.getElementById('product_seoId').value =seoId;
    $('#editProductModal').modal('show');
  }
</script>

<!--JQUERY FOR SERVICES STARTS HERE--> 
<script>
  function editService(id,name,currency,price,seoId)
    {
      document.getElementById('editService_id').value =id;
      document.getElementById('editService_seoId').value =seoId;
      document.getElementById('editService_name').value =name;
      document.getElementById('editService_currency').value =currency;
      document.getElementById('editService_price').value =price;
      $('#editServiceModal').modal('show');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function()
{
 // createForm 
    $("#addseoCountryForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveSeoCountry.php",
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
							getSeoBranches(document.getElementById('seoId').value);
							$("#addCountryModal").modal("hide");
							 $('#addseoCountryForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
		  }));


    $("#addBranchForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveBranch.php",
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
							getSeoBranches(document.getElementById('branch_seoId').value);
							$("#addBranchModal").modal("hide");
							 $('#addBranchForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));


    $("#editBranchForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editBranch.php",
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
							getSeoBranches(document.getElementById('editbranch_seoId').value);
							$("#editBranchModal").modal("hide");
							 $('#editBranchForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));


       $("#deleteBranchForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteBranch.php",
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
							 getSeoBranches();
							$("#deleteBranchModal").modal("hide");
							 $('#deleteBranchForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));







       $("#editBranchForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editBranch.php",
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
							getSeoBranches(document.getElementById('editbranch_seoId').value);
							$("#editBranchModal").modal("hide");
							 $('#editBranchForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

//delete form starts here 
     
$("#deleteProductForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteProduct.php",
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
							 getProducts();
							$("#deleteProductModal").modal("hide");
							 $('#deleteProductForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
     //ends here

     $("#deleteServiceForm").on('submit',(function(e) {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.deleteService.php",
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
							 getServices();
							$("#deleteServiceModal").modal("hide");
							 $('#deleteServiceForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));
     //ends here


    
    //addProductForm
    $("#addProductForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveProduct.php",
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
							getProducts(document.getElementById('product_seoId').value);
							$("#AddProductModal").modal("hide");
							 $('#addProductForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));


      //add form for services starts here

      $("#addServiceForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveService.php",
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
							getServices();
							$("#AddServiceModal").modal("hide");
							 $('addServiceForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

//form for editing services;

$("#editServiceForm").on('submit',(function(e)
      {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editService.php",
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
							getServices();
							$("#editServiceModal").modal("hide");
							 $('#editServiceForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

    // form ends here 





      $("#editProductForm").on('submit',(function(e)
      {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.editProduct.php",
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
							getProducts();
							$("#editProductModal").modal("hide");
							 $('#editProductForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

      getProducts();
});


function goToSeos()
{
  window.location.href = 'seos.php';
}

function getSeoBranches(id)
{
  var id= <?php echo $myseosDetails->id;?>;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
    {

      document.getElementById("seo_specific_details_box").innerHTML =this.responseText;

    }
  };
  xhttp.open("POST", "ajax.getSeoBranches.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id="+id);
}


function getProducts(id)
{
  var id= <?php echo $myseosDetails->id;?>;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
     {

      document.getElementById("seo_specific_details_box").innerHTML =this.responseText;

    }
  };
  xhttp.open("POST", "ajax.getProduct.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("seoId="+id);
}

function getServices(id)
{
  var id= <?php echo $myseosDetails->id;?>;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
    {

      document.getElementById("seo_specific_details_box").innerHTML =this.responseText;

    }
  };
  xhttp.open("POST", "ajax.getService.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("seoId="+id);
 }
// for ends here 







function deleteProduct(id, seoId)
{
  document.getElementById('deletebranch_id').value=id;
  $("#deleteProductModal").modal("show");
}


        
function deleteService(id, seoId)
{
  document.getElementById('deleteService_id').value=id;
  $("#deleteServiceModal").modal("show");
}


function openModal()
{

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
