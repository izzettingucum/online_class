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
                <h3 class="card-title">Öğretmen Sınıf Bilgisi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
              <?php
              $controller = new controller();
              $class_id = explode(",",$params['class_id']);
              foreach ($class_id as $key => $value) {
              $classData = $controller->model("teacher","classesModels")->getClassData($value);
              ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly name="name" value="<?=$classData['name']?>">
                    <a href="<?=SITE_URL?>/teacher/classes/classDetail/<?=$classData['id']?>"><button class="btn btn-info" style="float:right;" type="button">Görüntüle</button></a>
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