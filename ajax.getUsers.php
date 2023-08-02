 <?php
 session_start();
 require_once("classes/class.user.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'Request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
	  $usr = new USER();
	  $count = 1;
	  foreach($usr->getUsers() as $us)
	  {
		   echo 	'<tr>
						<th scope="row">'.$count.'</th>
						<td>'.$us->firstName.'</td>
						<td>'.$us->lastName.'</td>
						<td>'.$us->email.'</td>
						<td>
						<button onclick="editUser(\''.$us->id.'\',\''.$us->firstName.'\',\''.$us->lastName.'\',\''.$us->email.'\')" class="btn-sm btn btn-success">
						<i class="fa fa-edit"></i> Edit </button>
					
						<button onclick="deleteUser(\''.$us->id.'\')" class="btn-sm btn btn-danger">
							<i class="fa fa-trash-alt "></i> Delete  </button>
							
						</td>
					</tr>';
		  $count++;
	  }
  }
  
  ?>