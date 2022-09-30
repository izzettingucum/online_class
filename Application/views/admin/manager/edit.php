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
              <form action="<?=SITE_URL?>/admin/manager/update/<?=$params['managerData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yönetici Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?=$params['managerData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yönetici E-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?=$params['managerData']['email']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yönetici Şifre</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yönetici Telefon Numarası</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone"value="<?=$params['managerData']['phone']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yönetici Kurumu</label>
                    <select name="corporation_id" id="" class="form-control">
                        <?php foreach ($params['corporationData'] as $key => $value) { ?>
                            <option <?=($value['id']==$params['managerData']['corporation_id']) ? 'selected' : '' ?> value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="managerUpdate">Ekle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->