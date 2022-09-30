<?php  

class teacherModels extends model
{
    public function listView()
    {
        $query = $this->db->prepare("SELECT * FROM teachers order by id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $query = $this->db->prepare("SELECT * FROM teachers where id = ?");
        $query->execute([$id]);
        if ($query->rowCount() != 0) {
             return $query->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function update($name,$email,$password,$phone,$corporation_id,$id)
    {
        $query = $this->db->prepare("UPDATE teachers SET name = ?,email = ?,password = ?,phone = ?,corporation_id = ? where id = ?");
        $query->execute([$name,$email,$password,$phone,$corporation_id,$id]);
        if ($query) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE FROM teachers where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}