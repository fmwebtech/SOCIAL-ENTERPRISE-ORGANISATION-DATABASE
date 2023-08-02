 <?php
 session_start();
 require_once("classes/class.userprofiles.php");
 require_once("classes/class.profile.php");
 require_once("classes/class.user.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
	  $usprl = new USERPROFILES();
	  $count = 1;
	  foreach($usprl->getUserProfiles() as $usprl)
	  {
		 
		  
		   echo '<tr>
					<th scope="row">'.$count.'</th>
					<td>'.(new USER($usprl->userId))->email.'</td>
					<td>'.(new PROFILE($usprl->profileId))->name.'</td>
					<td>
					<button onclick="editUserProfile(\''.$usprl->id.'\',\''.$usprl->userId.'\',\''.$usprl->profileId.'\')" class="btn-sm btn btn-success">
					<i class="fa fa-edit"></i> Edit </button>
				
					
					<button onclick="deleteUserProfile(\''.$usprl->id.'\')" class="btn-sm btn btn-danger">
						<i class="fa fa-trash"></i> Delete  </button>
						
					</td>
				</tr>';
		  $count++;
	  }
  }
  
  ?>