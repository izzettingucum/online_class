<?php  

class teacher extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $teacherData = $this->model("manager","teacherModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/teacher/index",["data" => $teacherData]);
        $this->render("manager/main/footer");
    }

    public function create()
    {
         $this->sessionManager->managerLogged();
         $classesData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
         $studiesData = $this->model("manager","studiesModels")->listView($_SESSION['manager']['corporation_id']);
         $this->render("manager/main/header");
         $this->render("manager/main/sidebar");
         $this->render("manager/teacher/create",["classesData" => $classesData,"studiesData" => $studiesData]);
         $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['teachersSend'])) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        if (!isset($_POST['studies_id'])) {
            helper::flashData("stats","Lütfen Ders Seçimi Yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        if (in_array("0",$_POST['studies_id'])) {
            helper::flashData("stats","Lütfen Ders Seçimi Yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }
        
        $countStudies = array_count_values($_POST['studies_id']);
        foreach ($countStudies as $value) {
            if ($value >= 2) {
                helper::flashData("stats","Bir ders 2 veya daha fazla sefer bir öğretmene kayıtlı olamaz.");
                helper::redirect(SITE_URL."/manager/teacher/create");
                exit;
            }
        }

        if (!isset($_POST['class_id'])) {
            helper::flashData("stats","Lütfen Sınıf Seçimi Yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        if (in_array("0",$_POST['class_id'])) {
            helper::flashData("stats","Lütfen Ders Seçimi Yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        $countClass = array_count_values($_POST['class_id']);
        foreach ($countClass as $value) {
            if ($value >= 2) {
                helper::flashData("stats","Bir sınıf 2 veya daha fazla sefer bir öğretmene kayıtlı olamaz.");
                helper::redirect(SITE_URL."/manager/teacher/create");
                exit;
            }
        }

        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));
        $phone = helper::cleaner($_POST['phone']);
        $class_id = implode(",",$_POST['class_id']);
        $studies_id = implode(",",$_POST['studies_id']);
        $control = $this->model("manager","teacherModels")->controlTeacherEmail($email,$_SESSION['manager']['corporation_id']);

        if($name == "")
        {
            helper::flashData("stats","Ad kısmı boş bırakılamaz.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        if ($control == false) {
            helper::flashData("stats","Bu emaile sahip bir kullanıcı bulunmakta.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        $insert = $this->model("manager","teacherModels")->insert($name,$email,$phone,$password,$class_id,$studies_id,$_SESSION['manager']['corporation_id']);

        if (!$insert) {
            helper::flashData("stats","Kayıt işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/teacher/create");
            exit;
        }

        helper::flashData("stats","Kayıt işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/teacher/create");
        exit;
        
    }

    public function edit($id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","teacherModels")->controlTeacherId(helper::cleaner($id));
        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }
        $teacherData = $this->model("manager","teacherModels")->getData(helper::cleaner($id));
        $classData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
        $studiesData = $this->model("manager","studiesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/teacher/edit",
        [
            "teacherData" => $teacherData,
            "classData" => $classData,
            "studiesData" => $studiesData
        ]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","teacherModels")->controlTeacherId(helper::cleaner($id));
        
        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        if (!isset($_POST['teacherUpdate'])) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        if (helper::cleaner($_POST['password']) == "") {
            $data = $this->model("manager","teacherModels")->getData(helper::cleaner($id));
            $password = $data['password'];
        }
        else {
            $password = sha1(md5(helper::cleaner($_POST['password'])));
        }

        $email = helper::cleaner($_POST['email']);
        $name = helper::cleaner($_POST['name']);
        $phone = helper::cleaner($_POST['phone']);
        $controlEmail = $this->model("manager","teacherModels")->controlEmailCount($email,helper::cleaner($id));

        if ($controlEmail >= 1) {
            helper::flashData("stats","E-mail adresini var sistemde var olan bir e-mail adresiyle değiştiremezsiniz.Lütfen tekrar deneyiniz.");
            helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
            exit;
        }

        if ($name == "") {
            helper::flashData("stats","Lütfen ad kısmını doldurunuz.");
            helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
            exit;
        }

        if (in_array("0",$_POST['studies_id'])) {
            helper::flashData("stats","Eğer sınıf ders ekleyecekseniz lütfen ders seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
            exit;
        }

        $countStudies = array_count_values($_POST['studies_id']);
        foreach ($countStudies as $value) {
            if ($value >= 2) {
                helper::flashData("stats","Bir ders aynı öğretmene 2 veya daha fazla sefer tanımlanamaz.");
                helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
                exit;
            }
        }

        if (in_array("0",$_POST['class_id'])) {
            helper::flashData("stats","Eğer sınıf ekleme işlemi yapacaksanız lütfen sınıf seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
            exit;
        }

        $countClass = array_count_values($_POST['class_id']);
        foreach ($countClass as $value) {
            if ($value >= 2) {
                helper::flashData("stats","Bir sınıf 2 veya daha fazla sefer bir öğretmene kayıtlı olamaz.");
                helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
                exit;
            }
        }
        
        $studies_id = implode(",",$_POST['studies_id']);
        $class_id = implode(",",$_POST['class_id']);
        $update = $this->model("manager","teacherModels")->update($name,$email,$phone,$password,$studies_id,$class_id,$id);

        if ($update == false) {
            helper::flashData("stats","Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
            exit;
        }

        helper::flashData("stats","Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/teacher/edit/".$id);
        exit;
        
    }

    public function delete($id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","teacherModels")->controlTeacherId(helper::cleaner($id));

        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }
        $delete = $this->model("manager","teacherModels")->delete(helper::cleaner($id));
        if ($delete == false) {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/teacher");
            exit;
        }

        helper::flashData("stats","Silme başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/teacher");
        exit;
    }

}