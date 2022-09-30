<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php if (isset($_SESSION['stats'])) {
                echo helper::flashDataView("stats");
            } ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Sınıf Detayı</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"  readonly value="<?=$params['classData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Kurumu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly value="<?=$params['corporationData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Mevcudu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="class" readonly value="<?=$params['countStudent']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Öğretmenleri</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="class" readonly value="burası doldurulacak">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Dersleri</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="class" readonly value="burası doldurulacak">
                  </div>
                </div>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->