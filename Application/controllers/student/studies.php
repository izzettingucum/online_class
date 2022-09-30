<?php 

class studies extends controller
{
    public function index()
    {
        $this->sessionManager->studentLogged();
        $studies_id = $this->model("student","studiesModels")->getStudiesId($_SESSION['student']['class_id']);
        $this->render("student/main/header");
        $this->render("student/main/sidebar");
        $this->render("student/studies/index",["studies_id" => $studies_id['studies_id']]);
        $this->render("student/main/footer");
    }
}