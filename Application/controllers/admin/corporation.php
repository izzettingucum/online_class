<?php 

class corporation extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $data = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/corporation/index",["data" => $data]);
        $this->render("admin/main/footer");
    }

    public function create()
    {
        $this->sessionManager->adminLogged();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/corporation/create");
        $this->render("admin/main/footer");
    }

    public function send()
    {
        $this->sessionManager->adminLogged();   
        if (!isset($_POST['corporationSend'])) {
           exit("yasaklı giriş");
        }

        $name = helper::cleaner($_POST['name']);
        if ($name == "") {
            helper::flashData("stats","Kurum adı boş bırakılamaz.");
            helper::redirect(SITE_URL."/admin/corporation/create");
        }

        $insert = $this->model("admin","corporationModels")->insert($name);
        if ($insert == false) {
            helper::flashData("stats","Kayıt işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/corporation/create");
        }

        helper::flashData("stats","Kayıt İşlemi Başarıyla Gerçekleştirildi");
        helper::redirect(SITE_URL."/admin/corporation/create");
    }

    public function edit($id)
    {
        $this->sessionManager->adminLogged();
        if ($id == "") {
            helper::redirect(SITE_URL."admin/corporation");
            exit;
        }
        $data = $this->model("admin","corporationModels")->getData($id);
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/corporation/edit",["data" => $data]);
        $this->render("admin/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->adminLogged();
        if ($id == "") {
            helper::redirect(SITE_URL."admin/corporation");
            exit;
        }
        $name = helper::cleaner($_POST['name']);
        $update = $this->model("admin","corporationModels")->update($name,$id);
        if ($update) {
            helper::flashData("stats","Düzenleme İşlemi Başarıyla Gerçekleştirildi.");
            helper::redirect(SITE_URL."/admin/corporation/edit/".$id);
        }
        else {
            helper::flashData("stats","Düzenleme Yapılamadı.");
            helper::redirect(SITE_URL."/admin/corporation/edit/".$id);
        }
    }

    public function delete($id)
    {
        $this->sessionManager->adminLogged();
        if ($id == "") {
            helper::redirect(SITE_URL."admin/corporation");
            exit;
        }
        $this->model("admin","corporationModels")->delete($id);
        helper::redirect(SITE_URL."/admin/corporation/index");
    }
}