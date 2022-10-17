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
          <label class="col-6">1522</label>
        </div>
        <hr>
        <div class="row" onclick="goTo('Views/seo_branches.php' , 'seo_specific_details_box')">
          <label class="col-6">Branches</label>
          <label class="col-6">23</label>
        </div>
        <hr>

        <div class="row" onclick="goTo('Views/seo_products.php' , 'seo_specific_details_box')">
          <label class="col-6">Products</label>
          <label class="col-6">2</label>
        </div>
        <hr>

        <div class="row" onclick="goTo('Views/seo_services.php' , 'seo_specific_details_box')">
          <label class="col-6">Services</label>
          <label class="col-6">-</label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Income per annum (ZMK)</label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="90,000">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Expenditure per annum (ZMK)</label>
          <div class="col-6">
            <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter service address" value="42,000">

          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Founded in</label>
          <label class="col-6">1956</label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">Founding Country</label>
          <label class="col-6">Mali</label>
        </div>
        <hr>

        <div class="row">
          <label class="col-6">Primary Country</label>
          <label class="col-6">Eygpt</label>
        </div>
        <hr>
        <div class="row">
          <label class="col-6">HQ In</label>
          <select class=" col-6 form-control form-control-rounded">
            <option>Zambia</option>
            <option>Mali</option>
            <option>South Africa</option>
            <option>Ghana</option>
            <option>Spain</option>
          </select>
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