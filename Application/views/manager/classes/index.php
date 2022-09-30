<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sınıf Listesi</h3>

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
                                <th>Sınıf Adı</th>
                                <th>Sınıf Mevcudu</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $controller = new Controller();
                            foreach ($params['data'] as $key => $value) {
                            $count = $controller->model("manager","infoModels")->getStudentCount($value['id']);
                            ?>
                            <tr>
                                <td><?=$value['name']?></td>
                                <td><?=$count['studentCount']?></td>
                                <td><a href="<?=SITE_URL?>/manager/classes/edit/<?=$value['id']?>"><button type="submit" class="btn btn-block btn-primary">Düzenle</button></a></td>
                                <td><a href="<?=SITE_URL?>/manager/classes/delete/<?=$value['id']?>"><button type="submit" class="btn btn-block btn-danger">Sil</button></a></td>
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