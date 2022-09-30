<?php  

class classesModels extends model
{
    public function listView()
    {
        $query = $this->db->prepare("SELECT * FROM classes order by corporation_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $query = $this->db->prepare("SELECT * FROM classes where id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getStudentCount($class_id)
    {
        $query = $this->db->prepare("SELECT * FROM students where class_id = ?");
        $query->execute([$class_id]);
        return count($query->fetchAll(PDO::FETCH_ASSOC));
    }

    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE from classes where id = '$id'");
        $delete->execute();
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}