<?php
require_once("DB_connect.php");
class delete
{


    public $lab_id;
    public function DeleteLab()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `lab` WHERE `Lab_id`='$this->lab_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $complaint_id;

    public function DeleteComplaint()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `complaint` WHERE `complaint_id`='$this->complaint_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

        public $user_id;
    public function DeleteUser()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `user` WHERE `user_id`='$this->user_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    // public function DeleteComplaintLab()
    // {
    //     $conn = dbconnection();

    //     $sql = "DELETE FROM `lab` WHERE `Lab_id`='$this->lab_id'";
    //     $result = $conn->query($sql);
    //     if ($result === TRUE) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


}
