<?php 

class studies extends controller
{
    public function index()
    {
        $teacherData = $this->model("teacher","infoModels")->getTeacherData(
            $_SESSION['teacher']['teacher_id']
        );
        $this->render("teacher/main/header");
        $this->render("teacher/main/sidebar");
        $this->render("teacher/studies/index",["studies_id" => $teacherData['studies_id']]); 
        $this->render("teacher/main/footer");
    }
}