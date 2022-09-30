<?php 

class manager extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $managerData = $this->model("admin","managerModels")->listView();
        $corporationData = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/manager/index",["managerData" => $managerData,"corporationData" => $corporationData]);
        $this->render("admin/main/footer");
    }

    public function create()
    {
        $this->sessionManager->adminLogged();
        $corporationData = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/manager/create",["corporationData" => $corporationData]);
        $this->render("admin/main/footer");
    }

    public function send()
    {
        $this->sessionManager->adminLogged();
        if (!isset($_POST['managerSend'])) {
           exit("yasaklı giriş");
        }

        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $phone = helper::cleaner($_POST['phone']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));
        $corporation_id = $_POST['corporation_id'];
        if ($name == "" || $email == "") {
            helper::flashData("stats","Lütfen Bütün Alanları Doldurunuz");
            helper::redirect(SITE_URL."/admin/manager/create");
            exit;
        }

        if ($corporation_id == 0) {
            helper::flashData("stats","Kurum Seçimi Boş Bırakılamaz.");
            helper::redirect(SITE_URL."/admin/manager/create");
            exit;
        }

        $emailControl = $this->model("admin","managerModels")->emailControl($email);

        if ($emailControl == 1) {
            helper::flashData("stats","Bu Mail Adresine Kayıtlı Bir Yönetici Hesabı Bulunmaktadır.");
            helper::redirect(SITE_URL."/admin/manager/create");
            exit;
        }

        $insert = $this->model("admin","managerModels")->insert($name,$email,$password,$phone,$corporation_id);
        if ($insert == false) {
            helper::flashData("stats","Kayıt işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/manager/create");
        }

        helper::flashData("stats","Kayıt İşlemi Başarıyla Gerçekleştirildi");
        helper::redirect(SITE_URL."/admin/manager/create");
    }

    public function edit($id)
    {
        $this->sessionManager->adminLogged();
        $managerData = $this->model("admin","managerModels")->getData($id);
        $corporationData = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/manager/edit",["managerData" => $managerData,"corporationData" => $corporationData]);
        $this->render("admin/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->adminLogged();
        if (helper::cleaner($id) == "") {
            helper::redirect(SITE_URL."admin/corporation");
            exit;
        }

        if (!isset($_POST['managerUpdate'])) {
            helper::cleaner(SITE_URL."/admin/manager");
            exit;
        }

        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $phone = helper::cleaner($_POST['phone']);
        $corporation_id = $_POST['corporation_id'];
        if (helper::cleaner($_POST['password']) == "") {
            $passwordData = $this->model("admin","managerModels")->getData(helper::cleaner($id));
            $password = $passwordData['password'];
        }
        else {
            $password = sha1(md5(helper::cleaner($_POST['password'])));
        }
        $update = $this->model("admin","managerModels")->update($name,$email,$password,$phone,$corporation_id,$id);
        if ($update) {
            helper::flashData("stats","Düzenleme İşlemi Başarıyla Gerçekleştirildi.");
            helper::redirect(SITE_URL."/admin/manager/edit/".$id);
        }
        else {
            helper::flashData("stats","Düzenleme Yapılamadı.");
            helper::redirect(SITE_URL."/admin/manager/edit/".$id);
        }
    }

    public function delete($id)
    {
        $this->sessionManager->adminLogged();
        if (helper::cleaner($id) == "") {
            exit("yasaklı giriş");
        }
        $delete = $this->model("admin","managerModels")->delete(helper::cleaner($id));
        if ($delete == true) {
            helper::flashData("stats","Silme İşlemi Başarıyla Gerçekleştirildi");
            helper::redirect(SITE_URL."/admin/manager");
        }
        else {
            helper::flashData("stats","Silme İşlemi Gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/manager");
        }
    }
}