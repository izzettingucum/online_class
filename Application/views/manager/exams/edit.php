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
                <h3 class="card-title">Sınav Güncelle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/exams/update/<?=$params['examData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınav Adı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?=$params['examData']['name']?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınav Sınıfı</label>
                    <select name="class_id" id="class_id" class="form-control">
                        <?php foreach ($params['classesData'] as $key => $value) { ?>
                            <option value="<?=$value['id']?>" <?=($params['examData']['class_id'] == $value['id']) ? "selected" : " "?>><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" id="examStudiesLabel">Sınav Dersi</label>
                    <select name="studies_id" id="studies_id" class="form-control">
                    <?php foreach ($params['studiesData'] as $key => $value) { ?>
                            <option value="<?=$value['id']?>" <?=($params['examData']['studies_id'] == $value['id']) ? "selected" : " "?>><?=$value['name']?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" id="label">Sınav Tarihi</label>
                    <input type="date" class="form-control col-md-2" name="date" value="<?=$params['examData']['date']?>">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınav Başlangıç Saati</label>
                    <input type="time" class="form-control col-md-2" name="startTime"  value="<?=$params['examData']['start']?>">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınav Bitiş Saati</label>
                    <input type="time" class="form-control col-md-2" name="finishTime"  value="<?=$params['examData']['finish']?>">
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="examUpdate">Güncelle</button>
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
    $("#class_id").change(function(){ 
    var class_id = $("#class_id").val();
    $.ajax({
      url: 'http://localhost/onlineClass/manager/exams/listStudies',
      type: 'post',
      data: {class_id: class_id},
      success:function(data) {
        $("#studies_id").html(data);
      }
    })
}); 
})
</script>

<?php 
/*
BACKEND => Sunucuda çalışır dosyalar sunucudan istek atıldığında bir kere gelir, gelen bilgilerin değişmesi için tekrar istek atılması gerekir.
FRONTEND => Sadece kodlar sunucudan gelir tarayıcıda çalıştırılır, kodların çalışması için tarayıcıda görüntülenmesi yeterlidir.
HTTP REQUEST => Tek bir kanal üzerinden bir kerelik çalışır, istek atılıp cevap dönülükten sonra yeni veri gelmez.
*/
?>