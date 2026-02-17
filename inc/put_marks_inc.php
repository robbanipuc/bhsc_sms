
<?php

session_start();
include('conn.php');
 
  $session= $_POST['session'];
  $_SESSION['year']=$session;
  $exam_name = $_POST['exam_name'];
  $_SESSION['exam_name']=$exam_name;
  $subject = $_SESSION['subject'];
  $subject = str_replace(" ","_",$_SESSION['subject']);
 
  //$ct_mark = 'ct_mark_'.$subject;
  //$_SESSION["ct_mark"] = $ct_mark;
  //echo $ct_mark;
  if($subject=='bangla' || $subject=='english'  || $subject=='ict' || $subject=='economics' ){
    $group = $_POST['group'];
    $_SESSION['group'] = $group;
    $ct_mark = 'ct_mark_'.$subject.'_'.$group;
  echo $ct_mark;
  $_SESSION["ct_mark"] = $ct_mark;
  }
  elseif($subject=='physics' || $subject=='chemistry' || $subject=='math' || $subject=='biology'){
    $group = 'science';
    $_SESSION['group'] = $group;
    $ct_mark = 'ct_mark_'.$subject.'_'.$group;
    $_SESSION["ct_mark"] = $ct_mark;
  }
  elseif($subject=='accounting' || $subject=='business_organization' || $subject=='production_management' || $subject=='economics' || $subject=='finance'){
    $group = 'business';
    $_SESSION['group'] = $group;
    $ct_mark = 'ct_mark_'.$subject.'_'.$group;
    $_SESSION["ct_mark"] = $ct_mark;
  }
  else{
    $group = 'humanities';
    $_SESSION['group'] = $group;
    $ct_mark = 'ct_mark_'.$subject.'_'.$group;
    $_SESSION["ct_mark"] = $ct_mark;
    
  }

  include('conn.php');
  
  $student_info = mysqli_query($conn,"SELECT * FROM `$ct_mark` ");
  $fieldcount=mysqli_num_fields($student_info);
  echo $fieldcount;
 $col_name = 'ct_'.$fieldcount;
 $_SESSION["col_name"] = $col_name;
 echo $col_name;
 // mysqli_query($conn,"ALTER TABLE `$ct_mark` ADD `$col_name` INT(20)");
  
 // $student_info = mysqli_query($conn,"SELECT $col_name FROM ct_mark_bangla_science ");

if($exam_name=='class_test'){
 header('location:../put_marks_into_table.php');
}
else{
  header('location:../put_exam_marks_into_table.php');
}