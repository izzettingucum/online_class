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
                <h3 class="card-title">Sınav Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=SITE_URL?>/manager/Exam_Grade/send" method="post">
                <div class="card-body">     
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sınıf</label>
                    <select name="class_id" id="class_id" class="form-control">
                        <option value="0">Lütfen Sınıf Seçimi Yapınız</option>
                        <?php foreach ($params['classesData'] as $key => $value) { ?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                 <div class="form-group" id="examsArea">
                    <label>Sınav</label>
                    <select name="exam_id" id="exam_id" class="form-control"></select>
                 </div>
                 <div class="form-group" id="studentsArea">
                  <label>Öğrenci</label>
                  <select name="student_id" id="student_id" class="form-control"></select>
                 </div>
                 <div class="form-group" id="grade">
                  <label>Sınav Notu</label>
                  <input class="form-control" type="number" name="grade" required>
                </div>
                </div>
               
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="gradeSend">Ekle</button>
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
    $("#examsArea").hide();
    $("#studentsArea").hide();
    $("#grade").hide();
    $("#class_id").change(function(){ 
    var class_id = $("#class_id").val();
    $.ajax({
      url: 'http://localhost/onlineClass/manager/Exam_Grade/listExams',
      type: 'post',
      data: {class_id: class_id},
      success:function(data) {
        $("#examsArea").show();
        $("#exam_id").html(data);
      }
    })
}); 
   $("#exam_id").change(function(){ 
    var class_id = $("#class_id").val();
    $.ajax({
      url: 'http://localhost/onlineClass/manager/Exam_Grade/listStudents',
      type: 'post',
      data: {class_id: class_id},
      success:function(data) {
        $("#studentsArea").show();
        $("#grade").show();
        $("#student_id").html(data);
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