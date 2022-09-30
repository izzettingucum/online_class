<?php


class classes extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $classesData = $this->model("manager", "classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/classes/index", ["data" => $classesData]);
        $this->render("manager/main/footer");
    }

    public function create()
    {
        $this->sessionManager->managerLogged();
        $classesData = $this->model("manager", "classesModels")->listView($_SESSION['manager']['corporation_id']);
        $studiesData = $this->model("manager", "classesModels")->getAllStudies($_SESSION['manager']['corporation_id']);
        $teachersData = $this->model("manager", "teacherModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/classes/create", ["studiesData" => $studiesData, "teachersData" => $teachersData]);
        $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();

        if (!isset($_POST['classesSend'])) {
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        if (!isset($_POST['studies_id'])) {
            helper::flashData("stats", "Lütfen ders seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        if (!isset($_POST['teachers_id'])) {
            helper::flashData("stats", "Lütfen öğretmen seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        if (in_array(0, $_POST['studies_id'])) {
            helper::flashData("stats", "Lütfen ders seçimlerini tam bir şekilde yapınız.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        if ($_POST['name'] == "") {
            helper::flashData("stats", "Sınıf adı boş bırakılamaz.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        if (in_array(0, $_POST['teachers_id'])) {
            helper::flashData("stats", "Lütfen öğretmen seçimlerini tam bir şekilde yapınız.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        $controlStudies = array_count_values($_POST['studies_id']);

        foreach ($controlStudies as $key => $value) {
            if ($value >= 2) {
                helper::flashData("stats", "Bir sınıfa 2 veya daha fazla aynı ders tanımlanamaz.");
                helper::redirect(SITE_URL . "/manager/classes/create");
                exit;
            }
        }

        $controlTeachers = array_count_values($_POST['teachers_id']);

        foreach ($controlTeachers as $key => $value) {
            if ($value >= 2) {
                helper::flashData("stats", "Bir sınıfa 2 veya daha fazla aynı öğretmen tanımlanamaz.");
                helper::redirect(SITE_URL . "/manager/classes/create");
                exit;
            }
        }

        $className = helper::cleaner($_POST['name']);
        $corporation_id = $_SESSION['manager']['corporation_id'];
        $studies_id = implode(",", $_POST['studies_id']);
        $teachers_id = implode(",", $_POST['teachers_id']);
        $insert = $this->model("manager", "classesModels")->insert($className, $corporation_id, $studies_id, $teachers_id);

        if ($insert == false) {
            helper::flashData("stats", "Sınıf ekleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/classes/create");
            exit;
        }

        helper::flashData("stats", "Sınıf ekleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/classes/create");
    }

    public function edit($id)
    {
        $this->sessionManager->managerLogged();
        $classData = $this->model("manager", "classesModels")->getData(helper::cleaner($id));
        if (!$classData) {
            helper::redirect(SITE_URL . "manager/classes");
            exit;
        }

        $oldStudiesId = explode(",", $classData['studies_id']);
        $allStudiesData = $this->model("manager", "classesModels")->getAllStudies($_SESSION['manager']['corporation_id']);
        $allStudiesId = array();
        $count = 0;
        foreach ($allStudiesData as $value) {
            $allStudiesId[$count] = $value['id'];
            $count++;
        }

        $newStudiesId = implode(",", array_diff($allStudiesId, $oldStudiesId));

        $studentCount = $this->model("manager", "classesModels")->getStudentCount($id);
        if ($studentCount != 0) {
            $studentsData = $this->model("manager", "classesModels")->getAllStudents($id);
        }

        $teachersID = explode(",",$classData['teachers_id']);
        $teacherCount = sizeof($teachersID);
        $teachersData = array();
        $count = 0;
        foreach ($teachersID as $key => $value) {
            $teachersData[$count] = $this->model("manager","teacherModels")->allTeachersByClassID($value,$_SESSION['manager']['corporation_id']); 
            $count++;           
        }
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/classes/edit", [
            "classData" => $classData,
            "studentCount" => $studentCount['studentCount'],
            "studentsData" => $studentsData,
            "teacherCount" => $teacherCount,
            "teachersData" => $teachersData,
            "studiesId" => $newStudiesId
        ]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['classUpdate'])) {
            helper::redirect(SITE_URL . "/manager/classes");
            exit;
        }

        if (isset($_POST['studies_id'])) {
            foreach ($_POST['studies_id'] as $key => $value) {
                $control = $this->model("manager", "classesModels")->controlStudies($value, $_SESSION['manager']['corporation_id']);
                if ($control == false) {
                    helper::flashData("stats", "Eğer ders ekle tuşuna bastıysanız lütfen ders seçiniz.");
                    helper::redirect(SITE_URL . "/manager/classes/edit/" . $id);
                    exit;
                }
            }

            $oldStudiesId = $_POST['oldStudiesId'];

            foreach ($_POST['studies_id'] as $key => $value) {
                if (in_array($value, $oldStudiesId)) {
                    helper::flashData("stats", "Daha önce yapılmış ders kaydı tekrar yapılamaz.");
                    helper::redirect(SITE_URL . "/manager/classes/edit/" . $id);
                    exit;
                }
            }

            $studies_id = array_merge($oldStudiesId, $_POST['studies_id']);
            $name = helper::cleaner($_POST['name']);
            $newStudiesId = implode(",", $studies_id);
        }

        else {
            $newStudiesId = implode(",", $_POST['oldStudiesId']);
        }

        $name = helper::cleaner($_POST['name']);
        $update = $this->model("manager", "classesModels")->update($name, $newStudiesId, $id);
        if ($update == false) {
            helper::flashData("stats", "Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/classes/edit/" . $id);
            exit;
        }

        helper::flashData("stats", "Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/classes/edit/" . $id);
        exit;
    }

    public function delete($id)
    {
        $this->sessionManager->managerLogged();
        $delete = $this->model("manager", "classesModels")->delete(helper::cleaner($id));

        if ($delete == false) {
            helper::flashData("stats", "Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/classes");
            exit;
        }

        helper::flashData("stats", "Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/classes");
        exit;

    }

}