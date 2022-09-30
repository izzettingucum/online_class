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
                <h3 class="card-title">Öğretmen Düzenle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/teacher/update/<?=$params['teacherData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğretmen Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?=$params['teacherData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğretmen E-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?=$params['teacherData']['email']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğretmen Şifre</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Öğretmen Telefon Numarası</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone"value="<?=$params['teacherData']['phone']?>">
                  </div>
                  <div class="form-group">
                    <label style="display:block;">Öğretmenin Dersleri</label>
                    <?php 
                    $controller = new controller();
                    $studies_id = explode(",",$params['teacherData']['studies_id']);
                    foreach ($studies_id as $value) {
                        $studiesData = $controller->model("manager","studiesModels")->getData($value);
                    ?>
                    <select name="studies_id[]" id="" class="form-control mt-2">
                        <option value="<?=$studiesData['id']?>"><?=$studiesData['name']?></option>   
                    </select>
                    <?php } ?>
                    <button class="btn btn-info mt-1" type="button" id="addStudies">Yeni Ders Ekle</button>
                    <div id="teacherStudiesArea" class="mt-3"></div>
                </div>
                <div class="form-group">
                <label style="display:block;">Öğretmenin Sınıfları</label>
                    <?php 
                    $class_id = explode(",",$params['teacherData']['class_id']);
                    foreach ($class_id as $value) {
                        $classData = $controller->model("manager","classesModels")->getData($value);
                    ?>
                    <select name="class_id[]" id="" class="form-control mt-2">
                        <option value="<?=$classData['id']?>"><?=$classData['name']?></option>   
                    </select>
                    <?php } ?>
                <button class="btn btn-info mt-1" type="button" id="addClass">Yeni Sınıf Ekle</button>
                </div>
                <div id="teacherClassArea"></div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="teacherUpdate">Ekle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>

$(document).ready(function() { 


var classAttribute = '<div class="form-group"><select name="class_id[]" class="form-control"><option value="0" selected>Lütfen Sınıf Seçimi Yapınız.</option>'+
'<?php foreach ($params['classData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';                     
       
var studiesAttribute = '<div class="form-group"><select name="studies_id[]" class="form-control"><option value="0" selected>Lütfen Ders Seçimi Yapınız.</option>'+
'<?php foreach ($params['studiesData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';       

$("#addClass").click(function() {
    $("#teacherClassArea").append(classAttribute);
}) 

$("#addStudies").click(function() {
    $("#teacherStudiesArea").append(studiesAttribute);
}) 

})

</script>