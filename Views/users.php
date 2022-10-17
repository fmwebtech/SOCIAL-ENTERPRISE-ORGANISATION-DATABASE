<div class="row">

  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Hover Table</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">User Type</th> 
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>James Bond</td>
                <td>Admin</td> 
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Maguyva</td>
                <td>User</td>
              </tr>
              <tr>
                <th scope="row">3</th> 
                <td>Prince Charlse</td>
                <td>User</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
       <div >

        <h5 class="card-title">Add user</h5>
        <form>
          <div class="form-group">
            <label for="exampleInputName" class="sr-only">Name</label>
            <div class="position-relative has-icon-right">
              <input type="text" id="exampleInputName" class="form-control input-shadow" placeholder="Enter Your Name">
              <div class="form-control-position">
                <i class="icon-user"></i>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="exampleInputEmailId" class="sr-only">Email ID</label>
            <div class="position-relative has-icon-right">
              
              <select class="form-control input-shadow">
                <option>User</option>
                <option>Admin</option>
              </select>
              <div class="form-control-position">
                <i class="zmdi zmdi-accounts-list-alt"></i>
              </div>
            </div>
          </div>

          <div class="form-group">
           <label for="exampleInputPassword" class="sr-only">Password</label>
           <div class="position-relative has-icon-right">
            <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Choose Password">
            <div class="form-control-position">
              <i class="icon-lock"></i>
            </div>
          </div> 
        </div>

         <div class="form-group">
           <label for="exampleInputPassword" class="sr-only">Password</label>
           <div class="position-relative has-icon-right">
            <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Confirm Password">
            <div class="form-control-position">
              <i class="icon-lock"></i>
            </div>
          </div> 
        </div>

       

       <button type="button" class="btn btn-light btn-block waves-effect waves-light">Create</button>
       
      

  </form>
</div>
</div>
</div>
</div>

</div>