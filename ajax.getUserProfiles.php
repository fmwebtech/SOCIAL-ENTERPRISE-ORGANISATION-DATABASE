 <?php
 session_start();
 require_once("context.php");
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
	  foreach($usprl->getUserProfiles($userId) as $uspr)
	  {
		 
		  
		   echo '<tr>
					<th scope="row">'.$count.'</th>
					<td>'.(new USER($uspr->userId))->email.'</td>
					<td>'.(new PROFILE($uspr->profileId))->name.'</td>
					<td>'.$uspr->regDate.'</td>
					<td>
					<button onclick="editUserProfile(\''.$uspr->id.'\',\''.$uspr->userId.'\',\''.$uspr->profileId.'\')" class="btn btn-success">
					<i class="las la-edit"></i> Edit </button>
				
					
					<button onclick="deleteUserProfile(\''.$uspr->id.'\')" class="btn btn-danger">
						<i class="las la-trash"></i> Delete  </button>
						
					</td>
				</tr>';
		  $count++;
	  }
  }
  
  ?>