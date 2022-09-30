<?php 

class teacher extends controller
{
    public function index()
    {
        $this->sessionManager->adminLogged();
        $data = $this->model("admin","teacherModels")->listView();
        $this->render("admin/main/header");
        $this->render("admin/main/sidebar");
        $this->render("admin/teacher/index",["data" => $data]);
        $this->render("admin/main/footer");
    }

    public function edit($id)
    {
        $this->sessionManager->adminLogged();
        $teacherData = $this->model("admin","teacherModels")->getData($id);
        $corporationData = $this->model("admin","corporationModels")->listView();
        $this->render("admin/main/header");            
        $this->render("admin/main/sidebar");
        $this->render("admin/teacher/edit",["teacherData" => $teacherData,"corporationData" => $corporationData]);
        $this->render("admin/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->adminLogged();
        
        if (!isset($_POST['teacherUpdate'])) {
            helper::redirect(SITE_URL."/admin/teacher");
            exit;
        }

        if (helper::cleaner($id) == "") {
            helper::redirect(SITE_URL."/admin/teacher");
            exit;
        }

        unset($_POST['corporation_name']);
        $name = helper::cleaner($_POST['name']);
        $email = helper::cleaner($_POST['email']);
        $phone = helper::cleaner($_POST['phone']);
        $corporation_id = $_POST['corporation_id'];

        if ($name == "" || $name == "" || $phone == "") {
            helper::flashData("stats","İsim,email veya telefon bölümü boş bırakılamaz.");
            helper::redirect(SITE_URL."/admin/teacher/edit/".$id);
            exit;
        }
        
        if ($_POST['password'] != "") {
            $password = sha1(md5($_POST['password']));
        }
        else {
            $passwordData = $this->model("admin","teacherModels")->getData(helper::cleaner($id));
            $password = $passwordData['password'];
        }

        $update = $this->model("admin","teacherModels")->update($name,$email,$password,$phone,$corporation_id,$id);

        if ($update == false) {
            helper::flashData("stats","Güncelleme işlemi yapılamadı.");
            helper::redirect(SITE_URL."/admin/teacher/edit/".$id);
            exit;
        }

        helper::flashData("stats","Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/admin/teacher/edit/".$id);
        exit;
    }

    public function delete($id)
    {
        $this->sessionManager->adminLogged();
        $delete = $this->model("admin","teacherModels")->delete($id);
        if ($delete) {
            helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi");
            helper::redirect(SITE_URL."/admin/teacher");
        }
        else {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/admin/teacher");
        }
    }
}