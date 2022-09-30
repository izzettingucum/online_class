  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Öğrenciler</h1>
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
                <h3 class="card-title">Sınav Listesi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sınav Adı</th>
                    <th>Sınav Sınıfı</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                $controller = new controller();
                if (count($params['examsData'])!=0) {
                foreach ($params['examsData'] as $key => $value) {
                    $class = $controller->model("manager","classesModels")->getData($value['class_id']);
                 ?>
                  <tr>
                    <td><?=$value['name']?></td>
                    <td><?=$class['name']?></td>
                    <td><a href="<?=SITE_URL?>/manager/exams/edit/<?=$value['id']?>"><button class="btn btn-primary" type="submit">Düzenle</button></a></td>
                    <td><a href="<?=SITE_URL?>/manager/exams/delete/<?=$value['id']?>"><button class="btn btn-danger" type="submit">Sil</button></a></td>
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