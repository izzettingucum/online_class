<?php  

class studies extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $studiesData = $this->model("manager","studiesModels")->listView($_SESSION['manager']['corporation_id']) ;
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/studies/index",["data" => $studiesData]);
        $this->render("manager/main/footer");
        
    }

    public function create()
    {
        $this->sessionManager->managerLogged();
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/studies/create");
        $this->render("manager/main/footer");
    }

    public function send()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['studiesSend'])) {
            helper::redirect(SITE_URL."/manager/studies/send");
            exit;
        }

        $name = helper::cleaner($_POST['name']);
        $corporation_id = $_SESSION['manager']['corporation_id'];

        $insert = $this->model("manager","studiesModels")->insert($name,$corporation_id);

        if ($insert == false) {
            helper::flashData("stats","Ders ekleme işlemi başarısız oldu.");
            helper::redirect(SITE_URL."/manager/studies/create");
            exit;
        }

        helper::flashData("stats","Ders ekleme işlemi başarıyla tamamlandı.");
        helper::redirect(SITE_URL."/manager/studies/create");
        exit;
    }

    public function edit($id)
    {   
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","studiesModels")->studiesControl(helper::cleaner($id));
        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }
        $data = $this->model("manager","studiesModels")->getData(helper::cleaner($id));
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/studies/edit",["data" => $data]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['studiesUpdate'])) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }
        $control = $this->model("manager","studiesModels")->studiesControl(helper::cleaner($id));
        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        $name = helper::cleaner($_POST['name']);
        $update = $this->model("manager","studiesModels")->update($name,$id);

        if ($update == false) {
            helper::flashData("stats","Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/studies/edit/".$id);
            exit;
        }

        helper::flashData("stats","Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/studies/edit/".$id);
        exit;
    }

    public function delete($id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager","studiesModels")->studiesControl(helper::cleaner($id));
        if ($control == false) {
            helper::redirect(SITE_URL."/manager");
            exit;
        }

        $delete = $this->model("manager","studiesModels")->delete(helper::cleaner($id));

        if ($delete == false) {
            helper::flashData("stats","Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL."/manager/studies");
            exit;
        }

        helper::flashData("stats","Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/manager/studies");
        exit;
    }
}