  <?php
  @session_start();
  require_once('classes/class.user.php');
  $myUserObject = new USER($_SESSION['id']);
  
  ?>
  
  <header class="topbar-nav">
   <nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
         <i class="icon-menu menu-icon"></i>
       </a>
     </li>
     <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
        <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>

  <ul class="navbar-nav align-items-center right-nav-link">
    
       
        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
            <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
           <li class="dropdown-item user-details">
            <a href="javaScript:void();">
             <div class="media">
               <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
               <div class="media-body">
                <h6 class="mt-2 user-title"><?php echo $myUserObject->firstName.' '.$myUserObject->lastName; ?></h6>
                <p class="user-subtitle"><?php echo $myUserObject->email; ?></p>
              </div>
            </div>
          </a>
        </li>
     
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> <a href="logout.php"> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>