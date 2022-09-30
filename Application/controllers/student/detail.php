<?php  

class detail extends controller
{
    public function index()
    {
        $this->sessionManager->studentLogged();
        $studentData = $this->model("student","detailModels")->getStudentData($_SESSION['student']['student_id']);
        $this->render("student/main/header");
        $this->render("student/main/sidebar");
        $this->render("student/detail/index",["studentData" => $studentData]);
        $this->render("student/main/footer");
    }

    public function updatePassword()
    {
        $this->sessionManager->studentLogged();
        if (!isset($_POST['updatePassword'])) {
            helper::redirect(SITE_URL."/student");
            exit;
        }

        if (helper::cleaner($_POST['password']) == "") {
            $password = $_SESSION['student']['password'];
        }
        else {
            $password = sha1(md5(helper::cleaner($_POST['password'])));
        }

        $update = $this->model("student","detailModels")->update($password,$_SESSION['student']['student_id']);

        if ($update == false) {
            helper::flashData("stats","Şifre güncelleme işlemi gerçekleştirilemedi");
            helper::redirect(SITE_URL."/student/detail");
            exit;
        }

        $_SESSION['student']['password'] = $password;
        helper::flashData("stats","Şifre güncelleme işlemi başarıyla gerçekleştirildi.");
        print_r($_SESSION['student']);
        helper::redirect(SITE_URL."/student/detail");
        exit;
    }
}