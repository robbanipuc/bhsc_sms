
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
    session_start();

?>
       <span class="panel_name">Admin Panel</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="student_registration.php?group=select">Student Registration</a></li>
                <li><a class="menu" href="student_profile.php?test=0">Student Profile</a></li>
                <li><a class="menu" href="put_marks_select_admin.php">Put Marks</a></li>
                <li><a class="menu" href="exam_results.php">Exam Results</a></li>
                <li><a class="menu" href="add_teacher.php">Add Teacher</a></li>
                <li><a class="menu" href="mentors.php">Mentors</a></li>
              </ul>
            </div>

            <div class="content">
              
                <form action="student_profile.php?test=10 " method="POST">
                        <div class="form_row inline_form">
                        <label for="group">Group</label>
                            <select id="group" name="group">
                                <option value="science">Science</option>
                                <option value="business">Business Studies</option>
                                <option value="humanities">Humanities</option>
                            </select>
                        </div>
                        <div class="form_row inline_form">
                        <label for="group">Academic Year</label>
                            <select id="year" name="year">
                                <option value="2021-2022">2021-2022</option>
                                <option value="2022-2023">2022-2023 </option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2024-2025">2024-2025</option>
                                <option value="2025-2026">2025-2026</option>
                                <option value="2026-2027">2026-2027</option>
                                <option value="2027-2028">2027-2028</option>
                                <option value="2028-2029">2028-2029</option>
                                <option value="2029-2030">2029-2030</option>
                            </select>
                        </div>
                        <div class="form_row inline_form">
                            <input type="submit" value="Search">
                        </div>
                    </form>

                <?php 
                    if($_GET['test']==0){
                        
                       

                        

                    }elseif($_GET['test']==10){
                        $_SESSION["group"] = $_POST['group'];
                        $group = $_SESSION["group"];
                        $_SESSION["year"] = $_POST['year'];
                        $year = $_SESSION["year"];
                        $_SESSION["table_name"] = 'student_info_' . $group;
                        $table_name =  $_SESSION["table_name"];
                        include('conn.php');
                            $student_info = mysqli_query($conn,"SELECT * FROM $_SESSION[table_name] WHERE year='$_SESSION[year]'");
                            // $student_info = "this is texttt";
                                echo '<table class="studenttable">
                                <tr>
                                <th>Student ID</th><th>Student Name</th><th>Group</th>
                                </tr>'; 
                            while($table_content = mysqli_fetch_array($student_info)):
                                $student_id = $table_content['student_id'];
                                $student_name = $table_content['student_name'];
                                
                            echo "<tr><td>";  echo $student_id; echo "</td> <td>";echo $student_name;echo "</td> <td>";echo $group; echo '</td> <td><a href="profile_detail_student.php?student_id='; echo $student_id; echo '&group='; echo $group; echo '" target="_blank">Details</a></td> </tr>' ;
                                
                                
                            
                            
                            endwhile;
                        echo "</table>"; 
                       

                    }elseif($_GET['test']==20){
                        include('conn.php');
                        $group = $_SESSION["group"];
                        $year = $_SESSION["year"];
                        $table_name =  $_SESSION["table_name"];
                        $student_info = mysqli_query($conn,"SELECT * FROM $table_name WHERE year='$year'");
                        // $student_info = "this is texttt";
                            echo '<table class="studenttable">
                            <tr>
                            <th>Student ID</th><th>Student Name</th>
                            </tr>'; 
                        while($table_content = mysqli_fetch_array($student_info)):
                            $student_id = $table_content['student_id'];
                            $student_name = $table_content['student_name'];
                            
                        echo "<tr><td>";  echo $student_id; echo "</td> <td>";echo $student_name; echo '</td> <td><a href="profile_detail_student.php?student_id='; echo $student_id; echo '&group='; echo $group; echo '">Details</a></td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table>"; 
                   

                    }
                ?>
                   
                   
            </div>

            
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
