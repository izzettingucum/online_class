<?php 

class sessionManager extends model
{   
    static function createSession($name,$array = [])
    {
       foreach ($array as $key => $value) {
         $_SESSION[$name][$key] = helper::cleaner($value);
        }
    }

    static function deleteSession($key) 
    {
        unset($_SESSION[$key]);
    }

    static function allSessionDelete()
    {
        session_destroy();
    }

    public function adminLogged()
    {
        if (!isset($_SESSION['admin'])) {
            helper::redirect(SITE_URL);
        }
    }

    public function managerLogged()
    {
        if (!isset($_SESSION['manager'])) {
            helper::redirect(SITE_URL);
        }
    }

    public function teacherLogged()
    {
        if (!isset($_SESSION['teacher'])) {
            helper::redirect(SITE_URL);
        }
    }
    
    public function studentLogged()
    {
        if (!isset($_SESSION['student'])) {
            helper::redirect(SITE_URL);
        }
    }

    public function getStudentInfo()
    {
        if ($this->studentLogged()) {
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $data = $this->db->prepare("select * from students where email=? and password=?");
            $data->execute([$email,$password]);
            return $data->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function getTeacherInfo()
    {
        if ($this->teacherLogged()) {
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $data = $this->db->prepare("select * from teachers where email=? and password=?");
            $data->execute([$email,$password]);
            return $data->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function getAdminInfo()
    {
        if ($this->adminLogged()) {
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $data = $this->db->prepare("select * from admins where email=? and password=?");
            $data->execute([$email,$password]);
            return $data->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }
}

?>