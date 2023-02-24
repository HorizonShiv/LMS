<?php
require_once("DB_connect.php");
class update
{
    public $complaint_id;
    public $status;
    public function ComplaintStatus()
    {
        $conn = dbconnection();

        $sql = "UPDATE `complaint` SET `status`='$this->status' WHERE `complaint_id`='$this->complaint_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $old_pw;
    public $new_pw;
    public function ChangePassword()
    {
        $conn = dbconnection();

        $sql = "UPDATE `user` SET `password`='$this->new_pw' WHERE `password`='$this->old_pw'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $user_id;
    public $user_status;
    public function UserStatus()
    {
        $conn = dbconnection();

        $sql = "UPDATE `user` SET `user_status`='$this->user_status' WHERE `user_id`='$this->user_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    
}
