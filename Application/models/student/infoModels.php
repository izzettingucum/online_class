<?php  

class infoModels extends model
{
    public function studentDataByLogin($email,$password)
    {
        $data = $this->db->prepare("SELECT * from students where email = ? and password = ?");
        $data->execute([$email,$password]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getCorporationData($id)
    {
        $data = $this->db->prepare("SELECT * from corporations where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getClassData($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from classes where id = ? and corporation_id = ?");
        $data->execute([$id,$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
}