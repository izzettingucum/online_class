<?php  

class studentModels extends model
{
    public function listView()
    {
        $query = $this->db->prepare("SELECT * FROM students order by corporation_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $query = $this->db->prepare("SELECT * FROM students where id = ?");
        $query->execute([$id]);
        if ($query->rowCount() != 0) {
             return $query->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE FROM students where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}