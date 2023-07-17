<div class="card-title">Products 
	<button data-toggle="modal" data-target="#AddProductModal" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add Product</button> 
</div>
<hr>

<div data-toggle="modal" data-target="#editProductModal">
	

<div class="row">
            <label class="col-6">Dressed chikens</label>
            <label class="col-6">ZMK 90</label>
           </div>
           <hr>

           <div class="row">
            <label class="col-6">Live chikens</label>
            <label class="col-6">ZMK 80</label>
           </div>
           <hr>
           <div class="row">
            <label class="col-6">Chikens feet</label>
            <label class="col-6">ZMK 40</label>
           </div>
           <hr>



</div>



<!-- add product Modal -->
<div class="modal fade text-dark" id="editProductModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Product</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Product</b>
          <input type="text" class="form-control form-control-rounded" value="Dressed Chickens" readonly id="input-6" placeholder="Enter branch name">
        </div>

        <div class="form-group">
          <b class="col-6">Price</b>
          <input type="text" class="form-control form-control-rounded" value="K90" id="input-6" placeholder="Enter brance address">
        </div>


      </div>
      <div class="modal-footer">

        <button type="button"  class="btn btn-info" onclick="confirm('Remove product?');">Remove Product</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
      </div>
    </div>

  </div>
</div>

</div>





<!-- add branch Modal -->
<div class="modal fade text-dark" id="AddProductModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Product</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Product name</b>
          <input type="text" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter product name">
        </div>

        <div class="form-group">
          <b class="col-6">Product Price</b>
          <input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter product price">
        </div>


      </div>
      <div class="modal-footer">

        <button type="button"  class="btn btn-info">Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
      </div>
    </div>

  </div>
</div>

</div>



