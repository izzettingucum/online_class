<?php  

class classesModels extends model
{
    public function getClassData($id)
    {
        $data = $this->db->prepare("SELECT id,name from classes where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function classControl($id,$corporation_id)
    {
        $control = $this->db->prepare("SELECT COUNT(*) as classControl from classes where id = ? and corporation_id = ?");
        $control->execute([$id,$corporation_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
        
    }

    public function getStudentsName($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT name from students where class_id = ? and corporation_id = ?");
        $data->execute([$id,$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentCount($class_id)
    {
        $data = $this->db->prepare("SELECT COUNT(*) as studentCount from students where class_id = ?");
        $data->execute([$class_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
}