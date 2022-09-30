<?php 

class main extends controller
{
    public function index()
    {
        $this->sessionManager->studentLogged();
        $classData = $this->model("student","infoModels")->getClassData(
            $_SESSION['student']['class_id'],
            $_SESSION['student']['corporation_id']
        );
        $studiesCount = count(explode(",",$classData['studies_id']));
        $this->render("student/main/header");
        $this->render("student/main/sidebar");
        $this->render("student/main/home",["studiesCount" => $studiesCount]);
        $this->render("student/main/footer");
    }
}