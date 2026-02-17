
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
session_start();
$subject = $_SESSION['subject'];
?>
       <span class="panel_name">Teacher Panel[<?php echo $_SESSION['subject'];?>]</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="assigned_students.php">Assigned Students</a></li>
                <li><a class="menu" href="put_marks.php">Put Marks</a></li>
                <li><a class="menu" href="see_marks.php">See Marks</a></li>
              </ul>
            </div>

            <div class="content">
                <h1>Put Class Test Marks</h1>
                <?php
                     include('conn.php');
                     $ct_mark=$_SESSION["ct_mark"];
                     $col_name=$_SESSION["col_name"];
                     echo $ct_mark;
                     $ct_mark_info = mysqli_query($conn,"SELECT * FROM `$ct_mark`");
                     echo ' <form action="inc/put_marks_into_inc.php" method="POST"">';
                    //echo $ct_mark_info;
                       echo '<table>
                              <th><td>Student ID</td><td>Marks Obtained</td></th>';
                    while($table_content = mysqli_fetch_array($ct_mark_info)):
                        $student_id = $table_content['Student_ID'];
                       // $mark = $table_content[$col_name];
                        $st_roll="roll_".$student_id;
                        echo $st_roll;
                       // $_SESSION[$st_roll]=$st_roll."marks";
                        echo '<tr><td>'; echo $student_id; echo '</td><td>'; echo '<div class="form_row"> <input type="text" name="'; echo $st_roll; echo '" value='; echo ''; echo '></div>'; echo '</td></tr>';
                        //echo $student_id;
                       // echo $mark; echo "<br>";
                    endwhile;

                    echo '</table>';
                    echo '<input type="submit" value="Submit">';
                    echo '</form>';
                ?>
     
                   
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
