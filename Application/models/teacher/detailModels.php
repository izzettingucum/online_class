<?php  

class detailModels extends model
{
    public function update($password,$id)
    {
        $update = $this->db->prepare("UPDATE teachers SET password = ? where id = ?");
        $update->execute([$password,$id]);
        if ($update) {
            return true;
        }
        else {
            return false;
        }
    }
}