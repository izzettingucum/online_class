<?php  

class studiesModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from studies where corporation_id = ? order by id DESC");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $data = $this->db->prepare("SELECT * from studies where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }


    public function getByClassID($classID)
    {
        $data = $this->db->prepare("SELECT studies.* FROM studies inner join classes on studies.id like '%' + classes.studies_id%' ");
    }

    public function studiesControl($id)
    {
        $data = $this->db->prepare("SELECT COUNT(id) as studiesControl from studies  where id = ?");
        $data->execute([$id]);
        $control = $data->fetch(PDO::FETCH_ASSOC);
        if ($control != 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function insert($name,$corporation_id)
    {
        $insert = $this->db->prepare("INSERT INTO studies(name,corporation_id) VALUES (?,?)");
        $insert->execute([$name,$corporation_id]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name,$id)
    {
        $update = $this->db->prepare("UPDATE studies SET name = ? where id = ?");
        $update->execute([$name,$id]);
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