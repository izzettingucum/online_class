<?php  

class studentModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from students where corporation_id = ? order by id DESC");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $data = $this->db->prepare("SELECT * from students where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function allStudentsByClassID($class_id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from students where class_id = ? and corporation_id = ?");
        $data->execute([$class_id,$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($name,$email,$phone,$password,$classes_id,$corporation_id)
    {
        $insert = $this->db->prepare("INSERT INTO students(name,email,phone,password,class_id,corporation_id) VALUES (?,?,?,?,?,?)");
        $insert->execute([$name,$email,$phone,$password,$classes_id,$corporation_id]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name,$email,$phone,$password,$class_id,$corporation_id,$id)
    {
        $update = $this->db->prepare("UPDATE students SET name = ?,email = ?,phone = ?,password = ?,class_id = ?,corporation_id = ? where id = ?");
        $update->execute([$name,$email,$phone,$password,$class_id,$corporation_id,$id]);
        if ($update) {
            return true;
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