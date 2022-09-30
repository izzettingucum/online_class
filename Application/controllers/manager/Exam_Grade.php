<?php


class Exam_Grade extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $exams = $this->model("manager", "examsModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/examGrade/index", ["exams" => $exams]);
        $this->render("manager/main/footer");
    }

    public function addGrade()
    {
        $this->sessionManager->managerLogged();
        $classesData = $this->model("manager", "classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/examGrade/addGrade", ["classesData" => $classesData]);
        $this->render("manager/main/footer");
    }

    public function viewGrade($exam_id, $class_id)
    {
        $this->sessionManager->managerLogged();
        if (empty($exam_id) || empty($class_id)) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        $gradeData = $this->model("manager", "gradeModels")->getAllGradeByClassID($exam_id, $class_id);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/examGrade/viewGrade", ["gradeData" => $gradeData]);
        $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();

        if (!isset($_POST['gradeSend'])) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $class_id = $_POST['class_id'];
        $exam_id = $_POST['exam_id'];
        $student_id = $_POST['student_id'];
        $grade = $_POST['grade'];

        if ($class_id == 0 || $exam_id == 0 || $student_id == 0) {
            helper::flashData("stats", "Sınıf,sınav ve öğrenci bölümleri boş bırakılamaz");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/addGrade");
            exit;
        }

        $control = $this->model("manager", "gradeModels")->examGradeControl(
            $class_id,
            $exam_id,
            $student_id
        );

        if ($control['controlGrade'] != 0) {
            helper::flashData("stats", "Bu öğrencinin belirtilen sınavına dair not kaydı bulunmaktadır.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/addGrade");
            exit;
        }

        if ($grade > 100 || $grade < 0) {
            helper::flashData("stats", "Sınav notu 100 den büyük veya 0 dan küçük olamaz.");
            helper::redirect(SITE_URL . "/manager/Exam_grade/addGrade");
            exit;
        }

        $insert = $this->model("manager", "gradeModels")->insert($class_id, $exam_id, $student_id, $grade);

        if ($insert == false) {
            helper::flashData("stats", "Kayıt işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/addGrade");
            exit;
        }

        helper::flashData("stats", "Kayıt işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/Exam_Grade/addGrade");
        exit;

    }

    public function editGrade($id)
    {
        $this->sessionManager->managerLogged();
        if ($id == "") {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        $gradeData = $this->model("manager", "gradeModels")->getGradeByID($id, $_SESSION['manager']['corporation_id']);
        $examData = $this->model("manager", "examsModels")->getExamData($gradeData['exam_id'], $_SESSION['manager']['corporation_id']);
        $studentData = $this->model("manager", "studentModels")->getData($gradeData['student_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/examGrade/editGrade", [
            "gradeData" => $gradeData,
            "examData" => $examData,
            "studentData" => $studentData
        ]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        if ($id == "") {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $grade = $_POST['grade'];

        if ($grade < 0 || $grade > 100) {
            helper::flashData("stats", "Sınav notu 0 ve 100 arasında bir not olmalıdır.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/editGrade/" . $id);
            exit;
        }

        if ($grade == "") {
            helper::flashData("stats", "Sınav notu boş bırakılamaz.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/editGrade/" . $id);
            exit;
        }

        $control = $this->model("manager", "gradeModels")->examGradeControlByID($id, $_SESSION['manager']['corporation_id']);

        if ($control == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $update = $this->model("manager", "gradeModels")->update($grade, $id, $_SESSION['manager']['corporation_id']);

        if ($update == false) {
            helper::flashData("stats", "Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/editGrade/" . $id);
            exit;
        }

        helper::flashData("stats", "Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/Exam_Grade/editGrade/" . $id);
        exit;
    }

    public function delete($id, $class_id, $exam_id)
    {
        $this->sessionManager->managerLogged();

        if ($id == "" || $exam_id == "" || $class_id = "") {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $control = $this->model("manager", "gradeModels")->examGradeControlByID($id, $_SESSION['manager']['corporation_id']);

        if ($control == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $delete = $this->model("manager", "gradeModels")->deleteByID($id, $_SESSION['manager']['corporation_id']);

        if ($delete == false) {
            helper::flashData("stats", "Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/Exam_Grade/viewGrade/" . $exam_id . "/" . $class_id);
            exit;
        }

        helper::flashData("stats", "Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/Exam_Grade/viewGrade/" . $exam_id . "/" . $class_id);
        exit;

    }
    
    public function deleteAll($exam_id, $class_id)
    {
        $this->sessionManager->managerLogged();
        if ($exam_id == "" || $class_id == "") {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $delete = $this->model("manager", "gradeModels")->deleteAll($exam_id, $class_id);

        if ($delete == false) {
            helper::flashData("stats", "Silme işlemi başarısız.");
            helper::redirect(SITE_URL . "/manager/Exam_grade");
            exit;
        }

        helper::flashData("stats", "Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/Exam_grade");
        exit;
    }

    public function listExams()
    {
        $this->sessionManager->managerLogged();

        $examData = $this->model("manager", "examsModels")->getExamsByClassID($_POST['class_id']);

        echo "<option value='0'>Lütfen Sınav seçimi yapınız.</option>";
        foreach ($examData as $key => $value) {
            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
        }
    }

    public function listStudents()
    {
        $this->sessionManager->managerLogged();
        $studentData = $this->model("manager", "studentModels")->allStudentsByClassID(
            $_POST['class_id'],
            $_SESSION['manager']['corporation_id']
        );
        echo "<option value='0'>Lütfen Öğrenci seçimi yapınız.</option>";
        foreach ($studentData as $key => $value) {
            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
        }
    }
}