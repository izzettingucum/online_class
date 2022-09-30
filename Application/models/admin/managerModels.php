<?php  

class managerModels extends model
{
    public function listView()
    {
        $query = $this->db->prepare("SELECT * FROM managers order by corporation_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $query = $this->db->prepare("SELECT * FROM managers where id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($name,$email,$password,$phone,$corporation_id)
    {
        $insert = $this->db->prepare("INSERT into managers(name,email,password,phone,corporation_id) values (?,?,?,?,?)");
        $insert->execute([$name,$email,$password,$phone,$corporation_id]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name,$email,$password,$phone,$corporation_id,$id)
    {
        $update = $this->db->prepare("UPDATE managers SET name = ?,email = ?,password = ?,phone = ?,corporation_id = ? where id = ?");
        $update->execute([$name,$email,$password,$phone,$corporation_id,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE from managers where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }

    public function emailControl($email)
    {
        $control = $this->db->prepare("SELECT * FROM managers where email = ?");
        $control->execute([$email]);
        return $control->rowCount();
    }
}