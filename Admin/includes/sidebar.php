

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" style="background-color:black;" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0"  target="_blank">
        <span class="ms-1 font-weight-bold text-white">
          <?php 
            echo $_SESSION['nom'];
          ?> 
        </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <?php
        if($_SESSION['user_role']=='ResponsableStock'){
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="produit.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Gerer Produit</span>
          </a>
        </li>
        <?php
        }
        ?>
         <?php 
        if ($_SESSION['user_role']=='admin'){
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info " href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Gérer Fournisseur</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo de Stock</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo des employees</span>
          </a>
        </li>
        <?php 
        }
        ?>
        <?php 
        if ($_SESSION['user_role']=='super admin'){
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info " href="admin.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Gérer Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info " href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Gérer Fournisseur</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo de Stock</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respodes employees</span>
          </a>
        </li>
        <?php 
        }
        ?>
        <?php 
        if ($_SESSION['user_role']=='fournisseur'){
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo des employees</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo des employees</span>
          </a>
        </li>
        <?php 
        }
        ?>
        <?php 
        if ($_SESSION['user_role']=='respo employee'){
        ?>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo de Stock</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-info" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="nav-link-text ms-1">Gérer Respo des employees</span>
          </a>
        </li>
        <?php 
        }
        ?>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-info text-white mt-4 w-100" href="../index.php" type="button">log out</a>
      </div>
    </div>
  </aside>
  
