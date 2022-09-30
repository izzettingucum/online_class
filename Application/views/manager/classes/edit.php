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
                <h3 class="card-title">Sınıf Bilgisi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/classes/update/<?=$params['classData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?=$params['classData']['name']?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf Mevcudu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="<?=$params['studentCount']?>" readonly>
                  </div>
                  <div class="form-group">
                    <button type="button" id="studentsButton" class="btn btn-info">Öğrencileri Göster</button>
                  </div>
                  <div class="form-group" id="studentsData">
                    <label for="exampleInputEmail1">Öğrenci bilgileri</label>
                    <?php 
                    if ($params['studentCount'] != 0) {
                        foreach ($params['studentsData'] as $key => $value) {
                    ?>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="student_id" value="<?=$value['name']?>" readonly>
                    <a href="<?=SITE_URL?>/manager/student/edit/<?=$value['id']?>"><button type="button" style="float:right;" class="btn btn-info mb-">İncele</button></a>
                    <?php }} else { ?>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="student_id" value="Herhangi bir öğrenci bilgisi bulunmamaktadır." readonly>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <button type="button" id="teachersButton" class="btn btn-info">Öğretmenleri Göster</button>
                  </div>
                  <div class="form-group" id="teachersData">
                    <label for="exampleInputEmail1">Öğrentmen bilgileri</label>
                    <?php 
                    if ($params['teacherCount'] != 0) {
                        foreach ($params['teachersData'] as $key => $value) {
                    ?>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="teacher_id" value="<?=$value['name']?>" readonly>
                    <a href="<?=SITE_URL?>/manager/teacher/edit/<?=$value['id']?>"><button type="button" style="float:right;" class="btn btn-info mb-">İncele</button></a>
                    <?php }} else { ?>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="" value="Herhangi bir öğretmen bilgisi bulunmamaktadır." readonly>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <button type="button" id="studiesButton" class="btn btn-info">Dersleri Göster</button>
                  </div>
                  <div class="form-group" id="studiesData">
                  <label for="exampleInputEmail1">Sınıf Dersleri</label>
                  <?php
                   $newStudiesId = explode(",",$params['studiesId']);
                   $studies_id = explode(",",$params['classData']['studies_id']); 
                   $x = 0;
                   $controller = new controller();
                   foreach ($studies_id as $value) {
                    $studiesData = $controller->model("manager","studiesModels")->getData($value);
                   ?>
                   <select class="form-control mb-1" id="exampleInputEmail1" name="oldStudiesId[]" readonly>
                    <option value="<?=$value?>"><?=$studiesData['name']?></option>
                   </select>
                   <?php } ?>
                   <button type="button" class="btn btn-info mb-2" id="addStudies">Ders Ekle</button>
                   <div id="classStudiesArea"></div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="classUpdate">Güncelle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {

var studiesAttribute = '<div class="form-group mt-2"><select name="studies_id[]" class="form-control"><option value="0" selected>Lütfen Ders Seçimi Yapınız.</option>'+
'<?php foreach ($newStudiesId as $key => $value) { $data = $controller->model("manager","studiesModels")->getData($value);?><option value="<?=$data['id']?>" class="form-control"><?=$data['name']?></option><?php } ?></select></div>';       

$("#studentsData").hide();
$("#teachersData").hide();
$("#studiesData").hide();

$("#studentsButton").click(function() {
  $("#studentsData").show();
  $("#studentsButton").hide();
})

$("#teachersButton").click(function() {
  $("#teachersData").show();
  $("#teachersButton").hide();
})

$("#studiesButton").click(function() {
  $("#studiesData").show();
  $("studiesButton").show();
})

$("#addStudies").click(function() {
  $("#classStudiesArea").append(studiesAttribute);
}) 
  
})

</script>

