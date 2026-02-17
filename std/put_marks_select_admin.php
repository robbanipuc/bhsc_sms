
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
 

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
             <form action="put_marks_admin.php" method="POST">
                
                  <div class="form_row">
                  <label for="subject">Select Subject</label>
                      <select id="subject" name="subject">
                          <option value="bangla">Bangla</option>
                          <option value="english">English</option>
                          <option value="ict">ICT</option>
                          <option value="physics">Physics</option>
                          <option value="chemistry">Chemistry</option>
                          <option value="biology">Biology</option>
                          <option value="math">Math</option>
                          <option value="accounting">Accounting</option>
                          <option value="business organization">Business Organization</option>
                          <option value="production management">Production Management and Marketing</option>
                          <option value="economics">Economics</option>
                          <option value="finance">Finance and Banking</option>
                          <option value="civics">Civics</option>
                          <option value="logic">Logic</option>
                          <option value="sociology">Sociology</option>
                          <option value="islamic history">Islamic History</option>
                      </select>
                  </div>

                  
                

                  <input type="submit" value="Go">
                 </form>
                 <br><br>
                  <p style="text-align:center;font-weight:bold;"> Put Attendance </p>
                 <form action="put_attendance.php" method="POST">
                
                  <div class="form_row">
                  <label for='exam_type'>Exam </label>
                        <select id='exam_name' name='exam_name'>
                        <option value='1st_year_1st_term'>1st Year 1st Term</option>
                        <option value='1st_year_2nd_term'>1st Year 2nd Term</option>
                        <option value='1st_year_final'>1st Year Final</option>
                        <option value='pre_test'>Pre Test</option>
                        <option value='test'>Test</option>
                        </select>
                  </div>
                  <div class='form_row'>
                    <label for='group'>Group</label>
                        <select id='group' name='group'>
                            <option value='science'>Science</option>
                            <option value='business'>Business Studies</option>
                            <option value='humanities'>Humanities</option>
                        </select>
                    </div>
                  <div class='form_row'>
                    <label for='year'>Session</label>
                        <select id='year' name='year'>
                        <option value='2021-2022'>2021-2022</option>
                        <option value='2022-2023'>2022-2023</option>
                        <option value='2023-2024'>2023-2024</option>
                        <option value='2024-2025'>2024-2025</option>
                        <option value="2025-2026">2025-2026</option>
                          <option value="2026-2027">2026-2027</option>
                          <option value="2027-2028">2027-2028</option>
                          <option value="2028-2029">2028-2029</option>
                          <option value="2029-2030">2029-2030</option>
                        </select>
                    </div>

                  
                

                  <input type="submit" value="Go">
                 </form>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
