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
              <form action="<?=SITE_URL?>/manager/timetable/update/<?=$params['timetableData']['id']?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1" >Sınıf Adı</label>
                    <input type="text" readonly class="form-control" name ="class_name" value="<?=$params['classData']['name']?>">
                    <input type="hidden" name="class_id" value="<?=$params['classData']['id']?>">
                  </div>
                  <div class="form-group" id="studies">
                    <label for="exampleInputEmail1" >Ders Adı</label>
                    <input type="text" readonly value="<?=$params['studiesData']['name']?>" class="form-control">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" id="label">Ders Öğretmeni</label>
                    <input type="text" readonly class="form-control" value="<?=$params['teacherData']['name']?>">
                    </select>
                  </div>
                  <div class="form-group" >
                  <label for="exampleInputEmail1" id="label">Ders Günü</label>
                    <select name="day_id" class="form-control">
                    <?php foreach ($params['days'] as $key => $value) { ?>
                      <option value="<?=$value['id']?>" <?=($params['timetableData']['day'] == $value['id']) ? 'selected' : "";?> ><?=$value['name']?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group" id="startTime">
                    <label for="exampleInputEmail1">Ders Başlangıç Saati</label>
                    <input type="time" class="form-control col-md-2" name="startTime" value="<?=$params['timetableData']['start']?>">
                    </select>
                  </div>
                  <div class="form-group" id="finishTime">
                    <label for="exampleInputEmail1">Ders Bitiş Saati</label>
                    <input type="time" class="form-control col-md-2" name="finishTime" value="<?=$params['timetableData']['finish']?>">
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="timetableUpdate">Güncelle</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
/*
BACKEND => Sunucuda çalışır dosyalar sunucudan istek atıldığında bir kere gelir, gelen bilgilerin değişmesi için tekrar istek atılması gerekir.
FRONTEND => Sadece kodlar sunucudan gelir tarayıcıda çalıştırılır, kodların çalışması için tarayıcıda görüntülenmesi yeterlidir.
HTTP REQUEST => Tek bir kanal üzerinden bir kerelik çalışır, istek atılıp cevap dönülükten sonra yeni veri gelmez.
*/
?>