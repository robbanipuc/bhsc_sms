
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';?>
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
                <div><u>Exam Results</u></div>
            <form action="exam_result_process.php" method="POST">
                   
                    <div class="form_row">
                    <label for="exam_name">Exam Name</label>
                        <select id="exam_name" name="exam_name">
                            <option value="1st_year_1st_term">1st Year 1st Term</option>
                            <option value="1st_year_2nd_term">1st Year 2nd Term</option>
                            <option value="1st_year_final">1st Year Final</option>
                            <option value="pre_test">Pre Test</option>
                            <option value="test">Test</option>
                        </select>
                    </div>
                    <div class="form_row">
                    <label for="academic_year">Academic Year</label>
                        <select id="academic_year" name="academic_year">
                            <option value="2021-2022">2021-2022</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                          <option value="2026-2027">2026-2027</option>
                          <option value="2027-2028">2027-2028</option>
                          <option value="2028-2029">2028-2029</option>
                          <option value="2029-2030">2029-2030</option>
                        </select>
                    </div>
                    <div class="form_row">
                    <label for="group">Group</label>
                        <select id="group" name="group">
                            <option value="science">Science</option>
                            <option value="business">Business Studies</option>
                            <option value="humanities">Humanities</option>
                        </select>
                    </div>
                    
                    <br><br>
                    <input type="submit" value="See Result" style="width:80px; height:30px; margin-left:150px;">
                   


                    
                </form>

</br></br></br></br>


                <div><u>Student Result Register</u></div>

                <form action="result_register_2.php" method="GET" target="_blank">
                   
                    <div class="form_row">
                    <label for="academic_year">Academic Year</label>
                        <select id="academic_year" name="academic_year">
                            <option value="2021-2022">2021-2022</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                          <option value="2026-2027">2026-2027</option>
                          <option value="2027-2028">2027-2028</option>
                          <option value="2028-2029">2028-2029</option>
                          <option value="2029-2030">2029-2030</option>
                        </select>
                    </div>
                    <div class="form_row">
                    <label for="group">Group</label>
                        <select id="group" name="group">
                            <option value="science">Science</option>
                            <option value="business">Business Studies</option>
                            <option value="humanities">Humanities</option>
                        </select>
                    </div>
                    
                    <br><br>
                    <input type="submit" value="See Result" style="width:80px; height:30px; margin-left:150px;">
                   


                    
                </form>
            </div>

            

         
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
