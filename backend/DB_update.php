<?php
session_start();
require_once("cls_update.php");

if (isset($_POST['change_status'])) {

    $status = $_POST['status'];

    $obj = new update();
    $obj->complaint_id = $_SESSION['complaint_id'];
    $obj->status = $status;

    $result = $obj->ComplaintStatus();


    if ($result == true) {
        unset($_SESSION['complaint_id']);
        header('Location:../pages/view_complaints.php');
    } else {
        header('Location:../error/error-500.php');
    }
}

//change_password
elseif (isset($_POST['change_password'])) {

    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $rnew_pw = $_POST['rnew_pw'];

    if ($new_pw == $rnew_pw) {

        $obj = new update();
        $obj->old_pw = $old_pw;
        $obj->new_pw = $new_pw;
        $result = $obj->ChangePassword();


        if ($result == true) {
            header('Location:../pages/index.php');
        } else {
            header('Location:../error/error-400.php');
        }
    }
    else {
        header('Location:../error/error-400.php');
    }

} 


//user status
elseif (isset($_GET['inactive_user_id']) || isset($_GET['active_user_id'])) {

    if(isset($_GET['inactive_user_id'])){
        $user_id = $_GET['inactive_user_id'];
        $user_status=0;
    }
    elseif(isset($_GET['active_user_id'])){
        $user_id = $_GET['active_user_id'];
        $user_status=1;
    }
        

    $obj = new update();
    $obj->user_id = $user_id;
    $obj->user_status = $user_status;

    $result = $obj->UserStatus();


    if ($result == true) {
        if($_GET['role']==1){
            header('Location:../pages/view_technician.php?role=1');
        }
        elseif($_GET['role']==2){
            header('Location:../pages/view_student.php?role=2');
        }
        else{
            header('Location:../pages/inactive_user.php');
        }
    } else {
        header('Location:../error/error-500.php');
    }

} 

else {
    header('Location:../error/error-404.php');
}
