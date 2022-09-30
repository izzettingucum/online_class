<?php  

class classes extends controller
{
    public function index()
    {
        $this->sessionManager->teacherLogged();
        $teacherData = $this->model("teacher","infoModels")->getTeacherData(
            $_SESSION['teacher']['teacher_id']
        );
        $this->render("teacher/main/header");
        $this->render("teacher/main/sidebar");
        $this->render("teacher/classes/index",["class_id" => $teacherData['class_id']]); 
        $this->render("teacher/main/footer");
    }

    public function classDetail($id)
    {
        $this->sessionManager->teacherLogged();
        if (helper::cleaner($id) == "") {
            helper::redirect(SITE_URL."/teacher");
            exit;
        }

        $control = $this->model("teacher","classesModels")->classControl(helper::cleaner($id),$_SESSION['teacher']['corporation_id']);
        
        if ($control['classControl'] != 1) {
            helper::redirect(SITE_URL."/teacher");
            exit;
        }

        $classData = $this->model("teacher","classesModels")->getClassData(helper::cleaner($id));
        $studentsName = $this->model("teacher","classesModels")->getStudentsName(helper::cleaner($id),$_SESSION['teacher']['corporation_id']);
        $studentCount = $this->model("teacher","classesModels")->getStudentCount($classData['id']);
        $this->render("teacher/main/header");
        $this->render("teacher/main/sidebar");
        $this->render("teacher/classes/detail",[
        "studentsName" => $studentsName,
        "className" => $classData['name'],
        "studentCount" => $studentCount['studentCount']
        ]); 
        $this->render("teacher/main/footer");

    }
}