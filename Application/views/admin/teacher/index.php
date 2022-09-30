  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Öğretmenler</h1>
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
                <h3 class="card-title">Öğretmen Listesi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Ad-Soyad</th>
                    <th>Telefon</th>
                    <th>Kurum Adı</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                if (count($params['data'])!=0) {
                foreach ($params['data'] as $key => $value) {
                    $controller = new controller();
                    $corporation = $controller->model("admin","corporationModels")->getData($value['corporation_id']);
                 ?>
                  <tr>
                    <td><?=$value['name']?></td>
                    <td><?=$value['phone']?></td>
                    <td><?=$corporation['name']?></td>
                    <td><a href="<?=SITE_URL?>/admin/teacher/edit/<?=$value['id']?>"><button class="btn btn-primary" type="submit">Düzenle</button></a></td>
                    <td><a href="<?=SITE_URL?>/admin/teacher/edit/<?=$value['id']?>"><button class="btn btn-danger" type="submit">Sil</button></a></td>
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