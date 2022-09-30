<?php  

class gradeModels extends model
{
    public function examGradeControl($class_id,$exam_id,$student_id)
    {
        $control = $this->db->prepare("SELECT count(*) as controlGrade from exam_grade where class_id = ? and exam_id = ? and student_id = ?");
        $control->execute([$class_id,$exam_id,$student_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function examGradeControlByID($id,$corporation_id)
    {
        $control = $this->db->prepare("SELECT count(*) as gradeControl from exam_grade where id = ? and corporation_id = ?");
        $control->execute([$id,$corporation_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllGradeByClassID($exam_id,$class_id)
    {
        $data = $this->db->prepare("SELECT * from exam_grade where exam_id = ? and class_id = ?");
        $data->execute([$exam_id,$class_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGradeByID($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from exam_grade where id = ? and corporation_id = ?");
        $data->execute([$id,$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from exam_grade where corporation_id = ?");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($class_id,$exam_id,$student_id,$grade)
    {
        $insert = $this->db->prepare("INSERT into exam_grade(class_id,exam_id,student_id,grade) values(?,?,?,?)");
        $insert->execute([$class_id,$exam_id,$student_id,$grade]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($grade,$id,$corporation_id)
    {
        $update = $this->db->prepare("UPDATE exam_grade SET grade = ? where id = ? and corporation_id = ?");
        $update->execute([$grade,$id,$corporation_id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deleteAll($exam_id,$class_id)
    {
        $delete = $this->db->prepare("DELETE from exam_grade where exam_id = ? and class_id = ?");
        $delete->execute([$exam_id,$class_id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deleteByID($id,$corporation_id)
    {
        $delete = $this->db->prepare("DELETE from exam_grade where id = ? and corporation_id = ?");
        $delete->execute([$id,$corporation_id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}