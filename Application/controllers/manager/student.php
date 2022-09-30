<?php  

class student extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $studentData = $this->model("manager","studentModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/student/index",["studentData" => $studentData]);
        $this->render("manager/main/footer");
    }

    public function create()
    {
        $this->sessionManager->managerLogged();
        $classesData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/student/create",["classesData" => $classesData]);
        $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['studentSend'])) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }
        
        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $phone = helper::cleaner($_POST['phone']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));
        $classes_id = $_POST['classes_id'];
        $corporation_id = $_SESSION['manager']['corporation_id'];

        if ($password == "" || $name == "" || $email == "" || $phone == "") {
            helper::flashData("stats","Lütfen bütün bölümleri doldurunuz.");
            helper::redirect(SITE_URL."/manager/student/create");
            exit;
        }

        if ($classes_id == "0") {
            helper::flashData("stats","Lütfen sınıf seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/student/create");
            exit;
        }

        $insert = $this->model("manager","studentModels")->insert($name,$email,$phone,$password,$classes_id,$corporation_id);

        if ($insert == false) {
            helper::flashData("stats","Öğrenci ekleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/student/create");
            exit;
        }

        helper::flashData("stats","Öğrenci ekleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/student/create");
        exit;
    }

    public function edit($id)
    {
        $this->sessionManager->managerLogged();
        $studentData = $this->model("manager","studentModels")->getData($id);
        $classesData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/student/edit",["studentData" => $studentData,"classesData" => $classesData]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['studentUpdate'])) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $phone = helper::cleaner($_POST['phone']);
        $class_id = $_POST['class_id'];
        $corporation_id = $_SESSION['manager']['corporation_id'];

        if ($name == "" || $email == "" || $phone == "") {
            helper::flashData("stats","İsim,telefon yada email bilgisi boş bırakılamaz.");
            helper::redirect(SITE_URL."/manager/student/edit/".$id);
            exit;
        }

        if (helper::cleaner($_POST['password']) == "") {
            $studentData = $this->model("manager","studentModels")->getData($id);
            $password = $studentData['password'];
        }

        else {
            $password = sha1(md5(helper::cleaner($_POST['password'])));
        }

        $update = $this->model("manager","studentModels")->update($name,$email,$phone,$password,$class_id,$corporation_id,$id);

        if ($update == false) {
            helper::flashData("stats","Güncelleme gerçekleştirilemedi");
            helper::redirect(SITE_URL."/manager/student/edit/".$id);
            exit;
        }

        helper::flashData("stats","Güncelleme başarıyla gerçekleştirildi");
        helper::redirect(SITE_URL."/manager/student/edit/".$id);
    }

    public function delete($id)
    {
        $this->sessionManager->managerLogged();
        if (helper::cleaner($id) == "") {
            helper::redirect(SITE_URL."/manager");
        }

        $delete = $this->model("manager","studentModels")->delete($id);
        
        if ($delete == true) {
            helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi");
            helper::redirect(SITE_URL."/manager/student");
            exit;
        }
        else {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi");
            helper::redirect(SITE_URL."/manager/student");
            exit;
        }
    }
}