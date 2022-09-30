<?php  

class timetableModels extends model
{
    public function listView($corporation_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where corporation_id = ?");
        $data->execute([$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDataByID($class_id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where id = ? and corporation_id = ?");
        $data->execute([$class_id,$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    public function getTimetableByID($id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where id = ? and corporation_id = ?");
        $data->execute([$id,$corporation_id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTimetableByDay($class_id,$day_id,$corporation_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where day = ? and class_id = ? and corporation_id = ?");
        $data->execute([$day_id,$class_id,$corporation_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listDays()
    {
        $data = $this->db->prepare("SELECT * from days");
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function controlByClassID($class_id)
    {
        $control = $this->db->prepare("SELECT count(*) as control from timetable where class_id = ?");
        $control->execute([$class_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function sameTimeControl($id,$class_id,$day_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where id != '$id' and class_id = '$class_id' and day = '$day_id'");
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function controlByID($id,$corporation_id)
    {
        $control = $this->db->prepare("SELECT count(*) as timetableControl from timetable where id = ? and corporation_id = ?");
        $control->execute([$id,$corporation_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function sameDayControl($day_id)
    {
        $control = $this->db->prepare("SELECT count(*) as sameDayControl from timetable where day = ?");
        $control->execute([$day_id]);
        return $control->fetch(PDO::FETCH_ASSOC);
    }

    public function getSameDayStudies($day_id)
    {
        $data = $this->db->prepare("SELECT * from timetable where day = ?");
        $data->execute([$day_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($class_id,$studies_id,$teacher_id,$corporation_id,$day_id,$startTime,$finishTime)
    {
        $insert = $this->db->prepare("INSERT into timetable(class_id,studies_id,teacher_id,corporation_id,day,start,finish) values(?,?,?,?,?,?,?)");
        $insert->execute([$class_id,$studies_id,$teacher_id,$corporation_id,$day_id,$startTime,$finishTime]);
        if ($insert) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($day_id,$start,$finish,$id)
    {
        $update = $this->db->prepare("UPDATE timetable SET day = ? ,start = ? ,finish = ? where id = ?");
        $update->execute([$day_id,$start,$finish,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($id,$corporation_id)
    {
        $delete = $this->db->prepare("DELETE from timetable where id = ? and corporation_id = ?");
        $delete->execute([$id,$corporation_id]);
        if ($delete) {
            return true;
        }
        else {
            return false;
        }
    }
}