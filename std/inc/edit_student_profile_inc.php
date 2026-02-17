<?php
session_start();
include('conn.php');
 
  $student_id = $_POST['student_id'];
  $student_name = $_POST['name'];
  $name_bangla = $_POST['name_bangla'];
  $year = $_POST['year'];
  $group = $_POST['group'];
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
  move_uploaded_file($post_tmp_n,'../image/'.$new_post_image);
  $ssc_gpa = $_POST['ssc_gpa'];
  $subject1=$_POST['subject1'];
  $subject2=$_POST['subject2'];
  $subject3=$_POST['subject3'];
  $subject4=$_POST['fourth_sub'];

  
   
  

  $student_group = 'student_info_' . $group;
  
  //$student_group = 'student_info_business';
  
  
  //echo $new_post_image;

 
   echo $subject1; 
   echo $student_name;
   echo $student_id.'__';
   echo $student_group;
   echo '__'.$subject4.'__';
   if($subject1==$subject2 || $subject1==$subject3 || $subject1==$subject4 || $subject2==$subject3 || $subject2==$subject4 || $subject3==$subject4){
    header('location:../edit_student_profile.php?group='.$group.'&student_id='.$student_id.'&table='. $student_group);
   }
   else{

    mysqli_query($conn,"UPDATE `$student_group` SET `student_name`='$student_name',`name_bangla`='$name_bangla',`year`='$year',`student_group`='$group',`fathers_name`='$fathers_name',`mothers_name`='$mothers_name',`date_of_birth`='$birth_date',`present_address`='$present_address',`permanent_address`='$permanent_address',`phone_no`='$phone',`gaurdian_phone_no`='$g_phone',`blood_group`='$blood',`image`='$new_post_image',`ssc_gpa`='$ssc_gpa',`subject1`='$subject1',`subject2`='$subject2',`subject3`='$subject3', `fourth_sub`='$subject4' WHERE student_id='$student_id'");
   
    echo  $student_name;
    echo $new_post_image;
    header('location:../student_profile.php?test=0');


   }


    



?>