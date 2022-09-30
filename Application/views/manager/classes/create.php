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
              <h3 class="box-title">Yeni Sınıf Oluştur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?=SITE_URL?>/manager/classes/send" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Sınıf Adı :</label>
                  <input type="text" class="form-control" name="name">
                </div>       
              </div>
              <div class="box-body">
                <div class="form-group">
                    <label style="display:block;">Sınıf Dersleri</label>
                    <button class="btn btn-info" type="button" id="addStudies">Yeni Ders Ekle</button>
                    <div id="classStudiesArea">
                    </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                    <label style="display:block;">Sınıf Öğretmenleri</label>
                    <button class="btn btn-info" type="button" id="addTeachers">Yeni Öğretmen Ekle</button>
                    <div id="classTeachersArea">
                    </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" name="classesSend" class="btn btn-primary">Ekle</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>
</div>
</section>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>

$(document).ready(function() {
  
var teachersAttribute = '<div class="form-group mt-2"><select name="teachers_id[]" class="form-control"><option value="0" selected>Lütfen Öğretmen Seçimi Yapınız.</option>'+
'<?php foreach ($params['teachersData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';  

var studiesAttribute = '<div class="form-group mt-2"><select name="studies_id[]" class="form-control"><option value="0" selected>Lütfen Ders Seçimi Yapınız.</option>'+
'<?php foreach ($params['studiesData'] as $key => $value) {?><option value="<?=$value['id']?>" class="form-control"><?=$value['name']?></option><?php } ?></select></div>';       

$("#addStudies").click(function() {
    $("#classStudiesArea").append(studiesAttribute);
}) 

$("#addTeachers").click(function() {
    $("#classTeachersArea").append(teachersAttribute);
}) 

})

</script>
})

</script>

