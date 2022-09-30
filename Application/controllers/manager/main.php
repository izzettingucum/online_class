<?php  

class main extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $corporation_id = $_SESSION['manager']['corporation_id'];
        $studentCount = $this->model("manager","infoModels")->getTotalStudentCount($corporation_id);
        $teacherCount = $this->model("manager","infoModels")->getTotalTeacherCount($corporation_id);
        $studiesCount = $this->model("manager","infoModels")->getTotalStudiesCount($corporation_id);
        $classesCount = $this->model("manager","infoModels")->getTotalClassesCount($corporation_id);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/main/home",[
            "totalStudentCount" => $studentCount['totalStudentCount'],
            "totalTeacherCount" => $teacherCount['totalTeacherCount'],
            "totalStudiesCount" => $studiesCount['totalStudiesCount'],
            "totalClassesCount" => $classesCount['totalClassesCount']
        ]);
        $this->render("manager/main/footer");
    }
}