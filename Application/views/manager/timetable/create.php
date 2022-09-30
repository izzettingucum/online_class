<?php 

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php
            if (isset($_SESSION['stats'])) {
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
                <h3 class="card-title">Ders Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/timetable/send" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ders Sınıfı</label>
                    <select name="class_id" id="class_id" class="form-control">
                        <option value="0">Lütfen Sınıf Seçimi Yapınız</option>
                        <?php foreach ($params['classes'] as $key => $value) { ?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="form-group" id="studies">
                    <label for="exampleInputEmail1" >Sınıf Dersi</label>
                    <select name="studies_id" id="studies_id" class="form-control">
                    </select>
                  </div>
                  <div class="form-group" id="studies_teacher">
                    <label for="exampleInputEmail1" id="label">Ders Öğretmeni</label>
                    <select name="teacher_id" id="teacher_id" class="form-control">
                    </select>
                  </div>
                  <div class="form-group" id="days">
                  <label for="exampleInputEmail1" id="label">Ders Günü</label>
                    <select name="day_id" class="form-control">
                    <option value="0">Lütfen gün seçimi yapınız</option>
                    <?php foreach ($params['days'] as $key => $value) { ?>
                      <option value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group" id="startTime">
                    <label for="exampleInputEmail1">Ders Başlangıç Saati</label>
                    <input type="time" class="form-control col-md-2" name="startTime">
                    </select>
                  </div>
                  <div class="form-group" id="finishTime">
                    <label for="exampleInputEmail1">Ders Bitiş Saati</label>
                    <input type="time" class="form-control col-md-2" name="finishTime">
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="timetableSend">Ekle</button>
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
    $("#studies").hide();
    $("#studies_teacher").hide();
    $("#days").hide();
    $("#startTime").hide();
    $("#finishTime").hide();
    $("#class_id").change(function(){ 
    var class_id = $("#class_id").val();
    if (class_id == 0) {
      alert("Lütfen sınıf seçimi yapınız.");
    }
    $.ajax({
      url: 'http://localhost/onlineClass/manager/exams/listStudies',
      type: 'post',
      data: {class_id: class_id},
      success:function(data) {
        $("#studies").show();
        $("#studies_id").html(data);
      }
    })
});
    $("#studies_id").change(function(){
        var class_id = $("#class_id").val();
        var studies_id = $("#studies_id").val();
        if (studies_id == 0) {
          alert("Lütfen ders seçimi yapınız");
        }
        $.ajax({
        url: 'http://localhost/onlineClass/manager/timetable/listTeachers',
        type: 'post',
        data: {class_id: class_id},
        success:function(data) {
        $("#studies_teacher").show();
        $("#teacher_id").html(data);
        $("#days").show();
        $("#startTime").show();
        $("#finishTime").show();
      }
    })
    })
})
</script>

<?php 
/*
BACKEND => Sunucuda çalışır dosyalar sunucudan istek atıldığında bir kere gelir, gelen bilgilerin değişmesi için tekrar istek atılması gerekir.
FRONTEND => Sadece kodlar sunucudan gelir tarayıcıda çalıştırılır, kodların çalışması için tarayıcıda görüntülenmesi yeterlidir.
HTTP REQUEST => Tek bir kanal üzerinden bir kerelik çalışır, istek atılıp cevap dönülükten sonra yeni veri gelmez.
*/
?>