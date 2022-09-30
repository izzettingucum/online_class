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
                <h3 class="card-title">Kurum Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" readonly value="<?=$params['studentData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Kurumu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="email" readonly value="<?=$params['corporationData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Sınıfı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="class" readonly value="<?=$params['classesData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Telefon Numarası</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone" readonly value="<?=$params['studentData']['phone']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci E-mail</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="email" readonly value="<?=$params['studentData']['email']?>">
                  </div>
                </div>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->