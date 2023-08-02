 <?php
 session_start();
 require_once("classes/class.profilemodules.php");
 require_once("classes/class.profile.php");
 require_once("classes/class.module.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
	  $prmd = new PROFILEMODULES();
	  $count = 1;
	  foreach($prmd->getProfileModules() as $pm)
	  {
		  
		  
		   echo '<tr>
					<th scope="row">'.$count.'</th>
					<td>'.(new PROFILE($pm->profileId))->name.'</td>
					<td>'.(new MODULE($pm->moduleId))->name.'</td>
					
					<td>
					<button onclick="editProfileModule(\''.$pm->id.'\',\''.$pm->profileId.'\',\''.$pm->moduleId.'\')" class=" btn-sm btn btn-success">
					<i class="fa fa-edit"></i> Edit </button>
				
					
					<button onclick="deleteProfileModule(\''.$pm->id.'\')" class=" btn-sm btn btn-danger">
						<i class="fa fa-trash"></i> Delete  </button>
						
					</td>
				</tr>';
		  $count++;
	  }
  }
  
  ?>