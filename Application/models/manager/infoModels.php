<?php 

class infoModels extends model
{
    // Kurum id değerini ve yönetici adını almak için yazılmış bir fonksiyondur.
    public function getManagerData($email,$password)
    {
        $data = $this->db->prepare("SELECT corporation_id,name FROM managers where email = ? and password = ?");
        $data->execute([$email,$password]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    // Kurum adını almak için yazılmış bir fonksiyondur.
    public function getCorporationData($id)
    {
        $data = $this->db->prepare("SELECT name,id FROM corporations where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    // Toplam Öğrenci sayısını almak için yazılmış bir fonksiyondur.
    public function getTotalStudentCount($corporation_id)
    {
        $count = $this->db->prepare("SELECT COUNT(corporation_id) as totalStudentCount from students where corporation_id = ?");
        $count->execute([$corporation_id]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }
    // Toplam Öğretmen sayısını almak için yazılmış bir fonksiyondur.
    public function getTotalTeacherCount($corporation_id)
    {
        $count = $this->db->prepare("SELECT COUNT(corporation_id) as totalTeacherCount from teachers where corporation_id = ?");
        $count->execute([$corporation_id]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }
    // Toplam ders sayısını almak için yazılmış bir fonksiyondur.
    public function getTotalStudiesCount($corporation_id)
    {
        $count = $this->db->prepare("SELECT COUNT(corporation_id) as totalStudiesCount from studies where corporation_id = ?");
        $count->execute([$corporation_id]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }
    // Toplam sınıf sayısını almak için yazılmış bir fonksiyondur.
    public function getTotalClassesCount($corporation_id)
    {
        $count = $this->db->prepare("SELECT COUNT(corporation_id) as totalClassesCount from classes where corporation_id = ?");
        $count->execute([$corporation_id]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }
    //Sınıflara ait olan öğrenci sayılarını almak için yazılmış bir fonksiyondur.
    public function getStudentCount($class_id)
    {
        $count = $this->db->prepare("SELECT COUNT(class_id) as studentCount from students where class_id = ?");
        $count->execute([$class_id]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }
    // Hafta içerisindeki günlerin verisine ulaşabilmek için yazılmış bir fonksiyondur.
    public function daysData()
    {
        $data = $this->db->prepare("SELECT * from days");
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}