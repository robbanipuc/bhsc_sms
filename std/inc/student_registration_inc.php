<?php
session_start();
include('conn.php');
 
  $student_id = $_POST['student_id'];
  $student_name = $_POST['name'];
  $name_bangla = $_POST['name_bangla'];
  $year = $_POST['year'];
  $group = $_SESSION['group'];
  $fathers_name = $_POST['fathers_name'];
  $mothers_name = $_POST['mothers_name'];
  $birth_date = $_POST['birth_date'];
  $present_address = $_POST['present_address'];
  $permanent_address = $_POST['permanent_address'];
  $phone = $_POST['phone'];
  $g_phone = $_POST['g_phone'];
  $blood = $_POST['blood'];

  $post_image = $_FILES['image']['name'];
  $post_tmp_n = $_FILES['image']['tmp_name'];
  $fileType = pathinfo($post_image, PATHINFO_EXTENSION); 
  $new_post_image = $student_id .'.'. $fileType;
  $destination = '../image/'.$new_post_image;
  move_uploaded_file($post_tmp_n,$destination);
  $ssc_gpa = $_POST['ssc_gpa'];

  
   $subject1='ct_mark_'.$_POST['subject1'].'_'.$group;
   $subject2='ct_mark_'.$_POST['subject2'].'_'.$group;
   $subject3='ct_mark_'.$_POST['subject3'].'_'.$group;
   $subject4='ct_mark_'.$_POST['4th_subject'].'_'.$group;
   $fourth_sub = $_POST['4th_subject'];
   $bangla='ct_mark_bangla_'.$group;
   $english='ct_mark_english_'.$group;
   $ict='ct_mark_ict_'.$group;
   $first_year_first_term='1st_year_1st_term_'.$group;
   $first_year_second_term='1st_year_2nd_term_'.$group;
   $first_year_final='1st_year_final_'.$group;
   $pre_test='pre_test_'.$group;
   $test='test_'.$group;




  $student_group = 'student_info_' . $group;
  
  //$student_group = 'student_info_business';
  
  echo $post_tmp_n; echo '  ';
 echo $post_image; echo '  ';
 echo $destination; 
 echo $subject1; echo '<br>';
 echo $subject2; echo '<br>';
 echo $subject3; echo '<br>';
 echo $subject4; echo '<br>';
echo $bangla;
echo $english;
echo $ict;


$user= "SELECT * FROM  $student_group WHERE student_id='$student_id'";
$result  = mysqli_query($conn, $user);
$num = mysqli_num_rows($result);
 if($num=='1'){
  header('location:../student_registration.php?group='.$group.'&register=registered');
 }

 if($subject1==$subject2 || $subject1==$subject3 || $subject1==$subject4 || $subject2==$subject3 || $subject2==$subject4 || $subject3==$subject4){
  header('location:../student_registration.php?group='.$group);
 }


 else{
  mysqli_query($conn,"INSERT INTO `$student_group` (student_id, `student_name`,`name_bangla`,`year`,`student_group`, `fathers_name`, `mothers_name`, `date_of_birth`, `present_address`, `permanent_address`, `phone_no`, `gaurdian_phone_no`, `blood_group`, `image`,`ssc_gpa`,`subject1`,`subject2`,`subject3`, `fourth_sub`) VALUES ('$student_id', '$student_name ','$name_bangla','$year','$group','$fathers_name', '$mothers_name', '$birth_date', '$present_address','$permanent_address', ' $phone', '$g_phone', '$blood',  '$new_post_image','$ssc_gpa', '$_POST[subject1]','$_POST[subject2]','$_POST[subject3]','$fourth_sub')");

    
  mysqli_query($conn,"INSERT INTO `$subject1` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$subject2` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$subject3` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$subject4` (student_id) VALUES ('$student_id')");

  mysqli_query($conn,"INSERT INTO `$bangla` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$english` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$ict` (student_id) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$first_year_first_term` (`Student ID`) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$first_year_second_term` (`Student ID`) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$first_year_final` (`Student ID`) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$pre_test` (`Student ID`) VALUES ('$student_id')");
  mysqli_query($conn,"INSERT INTO `$test` (`Student ID`) VALUES ('$student_id')");

  echo  $student_group;
  
  
 }
   
   header('location:../student_registration.php?group=select');
    



?>