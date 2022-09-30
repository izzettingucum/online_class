<?php  

class studiesModels extends model
{
    public function getStudiesName($id)
    {
        $data = $this->db->prepare("SELECT name from studies where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getStudiesId($id)
    {
        $data = $this->db->prepare("SELECT studies_id from classes where id = ? ");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
}