 <?php
 session_start();
 require_once("context.php");
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
												<td>'.$pro->status.'</td>
												<td>'.$pro->regDate.'</td>
												<td>
												<button onclick="editProfile(\''.$pro->id.'\',\''.$pro->name.'\')" class="btn btn-success">
												<i class="las la-edit"></i> Edit </button>
											
												
												<button onclick="deleteProfile(\''.$pro->id.'\')" class="btn btn-danger">
													<i class="las la-trash"></i> Delete  </button>
													
												</td>
											</tr>';
		  $count++;
	  }
  }
  
  ?>