
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo 
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="" class="d-block"><h4><?=$_SESSION['student']['name']?></h4></a>
          <a href="" class="d-block"><h5><?=$_SESSION['student']['corporation_name']?></h5></a>
          <a href="" class="d-block"><h5><?=$_SESSION['student']['class_name']?></h5></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
        <li class="nav-item">
            <a href="<?=SITE_URL?>/student" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Ana Sayfa
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=SITE_URL?>/student/detail" class="nav-link">
              <i class="nav-icon fas fa-info"></i>
              <p>
                Bilgilerim
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=SITE_URL?>/student/studies" class="nav-link"> 
              <i class="nav-icon fas fa-book"></i>
              <p>Derslerim</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="<?=SITE_URL?>/student/timetable" class="nav-link"> 
              <i class="nav-icon fas fa-clock"></i>
              <p>Ders Programım</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=SITE_URL?>/student/exam" class="nav-link"> 
              <i class="nav-icon fas fa-calendar"></i>
              <p>Sınav Tarihleri</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=SITE_URL?>/logout" class="nav-link">
              <i class="nav-icon fas fa-times"></i>
              <p>Çıkış Yap</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>