
<?php

session_start();
include('conn.php');
$exam_name = $_GET['exam_name'];
$year = $_GET['year'];
$group = $_GET['group'];
$total_att=$_POST['total_att'];

$exam_mark_table=$exam_name.'_'.$group;
$student_table='student_info_'.$group;

$att= mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");
                     //echo $table_content['number'];


                     while($table_content = mysqli_fetch_array($att)):
                        $student_id = $table_content['Student ID'];
                        $std_att=$_POST[$student_id];
                        $attendance=$total_att*100+$std_att;

                        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `attendance`='$attendance' WHERE `Student ID`=$student_id");


                     endwhile; 
                    // echo $total_att;
                    header('location:../admin.php');