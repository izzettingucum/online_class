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
                <h3 class="card-title">Öğrenci Ders Bilgisi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/student/detail/updatePassword" method="post">
                <div class="card-body">
              <?php
              $controller = new controller();
              $studies_id = explode(",",$params['studies_id']);
              foreach ($studies_id as $key => $value) {
              $studiesName = $controller->model("student","studiesModels")->getStudiesName($value);
              ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ders Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly name="name" value="<?=$studiesName['name']?>">
                  </div>
              <?php } ?>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->