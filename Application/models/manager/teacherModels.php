<?php  

class teacherModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from teachers where corporation_id = ?");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $data = $this->db->prepare("SELECT * from teachers where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function controlTeacherId($id)
    {
        $data = $this->db->prepare("SELECT COUNT(id) as teacherControl from teachers where id = ?");
        $data->execute([$id]);
        $control = $data->fetch(PDO::FETCH_ASSOC);
        if ($control['teacherControl'] != 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function controlTeacherEmail($email)
    {
        $data = $this->db->prepare("SELECT COUNT(id) as teacherControl from teachers where email = ?");
        $data->execute([$email]);
        $control = $data->fetch(PDO::FETCH_ASSOC);
        if ($control['teacherControl'] == 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function controlEmailCount($email,$id)
    {
        $data = $this->db->prepare("SELECT COUNT(id) as emailCount from teachers where id <> '$id' and email = '$email'");
        $data->execute();
        $control = $data->fetch(PDO::FETCH_ASSOC);
        return $control['emailCount'];
    }

    public function insert($name,$email,$phone,$password,$studies_id,$class_id,$corporation_id)
    {
        $insert = $this->db->prepare("INSERT INTO teachers(name,email,phone,password,studies_id,class_id,corporation_id) values(?,?,?,?,?,?,?)");
        $insert->execute([$name,$email,$phone,$password,$studies_id,$class_id,$corporation_id]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name,$email,$phone,$password,$studies_id,$class_id,$id)
    {
        $update = $this->db->prepare("UPDATE teachers SET name = ?,email = ?,phone = ?,password = ?,studies_id = ?,class_id = ? where id = ?"); 
        $update->execute([$name,$email,$phone,$password,$studies_id,$class_id,$id]);  
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function allTeachersByClassID($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from teachers where id = '$id' and corporation_id = '$corporation_id'");
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
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