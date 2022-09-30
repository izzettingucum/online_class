<?php

class loginModels extends model
{
    public function adminControl($email,$password)
    {
        $controlAdmin = $this->db->prepare("SELECT * from admins where email = ? and password = ?");
        $controlAdmin->execute([$email,$password]);
        return $controlAdmin->rowCount();
    }
    
    public function managerControl($email,$password)
    {
        $controlManager = $this->db->prepare("SELECT * from managers where email = ? and password = ?");
        $controlManager->execute([$email,$password]);
        return $controlManager->rowCount();
    }

    public function teacherControl($email,$password)
    {
        $data = $this->db->prepare("SELECT count(email) as controlTeacher from teachers where email = ? and password = ?");
        $data->execute([$email,$password]);
        $controlTeacher = $data->fetch(PDO::FETCH_ASSOC);
        return $controlTeacher['controlTeacher'];
    }

    public function studentControl($email,$password)
    {
        $controlStudent = $this->db->prepare("SELECT COUNT(*) as studentControl from students where email = ? and password = ?");
        $controlStudent->execute([$email,$password]);
        return $controlStudent->fetch(PDO::FETCH_ASSOC);
    }
}