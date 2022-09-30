  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$params['classCount']?></h3>

                <p>Toplam Sınıf Sayısı</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-university"></i>
              </div>
              <a href="<?=SITE_URL?>/teacher/classes" class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$params['studiesCount']?></h3>
                <p>Toplam Ders Sayısı</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-user-secret"></i>
              </div>
              <a href="<?=SITE_URL?>/teacher/studies"class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
