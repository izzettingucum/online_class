<?php 

class student extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $data = $this->model("admin","studentModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/student/index",["data" => $data]);
        $this->render("admin/main/footer");
    }

    public function detail($id)
    {
        $this->sessionManager->adminLogged();
        $studentData = $this->model("admin","studentModels")->getData($id);
        $corporationData = $this->model("admin","corporationModels")->getData($studentData['corporation_id']);
        $classData = $this->model("admin","classesModels")->getData($studentData['class_id']);
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/student/detail",["studentData" => $studentData,"corporationData" => $corporationData,"classesData" => $classData]);
        $this->render("admin/main/footer");
    }

    public function delete($id)
    {
        $this->sessionManager->adminLogged();
        $delete = $this->model("admin","studentModels")->delete($id);
        if ($delete) {
            helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi");
            helper::redirect(SITE_URL."/admin/student");
        }
        else {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/student");
        }
    }
}