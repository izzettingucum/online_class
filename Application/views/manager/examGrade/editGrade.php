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
                <h3 class="card-title">Sınav Notu Bilgisi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/Exam_Grade/update/<?=$params['gradeData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly name="studentName" value="<?=$params['studentData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınav Adı</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" readonly name="examName" value="<?=$params['examData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğrenci Notu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="grade" value="<?=$params['gradeData']['grade']?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="gradeUpdate">Ekle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->