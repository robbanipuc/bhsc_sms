
<?php

session_start();
include('conn.php');
 
  
  

  $ct_mark=$_SESSION["ct_mark"];
  $col_name=$_SESSION["col_name"];
  echo $ct_mark;

  mysqli_query($conn,"ALTER TABLE `$ct_mark` ADD `$col_name` INT(20)");

  $ct_mark_info = mysqli_query($conn,"SELECT * FROM `$ct_mark`");
 while($table_content = mysqli_fetch_array($ct_mark_info)):
     $student_id = $table_content['Student_ID'];
     //$mark = $table_content[$col_name];
     $st_roll="roll_".$student_id;
     echo $st_roll;
     $mark=$_POST[$st_roll];
    
     mysqli_query($conn,"UPDATE `$ct_mark` SET `$col_name`='$mark' WHERE student_id=$student_id");
 endwhile;
 