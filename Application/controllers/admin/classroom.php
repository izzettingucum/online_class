<?php  

class classroom extends controller
{
 
    public function index()
    {
        $this->sessionManager->adminLogged();
        $data = $this->model("admin","classroomModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/classroom/index");
        $this->render("admin/main/footer");
    }

    public function detail()
    {
        $this->sessionManager->adminLogged();
    }

    public function delete()
    {
        $this->sessionManager->adminLogged();
    }

}