 <?php
 session_start();
 require_once("classes/class.module.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
	  $md = new MODULE();
	  $count = 1;
	  foreach($md->getModules() as $mod)
	  {
		   echo '<tr>
												<th scope="row">'.$count.'</th>
												<td>'.$mod->name.'</td>
												<td>'.$mod->url.'</td>
												<td> <i class="'.$mod->icon.'"></i></td>
												<td>'.$mod->ordering.'</td>
												<td>'.((new MODULE($mod->parentId))-> name).'</td>
												<td>
												<button onclick="editMenu(\''.$mod->id.'\',\''.$mod->name.'\',\''.$mod->url.'\',\''.$mod->icon.'\',\''.$mod->ordering.'\',\''.$mod->parentId.'\')" class="btn btn-sm btn-success">
												<i class="fa fa-edit"></i> Edit </button>
											
												
												<button onclick="deleteMenu(\''.$mod->id.'\')" class="btn btn-sm btn-danger">
													<i class="fa fa-trash"></i> Delete  </button>
													
												</td>
											</tr>';
		  $count++;
	  }
  }
  
  ?>