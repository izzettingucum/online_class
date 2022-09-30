<?php  

class detail extends controller
{
    public function index()
    {
        $this->sessionManager->teacherLogged();
        $teacherData = $this->model("teacher","infoModels")->getTeacherData(
            $_SESSION['teacher']['teacher_id']
        );
        $corporationData = $this->model('teacher',"infoModels")->getCorporationData($teacherData['corporation_id']);
        $this->render("teacher/main/header");
        $this->render("teacher/main/sidebar");
        $this->render("teacher/detail/index",['teacherData' => $teacherData,"corporationData" => $corporationData]);
        $this->render("teacher/main/footer");
    }

    public function updatePassword()
    {
        $this->sessionManager->teacherLogged();
        if (!isset($_POST['updatePassword'])) {
            helper::redirect(SITE_URL."/teacher");
            exit;
        }

        if (helper::cleaner($_POST['password']) == "") {
            $password = $_SESSION['teacher']['password'];
        }
        else {
            $password = sha1(md5(helper::cleaner($_POST['password'])));
        }

        $update = $this->model("teacher","detailModels")->update($password,$_SESSION['teacher']['teacher_id']);

        if ($update == false) {
            helper::flashData("stats","Şifre güncelleme işlemi gerçekleştirilemedi");
            helper::redirect(SITE_URL."/teacher/detail");
            exit;
        }

        $_SESSION['teacher']['password'] = $password;
        helper::flashData("stats","Şifre güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL."/teacher/detail");
        exit;
    }
}