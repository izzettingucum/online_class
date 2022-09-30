<?php  

class main extends controller
{
        public function index()
        {
            $this->sessionManager->teacherLogged();
            $teacherData = $this->model("teacher","infoModels")->getTeacherData($_SESSION['teacher']['teacher_id']);
            $classCount = count(explode(",",$teacherData['class_id']));
            $studiesCount = count(explode(",",$teacherData['studies_id']));
            $this->render("teacher/main/header");
            $this->render("teacher/main/sidebar");
            $this->render("teacher/main/home",["classCount" => $classCount,"studiesCount" => $studiesCount]);
            $this->render("teacher/main/footer");
        }
}