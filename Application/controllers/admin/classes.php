<?php  

class classes extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $classData = $this->model("admin","classesModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/classes/index",["data" => $classData]);
        $this->render("admin/main/footer");
    }

    public function detail($id)
    {
        $this->sessionManager->adminLogged();
        $classData = $this->model("admin","classesModels")->getData($id);
        $corporationData = $this->model("admin","corporationModels")->getData($classData['corporation_id']);
        $countStudent = $this->model("admin","classesModels")->getStudentCount($classData['id']);
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/classes/detail",["classData" => $classData,"corporationData" => $corporationData,"countStudent" => $countStudent]);
        $this->render("admin/main/footer");
    }

    public function delete ($id)
    {
        $this->sessionManager->adminLogged();
        $delete = $this->model("admin","classesModels")->delete($id);
        if ($delete) {
            helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi");
            helper::redirect(SITE_URL."/admin/classes");
        }
        else {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/classes");
        }
    }
    
}
