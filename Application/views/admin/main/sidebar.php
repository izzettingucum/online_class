

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
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
               <li class="nav-item">
            <a href="<?=SITE_URL?>/admin" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Ana Sayfa
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Kurum İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/corporation" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kurum Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/corporation/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Kurum Ekle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-window-restore"></i>
              <p>
                Sınıf İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/classes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sınıf Listesi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Ders İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/studies" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ders Listesi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Yönetici İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/manager" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yönetici Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/manager/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Yönetici Ekle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Öğretmen İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/teacher" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Öğretmen Listesi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-male"></i>
              <p>
                Öğrenci İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/admin/student" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Öğrenci Listesi</p>
                </a>
              </li>
            </ul>
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