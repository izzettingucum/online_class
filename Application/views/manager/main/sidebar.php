
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
          <a href="" class="d-block"><h5><?=$_SESSION['manager']['name']?></h5></a>
          <a href="" class="d-block"><h6><?=$_SESSION['manager']['corporationName']?></h6></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
               <li class="nav-item">
            <a href="<?=SITE_URL?>/manager" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Ana Sayfa
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Sınıf İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/classes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sınıf Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/classes/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Sınıf Ekle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Ders İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/studies" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ders Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/studies/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Ders Ekle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Sınav İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/exams" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sınav Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/exams/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Sınav Ekle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/Exam_Grade" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sınav Notu Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/Exam_Grade/addGrade" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Sınav Notu Ekle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Ders Programı <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/timetable" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ders Programı Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/timetable/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Ders Programı Ekle</p>
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
                <a href="<?=SITE_URL?>/manager/teacher" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Öğretmen Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/teacher/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Öğretmen Ekle</p>
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
                <a href="<?=SITE_URL?>/manager/student" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Öğrenci Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=SITE_URL?>/manager/student/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Öğrenci Ekle</p>
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