

<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
include('conn.php');
session_start();



?>

      
     <div class="main-body">
              
            <div class="sidebar">
              <?php
            
               
                echo '
                <ul class="main_menu"> 
                <li><a class="menu" href="student_registration.php?group=select">Student Registration</a></li>
                <li><a class="menu" href="student_profile.php?test=0">Student Profile</a></li>
                <li><a class="menu" href="put_marks_select_admin.php">Put Marks</a></li>
                <li><a class="menu" href="exam_results.php">Exam Results</a></li>
                <li><a class="menu" href="add_teacher.php">Add Teacher</a></li>
                <li><a class="menu" href="mentors.php">Mentors</a></li>
              </ul>
                ';

               

              ?>
             
            </div>

            <div class="content">
                
                <?php
                    include('conn.php');
                    $exam_name = $_POST['exam_name'];
                    $year = $_POST['year'];
                    $group = $_POST['group'];

                    $exam_mark_table=$exam_name.'_'.$group;
                    $student_table='student_info_'.$group;
                    echo $exam_mark_table;
                     echo '
                     <form action="inc/attendance_inc.php?exam_name='.$exam_name.'&year='.$year.'&group='.$group.'" method="POST">
                     Total Attendance: <input type="text" name="total_att" style="width:100px;"><br><br>
                     <table>
                     <tr><th>Student ID</th><th>Attendance</th></tr>';
                     $att= mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");
                     //echo $table_content['number'];


                     while($table_content = mysqli_fetch_array($att)):
                         $student_id = $table_content['Student ID'];
                         $attendance=$table_content['attendance'];
                         $attendance=$attendance%100;
                         echo '<tr><td>'.$student_id.'</td><td><input type="text" name="'.$student_id.'" value="'.$attendance.'"></td></tr>';


                     endwhile; 
              
              
            
            
             
             echo '</table>
               <input type="submit" value="submit">
             </form>';

                ?>
     
                   
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>

