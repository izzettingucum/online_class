<?php 

class studies extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $data = $this->model("admin","studiesModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/studies/index",["data" => $data]);
        $this->render("admin/main/footer");
    }

    public function edit($id)
    {
        $this->sessionManager->adminLogged();
        $studiesData = $this->model("admin","studiesModels")->getData($id);
        $corporationData = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/studies/edit",["studiesData" => $studiesData,"corporationData" => $corporationData]);
        $this->render("admin/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->adminLogged();

        if (!isset($_POST['studiesUpdate']) || $id == "") {
            exit("yasaklı giriş");
        }

        $name = helper::cleaner($_POST['name']);
        $corporation_id = $_POST['corporation_id'];

        if ($name == "") {
            helper::flashData("stats","Ders adı boş bırakılamaz.");
            helper::redirect(SITE_URL."/admin/studies/edit/".$id);
            exit;
        }

        $update = $this->model("admin","studiesModels")->update($name,$corporation_id,$id);

        if ($update == false) {
            helper::flashData("stats","Düzenleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/studies/edit/".$id);
            exit;
        }
        helper::flashData("stats","Düzenleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/admin/studies/edit/".$id);
    }

    public function delete($id)
    {
        $this->sessionManager->adminLogged();
        $delete = $this->model("admin","studiesModels")->delete($id);
        if ($delete) {
            helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi");
            helper::redirect(SITE_URL."/admin/studies");
        }
        else {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/studies");
        }
    }
}