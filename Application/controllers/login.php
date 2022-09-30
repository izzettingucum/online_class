<?php  

class login extends controller
{
    public function index()
    {
        $this->render("login/login");
    }

    public function student()
    {
        if (isset($_SESSION['student'])) {
            helper::redirect(SITE_URL."/student");
        }
        $this->render("login/studentsLogin");
    }

    public function teacher()
    {
        if (isset($_SESSION['teacher'])){
            helper::redirect(SITE_URL."/teacher");
        }
        $this->render("login/teachersLogin");
    }

    public function manager()
    {
        if (isset($_SESSION['manager'])){
            helper::redirect(SITE_URL."/manager");
        }
        $this->render("login/managersLogin");
    }


    public function admin()
    {
        if (isset($_SESSION['admin'])){
            helper::redirect(SITE_URL."/admin");
        }
        $this->render("login/adminsLogin");
    }

    public function adminLogin()
    {
        if (isset($_SESION['admin'])) {
            helper::redirect(SITE_URL."/admin");
        }

        if (!isset($_POST)) {
            helper::redirect(SITE_URL."/login/admin");
        }

        if ($_POST['email'] == "" || $_POST['password'] == "") {
            helper::flashData("stats","Email ve şifre bölümü boş bırakılamaz");
            helper::redirect(SITE_URL."/login/admin");
        }

        $email = helper::cleaner($_POST['email']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));
        $controlAdmin = $this->model("login","loginModels")->adminControl($email,$password);
        if ($controlAdmin == 0) {
            helper::flashData("stats","Lütfen bilgilerinizi kontrol edip tekrar deneyiniz");
            helper::redirect(SITE_URL."/login/admin");
        }
        else {
            sessionManager::createSession("admin",["email" => $email,"password" => $password]);
            helper::redirect(SITE_URL."/admin");
        }
    }

    public function managerLogin()
    {
        
        if (isset($_SESSION['manager'])) {
            helper::redirect(SITE_URL."/manager");
        }

        if (!isset($_POST)) {
            helper::redirect(SITE_URL."/login/manager");
        }

        if ($_POST['email'] == "" or $_POST['password'] == "") {
            helper::flashData("stats","Email ve şifre bölümü boş bırakılamaz");
            helper::redirect(SITE_URL."/login/manager");
            exit;
        }

        $email = helper::cleaner($_POST['email']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));
        $controlmanager = $this->model("login","loginModels")->managerControl($email,$password);

        if ($controlmanager == 0) {
            helper::flashData("stats","Lütfen bilgilerinizi kontrol edip tekrar deneyiniz");
            helper::redirect(SITE_URL."/login/manager");
        }

            $managerData = $this->model("manager","infoModels")->getManagerData($email,$password);
            $managerName = $managerData['name'];
            $corporationRow = $this->model("manager","infoModels")->getCorporationData($managerData['corporation_id']);
            $corporationName = $corporationRow['name'];
            $corporation_id = $corporationRow['id'];
            sessionManager::createSession("manager",[
                "email" => $email,
                "password" => $password,
                "name" => $managerName,
                "corporationName" => $corporationName,
                "corporation_id" => $corporation_id
            ]);
            helper::redirect(SITE_URL."/manager");
        
    }   
    
    public function teacherLogin()
    {
        if (isset($_SESION['teacher'])) {
            helper::redirect(SITE_URL);
            exit;
        }

        if (!isset($_POST)) {
            helper::redirect(SITE_URL."/login/teacher");
            exit;
        }

        $email = helper::cleaner($_POST['email']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));

        if ($_POST['email'] == "" || $_POST['password'] == "") {
            helper::flashData("stats","Email veya şifre bölümü boş bırakılamaz");
            helper::redirect(SITE_URL."/login/teacher");
            exit;
        }

        $controlTeacher = $this->model("login","loginModels")->teacherControl($email,$password);

        if ($controlTeacher == 0) {
            helper::flashData("stats","Lütfen bilgilerinizi kontrol edip tekrar deneyiniz");
            helper::redirect(SITE_URL."/login/teacher");
            exit;
        }

        $teacherData = $this->model("teacher","infoModels")->teacherDataByLogin($email,$password);
        $corporationData = $this->model("teacher","infoModels")->getCorporationData($teacherData['corporation_id']);

        sessionManager::createSession("teacher",[
            "email" => $email,
            "password" => $password,
            "name" => $teacherData['name'],
            "teacher_id" => $teacherData['id'],
            "corporation_name" => $corporationData['name'],
            "corporation_id" => $corporationData['id']
        ]);
            helper::redirect(SITE_URL."/teacher");
    }

    public function studentLogin()
    {
        if ($this->sessionManager->studentLogged()) {
            helper::redirect(SITE_URL."/student");
        }

        if (!isset($_POST)) {
            helper::redirect(SITE_URL."/login/student");
        }

        if ($_POST['email'] == "" || $_POST['password'] == "") {
            helper::flashData("stats","Email ve şifre bölümü boş bırakılamaz");
            helper::redirect(SITE_URL."/login/student");
        }

        $email = helper::cleaner($_POST['email']);
        $password = sha1(md5(helper::cleaner($_POST['password'])));

        $controlStudent = $this->model("login","loginModels")->studentControl($email,$password);
        
        if ($controlStudent['studentControl'] == 0) {
            helper::flashData("stats","Lütfen bilgilerinizi kontrol edip tekrar deneyiniz");
            helper::redirect(SITE_URL."/login/student");
            exit;
        }

        $studentData = $this->model("student","infoModels")->studentDataByLogin($email,$password);
        $corporationData = $this->model("student","infoModels")->getCorporationData($studentData['corporation_id']);
        $classData = $this->model("student","infoModels")->getClassData($studentData['class_id'],$corporationData['id']);

        sessionManager::createSession("student",[
            "email" => $email,
            "password" => $password,
            "name" => $studentData['name'],
            "student_id" => $studentData['id'],
            "class_id" => $classData['id'],
            "class_name" => $classData['name'],
            "corporation_id" => $corporationData['id'],
            "corporation_name" => $corporationData['name']
        ]);
        helper::redirect(SITE_URL."/student");
        exit;
    }
}