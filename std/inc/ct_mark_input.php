<?php

session_start();
include('conn.php');

$ct_mark = $_POST['ct_mark'];
$subject = $_SESSION['subject'];

if(isset($_POST['group'])) {
    $group = $_POST['group'];
    $subject_tab = 'ct_mark_' . $subject . '_' . $group;
    
}else{
    $subject_tab = 'ct_mark_' . $subject;
    
}



mysqli_query($conn,"INSERT INTO $subject_tab(`ct1`) VALUES ($ct_mark);");

echo $subject_tab;

?>