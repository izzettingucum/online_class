<?php  

class infoModels extends model
{
    public function getTeacherData($id)
    {
        $data = $this->db->prepare("SELECT * from teachers where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function teacherDataByLogin($email,$password)
    {
        $data = $this->db->prepare("SELECT * from teachers where email = ? and password = ?");
        $data->execute([$email,$password]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    public function getCorporationData($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from corporations where id = ?");
        $data->execute([$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
}