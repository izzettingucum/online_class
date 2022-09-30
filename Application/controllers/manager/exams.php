<?php  

class exams extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $examsData = $this->model("manager","examsModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/exams/index",["examsData" => $examsData]);
        $this->render("manager/main/footer");
    }

    public function create()
    {
        $this->sessionManager->managerLogged();
        $classesData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/exams/create",["classesData" => $classesData]);
        $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['examSend'])) {
            helper::redirect(SITE_URL);
            exit;
        } 
        $name = $_POST['name'];
        if ($name == "") {
            helper::flashData("stats","Lütfen sınav adını giriniz.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        } 
        $class_id = $_POST['class_id'];
        if ($_POST['class_id'] == 0) {
            helper::flashData("stats","Lütfen sınıf seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        $studies_id = $_POST['studies_id'];
        if (!isset($studies_id) || $studies_id == 0) {
            helper::flashData("stats","Lütfen ders seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        date_default_timezone_set('Europe/Istanbul');
        $start = $_POST['startTime'];
        $finish = $_POST['finishTime'];
        if ((strtotime($finish)-strtotime($start)) < 0) {
            helper::flashData("stats","Sınav bitiş saati sınav başlangıcından önce olamaz.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        if ($start == "" || $finish == "") {
            helper::flashData("stats","Lütfen sınav saat bilgisini giriniz.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        $current_date = date("Y-m-d");
        $exam_date = $_POST['date'];
        if ($current_date > $exam_date || $exam_date == "") {
            helper::flashData("stats","Lütfen geçerli bir tarih giriniz.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        $insert = $this->model("manager","examsModels")->insert(
            $name,
            $_SESSION['manager']['corporation_id'],
            $class_id,
            $studies_id,
            $exam_date,
            $start,
            $finish
        );
        if ($insert == false) {
            helper::flashData("stats","Sınav kayıt işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/exams/create");
            exit;
        }
        helper::flashData("stats","Sınav kayıt işlemi başarıyla gerçekleştirildi");
        helper::redirect(SITE_URL."/manager/exams/create");
        exit;   
    }

    public function edit($id)
    {
        $this->sessionManager->managerLogged();
        $examControl = $this->model("manager","examsModels")->examControl(helper::cleaner($id),$_SESSION['manager']['corporation_id']);
        if ($examControl['examControl'] == 0) {
            helper::redirect(SITE_URL."/manager/exams");
            exit;
        }
        $examData = $this->model("manager","examsModels")->getExamData(helper::cleaner($id),$_SESSION['manager']['corporation_id']);
        $studentList = $this->model("manager","studentModels")->allStudentsByClassID($examData['class_id'],$_SESSION['manager']['corporation_id']);
        $studiesData = $this->model("manager","studiesModels")->listView($_SESSION['manager']['corporation_id']);
        $classesData = $this->model("manager","classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/exams/edit",[
            "examData" => $examData,
            "classesData" => $classesData,
            "studiesData" => $studiesData,
            "studentList" => $studentList
        ]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['examUpdate'])) {
            helper::redirect(SITE_URL."/manager/exams");
            exit;
        }
        $examControl = $this->model("manager","examsModels")->examControl(helper::cleaner($id),$_SESSION['manager']['corporation_id']);
        if ($examControl['examControl'] == 0) {
            helper::redirect(SITE_URL."/manager/exams");
            exit;
        }
        $name = $_POST['name'];
        $class_id = $_POST['class_id'];
        if ($name == "") {
            helper::flashData("stats","Lütfen sınav adını giriniz.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        } 
        $studies_id = $_POST['studies_id'];
        if (!isset($studies_id)) {
            helper::flashData("stats","Lütfen ders seçimi yapınız.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        }
        date_default_timezone_set('Europe/Istanbul');
        $start = $_POST['startTime'];
        $finish = $_POST['finishTime'];
        if ((strtotime($finish)-strtotime($start)) < 0) {
            helper::flashData("stats","Sınav bitiş saati sınav başlangıcından önce olamaz.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        }
        if ($start == "" || $finish == "") {
            helper::flashData("stats","Lütfen sınav saat bilgisini giriniz.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        }
        $current_date = date("Y-m-d");
        $exam_date = $_POST['date'];
        if ($current_date > $exam_date || $exam_date == "") {
            helper::flashData("stats","Lütfen geçerli bir tarih giriniz.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        }
        $update = $this->model("manager","examsModels")->update(
            $name,
            $class_id,
            $studies_id,
            $exam_date,
            $start,
            $finish,
            helper::cleaner($id)
        );
        if ($update == false) {
            helper::flashData("stats","Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/exams/edit/".$id);
            exit;
        }
        helper::flashData("stats","Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/exams/edit/".$id);
        exit;
    }

    public function delete($id) 
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","examsModels")->examControl(helper::cleaner($id),$_SESSION['manager']['corporation_id']);

        if ($control != 1) {
            helper::redirect(SITE_URL."/manager");
        }

        $delete = $this->model("manager","examsModels")->deleteExam(helper::cleaner($id),$_SESSION['manager']['corporation_id']);

        if ($delete == false) {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/exams");
            exit;
        }

        helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/exams");
        exit;
    }

    public function listStudies()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST)) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        $class_data= $this->model("manager","classesModels")->getStudiesID($_POST['class_id']);
        $studies_id = explode(",",$class_data['studies_id']);
        echo "<option value='0'>Lütfen ders seçimi yapınız.</option>";
        foreach ($studies_id as $key => $value) {
            $studies_data = $this->model("manager","studiesModels")->getData($value);
            echo "<option value='$value'>".$studies_data['name']."</option>";
        }

    }
}