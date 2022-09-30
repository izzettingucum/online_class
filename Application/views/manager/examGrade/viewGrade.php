  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sınav Notları</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Not Listesi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Öğrenci Adı</th>
                    <th>Sınav Adı</th>
                    <th>Sınav Notu</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                $controller = new controller();
                if (count($params['gradeData'])!=0) {
                foreach ($params['gradeData'] as $key => $value) {
                    $student = $controller->model("manager","studentModels")->getData($value['student_id']);
                    $exam = $controller->model("manager","examsModels")->getExamData($value['exam_id'],$_SESSION['manager']['corporation_id']);
                 ?>
                  <tr>
                    <td><?=$student['name']?></td>
                    <td><?=$exam['name']?></td>
                    <td><?=$value['grade']?></td>
                    <td><a href="<?=SITE_URL?>/manager/Exam_Grade/editGrade/<?=$value['id']?>"><button class="btn btn-primary" type="submit">Düzenle</button></a></td>
                    <td><a href="<?=SITE_URL?>/manager/Exam_Grade/delete/<?=$value['id']?>/<?=$value['class_id']?>/<?=$value['exam_id']?>"><button class="btn btn-danger" type="submit">Sil</button></a></td>
                  </tr>
                <?php }} ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->