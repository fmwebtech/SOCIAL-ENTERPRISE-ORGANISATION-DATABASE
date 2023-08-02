 <?php
 session_start();
 require_once("classes/class.profile.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
	  $pr = new PROFILE();
	  $count = 1;
	  foreach($pr->getProfiles() as $pro)
	  {
		   echo '<tr>
												<th scope="row">'.$count.'</th>
												<td>'.$pro->name.'</td>
												
									
												<td>
												<button onclick="editProfile(\''.$pro->id.'\')" class="btn-sm btn btn-success">
												<i class="fa fa-edit"></i> Edit </button>
											
												
												<button onclick="deleteProfile(\''.$pro->id.'\')" class="btn-sm btn btn-danger">
													<i class="fa fa-trash"></i> Delete  </button>
													
												</td>
											</tr>';
		  $count++;
	  }
  }
  
  ?>