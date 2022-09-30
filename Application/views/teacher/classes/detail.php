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
                <h3 class="card-title">Sınıf Bilgisi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly name="name" value="<?=$params['className']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Mevcudu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="<?=$params['studentCount']?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci bilgileri</label>
                    <?php 
                    if ($params['studentCount'] != 0) {
                        foreach ($params['studentsName'] as $key => $value) {
                    ?>
                    <input type="text" class="form-control mt-1" id="exampleInputEmail1" name="student_name" value="<?=$value['name']?>" readonly>
                    <?php }} else { ?>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="student_name" value="Herhangi bir öğrenci bilgisi bulunmamaktadır." readonly>
                    <?php } ?>
                  </div>
                </div>
                <!-- /.card-body -->

              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>