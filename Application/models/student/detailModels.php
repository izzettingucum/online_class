<?php  

class detailModels extends model
{
    public function getStudentData($id)
    {
       $data = $this->db->prepare("SELECT * from students where id = ?");
       $data->execute([$id]);
       return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function update($password,$id)
    {
        $update = $this->db->prepare("UPDATE students set password = ? where id = ?");
        $update->execute([$password,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }
}