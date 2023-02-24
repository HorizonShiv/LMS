<?php
require_once("DB_connect.php");

// Complaint Registration
class ComplaintRegi
{
    public $user_id;
    public $complaint_id;
    public $err_id;
    public $cat_no;
    public $complaint_type;
    public $complaint_desc;
    public $date;
    public $time;
    public $status;
    public $ip;
    public $cat_type;
    public function RegiComplaint()
    {
        $conn = dbconnection();
        $sql = "INSERT INTO `complaint`(`complaint_id`, `user_id`, `err_id`, `cat_no`,`ip`, `complaint_type`, `complaint_desc`, `date`, `time`, `cat_type`, `status`) VALUES ('$this->complaint_id','$this->user_id','$this->err_id','$this->cat_no','$this->ip','$this->complaint_type','$this->complaint_desc','$this->date','$this->time','$this->cat_type','$this->status')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

// Adding user (Student & Technician by roleID)
class AddUser
{
    public $user_id;
    public $password;
    public $name;
    public $mobile_number;
    public $role;
    public $email;
    public function UserAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `user`(`user_id`, `password`, `name`, `mobile_number`, `role`, `email`) VALUES ('$this->user_id','$this->password','$this->name','$this->mobile_number','$this->role','$this->email')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

// Adding user (Student & Technician by roleID)
class AddLab
{
    public $Lab_id;
    public $Lab_name;
    public function LabAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `lab`(`Lab_id`, `Lab_name`) VALUES ('$this->Lab_id','$this->Lab_name')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
