<?php

session_start();
include('conn.php');
$name = $_POST['subject_name'];
$password = $_POST['password'];
$_SESSION['login']='teacher';

$user= "SELECT * FROM  user_subject WHERE Subject_Name='$name' && Pass_word= '$password'";
$result  = mysqli_query($conn, $user);
$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['subject'] = $name;
    $_SESSION['login_from']='teacher_login';
    header('location:teacher.php');
}else{
    header('location:teacher_login.php');
}

?>