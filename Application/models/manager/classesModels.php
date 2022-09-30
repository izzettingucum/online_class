<?php


class classesModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from classes where corporation_id = ? order by id DESC");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $data = $this->db->prepare("SELECT * from classes where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getStudiesID($id)
    {
        $data = $this->db->prepare("SELECT studies_id from classes where id = ?");
        $data->execute([$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllStudies($corporation_id)
    {
        $data = $this->db->prepare("SELECT id,name from studies where corporation_id = ?");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function controlStudies($studies_id, $corporation_id)
    {
        $control = $this->db->prepare("SELECT COUNT(id) as controlStudies from studies where id = ? and corporation_id = ?");
        $control->execute([$studies_id, $corporation_id]);
        $result = $control->fetch(PDO::FETCH_ASSOC);
        if ($result['controlStudies'] == 0) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getStudentCount($class_id)
    {
        $data = $this->db->prepare("SELECT COUNT(class_id) as studentCount from students where class_id = ?");
        $data->execute([$class_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllStudents($class_id)
    {
        $data = $this->db->prepare("SELECT name,id from students where class_id = ? ");
        $data->execute([$class_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($name, $corporation_id, $studies_id, $teachers_id)
    {
        $insert = $this->db->prepare("INSERT INTO classes(name,corporation_id,studies_id,teachers_id) VALUES(?,?,?,?)");
        $insert->execute([$name, $corporation_id, $studies_id, $teachers_id]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name, $studies_id, $id)
    {
        $update = $this->db->prepare("UPDATE classes SET name = ?,studies_id = ? where id = ?");
        $update->execute([$name, $studies_id, $id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($id)
    {
        $delete = $this->db->prepare("DELETE FROM classes where id = ?");
        $delete->execute([$id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}