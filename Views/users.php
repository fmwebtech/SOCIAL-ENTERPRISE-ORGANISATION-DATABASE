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

                <td>
                  <select class="form-control">
                    <option> User</option>
                    <option> Admin</option>
                  </select>
                </td>
                <td>
                  <select class="form-control">
                    <option> Active</option>
                    <option> inactive</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Maguyva</td>
                <td>User</td>

                <td>
                  <select class="form-control">
                    <option> User</option>
                    <option> Admin</option>
                  </select>
                </td>
                <td>
                  <select class="form-control">
                    <option> Active</option>
                    <option> inactive</option>
                  </select>
                </td>

              </tr>



              <tr>
                <th scope="row">3</th> 
                <td>Prince Charlse</td>
                <td>User</td>

                <td>
                  <select class="form-control">
                    <option> User</option>
                    <option> Admin</option>
                  </select>
                </td>
                <td>
                  <select class="form-control">
                    <option> Active</option>
                    <option> inactive</option>
                  </select>
                </td>

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
            <label for="username" class="sr-only">Name</label>
            <div class="position-relative has-icon-right">
              <input type="text" id="username" class="form-control input-shadow" placeholder="Enter username">
              <div class="form-control-position">
                <i class="icon-user"></i>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="fullname" class="sr-only">Name</label>
            <div class="position-relative has-icon-right">
              <input type="text" id="fullname" class="form-control input-shadow" placeholder="Enter full name">
              <div class="form-control-position">
                <i class="icon-user"></i>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="phonenumber" class="sr-only">Name</label>
            <div class="position-relative has-icon-right">
              <input type="text" id="phonenumber" class="form-control input-shadow" placeholder="Enter phone number">
              <div class="form-control-position">
                <i class="icon-user"></i>
              </div>
            </div>
          </div>





          <button type="button" class="btn btn-light btn-block waves-effect waves-light">Add user</button>



        </form>
      </div>
    </div>
  </div>
</div>

</div>