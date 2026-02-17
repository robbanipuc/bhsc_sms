<?php
session_start();
include('conn.php');
//$student_id = $_SESSION["student_id"];
$table_name = $_SESSION["table_name"];
$student_id = $_SESSION["student_id"];

echo $_SESSION["table_name"];
echo $_SESSION["student_id"];

mysqli_query($conn,"DELETE FROM `$table_name` WHERE student_id='$student_id'");

header('location:../student_profile.php?test=20');

?>