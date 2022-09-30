<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<?php if (isset($_SESSION['stats'])) {
echo helper::flashDataView("stats");
} ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Ders Güncelleme</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=SITE_URL?>/manager/studies/update/<?=$params['data']['id']?>" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Ders Adı :</label>
                  <input type="text" class="form-control" name="name" value="<?=$params['data']['name']?>">
                </div>       
              </div>
              <div class="box-footer">
                <button type="submit" name="studiesUpdate" class="btn btn-primary">Güncelle</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>
</div>
</section>
</div>
