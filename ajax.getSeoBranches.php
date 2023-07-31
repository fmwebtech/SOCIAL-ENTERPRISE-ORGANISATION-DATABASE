
<div class="card-title">Branches
 <button onclick="addBranch(<?php echo $_POST['id']?>)"  type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">
      Add  Branch</button>
</div>

<div >
<table class="col-lg-12">
  <tr> <td></td> <td></td> </tr>
</tbody>
<?php 
require_once('classes\class.country.php');
require_once('classes\class.seoCountry.php');
require_once('classes\class.branch.php');



if($_SERVER['REQUEST_METHOD']=='POST')
{

  extract($_POST);
  foreach((new SEOCOUNTRY())->getSeoCountryBySeoId($id) As $sc)
  {
      $myCountry = new COUNTRY($sc->countryId); 

      echo '
      <tr><td colspan="2"><hr></td></tr>
      
      <tr> <td>'.strtoupper($myCountry->name).' </td>
      <td>
      </td>
     </tr>
   
     ';
      $count = 1;
      foreach((new BRANCH())->getBranch($id,$myCountry->id) as $br)
      {
          echo '
          
          <tr> <td style="padding-left:20px">'.$count.'. '.$br->name.'</td> <td>'.$br->address.'
          <i  onclick="deleteBranch('.$br->id.')" title="delete" style = "margin-left:10px" type="button" class="pull-right fa fa-trash"></i>
          <i  onclick="deleteBranch('.$br->id.')" title="edit" type="button" class="pull-right fa fa-edit"></i>

          </td> </tr>
          
          ';
          $count++;
      }
     

  }


}
else
{

}



?>


</tbody>
</table>
</div>



<!-- edit branch Modal -->
<div class="modal fade text-dark" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Branch</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Branch name</b>
          <input type="text" class="form-control form-control-rounded" value="Lusaka branch" id="input-6" placeholder="Enter brance name">
        </div>

        <div class="form-group">
          <b class="col-6">Address</b>
          <input type="text" class="form-control form-control-rounded" value="Presidential Avnue drive" id="input-6" placeholder="Enter brance name">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>


</div>
</div>



