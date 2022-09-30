<?php  

class studiesModels extends model
{
    public function listView()
    {
        $query = $this->db->prepare("SELECT * FROM studies order by corporation_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $query = $this->db->prepare("SELECT * FROM studies where id = ?");
        $query->execute([$id]);
        if ($query->rowCount() != 0) {
             return $query->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function update($name,$corporation_id,$id)
    {
        $update = $this->db->prepare("UPDATE studies SET name = ?,corporation_id = ? where id = ?");
        $update->execute([$name,$corporation_id,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE FROM studies where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}