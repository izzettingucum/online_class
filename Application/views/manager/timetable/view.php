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
                <h3 class="card-title">Ders Programı Görüntüle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gün seçimi</label>
                    <select name="day_id" id="day_id" class="form-control">
                        <option value="0">Lütfen Gün Seçimi Yapınız</option>
                        <?php foreach ($params['days'] as $key => $value) { ?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" name="class_id" id="class_id" value="<?=$params['class_id']?>">
                  <div class="card-body" id="table">
                    <table id="example2" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Ders Adı</th>
                            <th>Ders Öğretmeni</th>
                            <th>Ders Saati</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                          </tr>
                          </thead>
                          <tbody id="data">
                          </tbody>
                    </table>
                  </div>

                </div>
                <!-- /.card-body -->
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
    $("#table").hide();
    $("#day_id").change(function(){
        var class_id = $("#class_id").val();
        var day_id = $("#day_id").val();
        if (day_id == 0) {
          alert("Lütfen gün seçimi yapınız");
        }
        $.ajax({
        url: 'http://localhost/onlineClass/manager/timetable/listTimetable',
        type: 'post',
        data: {day_id: day_id,class_id: class_id},
        success:function(data) {
        $("#table").show();
        $("#data").html(data);
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