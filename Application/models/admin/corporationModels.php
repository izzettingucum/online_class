<?php 

class corporationModels extends model
{
    public function listView()
    {
        $data = $this->db->prepare("SELECT * from corporations order by id DESC");
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($name)
    {
        $insert = $this->db->prepare("INSERT INTO corporations(name) VALUES(?)");
        $insert->execute([$name]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getData($id)
    {
        $data = $this->db->prepare("SELECT * from corporations where id = ?");
        $data->execute([$id]);
        if ($data->rowCount() != 0) {
            return $data->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }

    public function update($name,$id)
    {
        $update = $this->db->prepare("UPDATE corporations SET name = ? where id = ?");
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
        $delete = $this->db->prepare("DELETE from corporations where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}