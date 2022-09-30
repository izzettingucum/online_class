<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ders Listesi</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Ders Adı</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($params['data'] as $key => $value) {
                            ?>
                            <tr>
                                <td><?=$value['name']?></td>
                                <td><a href="<?=SITE_URL?>/manager/studies/edit/<?=$value['id']?>"><button type="submit" class="btn btn-block btn-primary">Düzenle</button></a></td>
                                <td><a href="<?=SITE_URL?>/manager/studies/delete/<?=$value['id']?>"><button type="submit" class="btn btn-block btn-danger">Sil</button></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->