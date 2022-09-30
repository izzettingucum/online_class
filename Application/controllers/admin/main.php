<?php  

class main extends controller
{
        public function index()
        {
            $this->sessionManager->adminLogged();
            $corporationCount = count($this->model("admin","corporationModels")->listView());
            $managerCount = count($this->model("admin","managerModels")->listView());
            $teacherCount = count($this->model("admin","teacherModels")->listView());
            $studentCount = count($this->model("admin","studentModels")->listView());
            $this->render("admin/main/header");
            $this->render("admin/main/sidebar");
            $this->render("admin/main/home",[
                "corporationCount" => $corporationCount,
                "managerCount" => $managerCount,
                "teacherCount" => $teacherCount,
                "studentCount" => $studentCount 
            ]);
            $this->render("admin/main/footer");
        }
}