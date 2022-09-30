  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dersler</h1>
          </div>
        </div>
        <?php 
      if (isset($_SESSION['stats'])) {
        echo helper::flashDataView("stats");
      } ?>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ders Listesi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Ad-Soyad</th>
                    <th>Kurum Adı</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                if (count($params['data'])!=0) {
                    $controller = new controller();
                foreach ($params['data'] as $key => $value) {
                    $corporation = $controller->model("admin","corporationModels")->getData($value['corporation_id']);
                 ?>
                  <tr>
                    <td><?=$value['name']?></td>
                    <td><?=$corporation['name']?></td>
                    <td><a href="<?=SITE_URL?>/admin/studies/edit/<?=$value['id']?>"><button class="btn btn-primary" type="submit">Düzenle</button></a></td>
                    <td><a href="<?=SITE_URL?>/admin/studies/delete/<?=$value['id']?>"><button class="btn btn-danger" type="submit">Sil</button></a></td>
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