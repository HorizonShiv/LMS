<?php
session_start();

if (isset($_POST['reg_complaint'])) {

    $cat_no = $_POST['cat_no'];
    $cType = $_POST['cType'];

    $cat_type=$_POST['cat_type'];
    $ip=$_SERVER['REMOTE_ADDR'];

    //Pc number in which error found
    if($_POST['cat_type']==0){
        $err_id = $_POST['err_id'];
    }
    else{
        $err_id = null;
    }


    if ($ip=="::1") {
        $ip="127.0.0.1";
    }

    if ($cType == "hardware" || $cType == "ClsEleP" || $cType == "LibEleP") {
        $complaint_desc = $_POST['complaint_desc1'];
        // $lab_no = $_POST['lab_no1'];
    } elseif ($cType == "software" || $cType == "ClsEnP" || $cType == "LibEnP") {
        $complaint_desc = $_POST['complaint_desc2'];
        // $lab_no = $_POST['lab_no2'];
    } else {
        $complaint_desc = $_POST['complaint_desc3'];
        // $lab_no = $_POST['lab_no2'];
    }




    date_default_timezone_set("Asia/Calcutta");
    $user_id = $_SESSION["student"];
    $complaint_id = date("d") . date("m") . date("H") . date("i") . date("s");
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $status = 0;

    // echo $lab_no . " " . $pc_no . " " . $cType . " " . $complaint_desc . " " . $complaint_id . " " . $user_id . " " . $date . " " . $time;

    echo $user_id."<br>";
    echo $complaint_id."<br>";
    echo $err_id."<br>";
    echo $cat_no."<br>";
    echo $ip."<br>";
    echo $cType."<br>";
    echo $complaint_desc."<br>";
    echo $date."<br>";
    echo $time."<br>";
    echo $cat_type."<br>";
    echo $status."<br>";



    require_once("cls_insert.php");

    $obj = new ComplaintRegi();
    $obj->user_id = $user_id;
    $obj->complaint_id = $complaint_id;
    $obj->err_id = $err_id;
    $obj->cat_no = $cat_no;
    $obj->ip = $ip;
    $obj->complaint_type = $cType;
    $obj->complaint_desc = $complaint_desc;
    $obj->date = $date;
    $obj->time = $time;
    $obj->cat_type = $cat_type;
    $obj->status = $status;
    $result = $obj->RegiComplaint();


    if ($result == true) {
        header('Location:../pages/view_complaints.php?cat_type='.$cat_type);
    } else {
        header('Location:../error/error-400.php');
    }
} 


elseif (isset($_POST['add_student']) || isset($_POST['add_technician'])) {

    require '../vendor/autoload.php';

    $document = $_FILES['document'];

    $fileName = $_FILES['document']['name'];
    $fileTmpname = $_FILES['document']['tmp_name'];
    $fileSize = $_FILES['document']['size'];
    $fileError = $_FILES['document']['error'];
    $fileType = $_FILES['document']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('xlsx');

    // echo "<pre>";
    //     print_r($document);
    //     echo "</pre>";

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $count = 0;
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpname);
                $data = $spreadsheet->getActiveSheet()->toArray();
                foreach ($data as $row) {

                    if ($count > 0) {
                        $user_id = $row['0'];
                        $name = $row['1'];
                        $mobile_no = $row['2'];
                        $password = $user_id;
                        $email = $row['3'];

                            $role = $_GET['role'];
                        

                        
                        require_once("cls_insert.php");
                        $obj = new AddUser();
                        $obj->user_id = $user_id;
                        $obj->password = $password;
                        $obj->name = $name;
                        $obj->mobile_number = $mobile_no;
                        $obj->role = $role;
                        $obj->email = $email;
                        $result = $obj->UserAdd();

                        if ($result == TRUE) {
                            if ($role == 1) {
                                header('Location:../pages/view_technician.php?role=1');
                            } elseif ($_GET['role'] == 2) {
                                header('Location:../pages/view_student.php?role=2');
                            }
                        } 

                    } else {
                        $count++;
                    }
                }
            }
            elseif($fileSize > 1000000){
                echo 'too large';
            }
        }
    } else {
        header('Location:../error/error-400.php');
    }
}


//Insert Lab
elseif (isset($_POST['add_lab'])) {

    $lab_id = $_POST['lab_id'];
    $lab_name = $_POST['lab_name'];


    require_once("cls_insert.php");

    $obj = new AddLab();
    $obj->Lab_id = $lab_id;
    $obj->Lab_name = $lab_name;
    $result = $obj->LabAdd();


    if ($result == true) {
        header('Location:../pages/view_lab.php');
    } else {
        echo "&#128533";
    }
} else {
    header('Location:../error/error-404.php');
}
