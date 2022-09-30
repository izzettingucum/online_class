<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<?php 
if (isset($_SESSION['stats'])) {
  echo helper::flashDataView("stats");
}

?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Yeni Öğretmen Oluştur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=SITE_URL?>/manager/teacher/send" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Öğretmen Adı :</label>
                  <input type="text" class="form-control" name="name">
                </div>       
                <div class="form-group">
                  <label for="exampleInputEmail1">Öğretmen E-mail Adresi :</label>
                  <input type="text" class="form-control" name="email">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Öğretmen Şifresi :</label>
                  <input type="password" class="form-control" name="password">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Öğretmen Telefon Numarası :</label>
                  <input type="text" class="form-control" name="phone">
                </div> 
              </div>
              <div class="box-body">
                <div class="form-group">
                    <label style="display:block;">Öğretmenin Dersleri</label>
                    <button class="btn btn-info" type="button" id="addStudies">Yeni Ders Ekle</button>
                    <div id="teacherStudiesArea" class="mt-3"></div>
                </div>
                <div class="form-group">
                <label style="display:block;">Öğretmenin Sınıfları</label>
                <button class="btn btn-info" type="button" id="addClass">Yeni Sınıf Ekle</button></div>
              </div>
              <div id="teacherClassesArea"></div>
              <div class="box-footer">
                <button type="submit" name="teachersSend" class="btn btn-primary">Ekle</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>
</div>
</section>
</div>
<script>

$(document).ready(function() { 


var classAttribute = '<div class="form-group"><select name="class_id[]" class="form-control"><option value="0" selected>Lütfen Sınıf Seçimi Yapınız.</option>'+
'<?php foreach ($params['classesData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';                     
       
var studiesAttribute = '<div class="form-group"><select name="studies_id[]" class="form-control"><option value="0" selected>Lütfen Ders Seçimi Yapınız.</option>'+
'<?php foreach ($params['studiesData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';       

$("#addClass").click(function() {
    $("#teacherClassesArea").append(classAttribute);
}) 

$("#addStudies").click(function() {
    $("#teacherStudiesArea").append(studiesAttribute);
}) 

})

</script>

