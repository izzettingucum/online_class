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
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/admin/studies/update/<?=$params['studiesData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ders Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?=$params['studiesData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dersin Kurumu</label>
                    <select name="corporation_id" id="" class="form-control">
                        <?php foreach ($params['corporationData'] as $key => $value) { ?>
                            <option <?=($value['id']==$params['studiesData']['corporation_id']) ? 'selected' : '' ?> value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="studiesUpdate">Ekle</button>
                </div>
              </form>
            </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->