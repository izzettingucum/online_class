<?php  

class examsModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from exams where corporation_id = ?");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExamData($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from exams where id = ? and corporation_id = ?");
        $data->execute([$id,$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function examControl($id,$corporation_id)
    {
        $control = $this->db->prepare("SELECT COUNT(*) as examControl from exams where id = ? and corporation_id = ?");
        $control->execute([$id,$corporation_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function getExamsByClassID($class_id)
    {
        $data = $this->db->prepare("SELECT * from exams where class_id = ?");
        $data->execute([$class_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($name,$corporation_id,$class_id,$studies_id,$exam_date,$start,$finish)
    {
        $insert = $this->db->prepare("INSERT INTO exams(name,corporation_id,class_id,studies_id,date,start,finish) values(?,?,?,?,?,?,?)");
        $insert->execute([$name,$corporation_id,$class_id,$studies_id,$exam_date,$start,$finish]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($name,$class_id,$studies_id,$exam_date,$start,$finish,$id)
    {
        $update = $this->db->prepare("UPDATE exams SET name = ?,class_id = ?,studies_id = ?,date = ?,start = ?,finish = ? where id = ?");
        $update->execute([$name,$class_id,$studies_id,$exam_date,$start,$finish,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deleteExam($id,$corporation_id)
    {
        $delete = $this->db->prepare("DELETE FROM exams where id = ?,corporation_id = ?");
        $delete->execute($id,$corporation_id);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}