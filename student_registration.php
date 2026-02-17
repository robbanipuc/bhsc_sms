
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
               <?php
               session_start();
               $group=$_GET['group'];
               $_SESSION['group']=$group;

                  if($group=='select')
                    echo '
                     <form action="student_registration.php?group=$group" method="GET">
                        <div class="form_row reg">
                        <input type="radio" name="group" value="science">
                        <label>Science</label></div><br>
                        <div class="form_row reg">
                        <input type="radio" name="group" value="business">
                        <label>Business Studies</label></div><br>
                        <div class="form_row reg">
                        <input type="radio" name="group" value="humanities">
                        <label>Humanities</label></div>
                        <input type="submit" value="GO" class="sub">
                     </form>
                    ';
                else{
                    if(isset($_GET['register'])){
                        echo '<p style="color:red">User already exists</p>';
                    }

                  echo '
                  <form action="inc/student_registration_inc.php" method="POST" enctype="multipart/form-data">
                  <div class="form_row"><label for="student_id">Student ID:</label><input type="text" id="student_id" name="student_id" required></div>
                  
                  <div class="form_row"><label for="name">Name:</label><input type="text" id="name" name="name" required></div>
                  <div class="form_row"><label for="name_bangla">Name (বাংলায়):</label><input type="text" id="name_bangla" name="name_bangla" required></div>
                  <div class="form_row">
                  <label for="year">Academic Year</label>
                      <select id="year" name="year">
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
                  <div class="form_row"> <label for="fathers_name">Fathers Name:</label><input type="text" id="fathers_name" name="fathers_name"></div>
                  <div class="form_row"> <label for="mothers_name">Mothers_name:</label><input type="text" id="mothers_name" name="mothers_name"></div>
                  <div class="form_row"> <label for="birth_date">Date of Birth:</label><input type="date" id="birth_date" name="birth_date"></div>
                  <div class="form_row"> <label for="present_address">Present Address:</label><textarea name="present_address" style="width:300px; height:50px;">
                  </textarea></div>
                  <div class="form_row"> <label for="permanent_address">Permanent Address:</label><textarea name="permanent_address" style="width:300px; height:50px;">
                  </textarea></div>
                  <div class="form_row"> <label for="phone">Phone No:</label><input type="text" id="phone" name="phone"></div>
                  <div class="form_row"> <label for="g_phone">Gaurdian Phone No:</label><input type="text" id="g_phone" name="g_phone"></div>
                  <div class="form_row"> <label for="blood">Blood Group:</label><input type="text" id="blood" name="blood"></div>
                  <div class="form_row"><label for="image">Upload Image:</label><input type="file" id="image" name="image"></div>
                  <div class="form_row"><label for="ssc_gpa">SSC GPA:</label><input type="text" id="ssc_gpa" name="ssc_gpa"></div>

                  ';

                   if($group=='science'){
                    echo '
                    <br>
                    <div class="form_row">
                  <label for="subject1">Subject 1</label>
                      <select id="subject1" name="subject1">
                          <option value="physics">physics</option>
                          <option value="chemistry">chemistry</option>
                          <option value="biology">biology</option>
                          <option value="math">math</option>
                      </select>
                  </div>
                  <div class="form_row">
                  <label for="subject2">Subject 2</label>
                      <select id="subject2" name="subject2">
                          <option value="physics">physics</option>
                          <option value="chemistry">chemistry</option>
                          <option value="biology">biology</option>
                          <option value="math">math</option>
                      </select>
                  </div>
                  <div class="form_row">
                  <label for="subject3">Subject 3</label>
                      <select id="subject3" name="subject3">
                          <option value="physics">physics</option>
                          <option value="chemistry">chemistry</option>
                          <option value="biology">biology</option>
                          <option value="math">math</option>
                      </select>
                  </div>
                  <div class="form_row">
                  <label for="4th_subject">4th Subject</label>
                      <select id="4th_subject" name="4th_subject">
                          <option value="biology">biology</option>
                          <option value="math">math</option>
                      </select>
                  </div>
                    
                    ';
                   }

                   if($group=='business'){
                    echo '
                    <br>
                    <div class="form_row">
                      <label for="subject1">Subject 1</label>
                      <select id="subject1" name="subject1">
                          <option value="accounting">Accounting</option>
                          <option value="business_organization">Business Organization and Management</option>
                          <option value="production_management">Production Management and Marketing</option>
                          <option value="economics">Economics</option>
                          <option value="finance">Finance and Banking</option>
                      </select>
                  </div>
                  <div class="form_row">
                      <label for="subject2">Subject 2</label>
                      <select id="subject2" name="subject2">
                          <option value="accounting">Accounting</option>
                          <option value="business_organization">Business Organization and Management</option>
                          <option value="production_management">Production Management and Marketing</option>
                          <option value="economics">Economics</option>
                          <option value="finance">Finance and Banking</option>
                      </select>
                  </div>
                  <div class="form_row">
                      <label for="subject3">Subject 3</label>
                      <select id="subject3" name="subject3">
                          <option value="accounting">Accounting</option>
                          <option value="business_organization">Business Organization and Management</option>
                          <option value="production_management">Production Management and Marketing</option>
                          <option value="economics">Economics</option>
                          <option value="finance">Finance and Banking</option>
                      </select>
                  </div>
                  <div class="form_row">
                      <label for="4th_subject">4th Subject</label>
                      <select id="4th_subject" name="4th_subject">
                          <option value="production_management">Production Management and Marketing</option>
                          <option value="economics">Economics</option>
                          <option value="finance">Finance and Banking</option>
                      </select>
                  </div>
                    
                    ';
                   }

                   if($group=='humanities'){
                    echo '
                    <div class="form_row">
                      <label for="subject1">Subject 1</label>
                      <select id="subject1" name="subject1">
                          <option value="civics">Civics</option>
                          <option value="logic">Logic</option>
                          <option value="sociology">Sociology</option>
                          <option value="islamic_history">Islamic History</option>
                          <option value="economics">Economics</option>
                      </select>
                  </div>
                  <div class="form_row">
                  <label for="subject2">Subject 2</label>
                  <select id="subject2" name="subject2">
                      <option value="civics">Civics</option>
                      <option value="logic">Logic</option>
                      <option value="sociology">Sociology</option>
                      <option value="islamic_history">Islamic History</option>
                      <option value="economics">Economics</option>
                  </select>
                 </div>
                 <div class="form_row">
                 <label for="subject3">Subject 3</label>
                 <select id="subject3" name="subject3">
                     <option value="civics">Civics</option>
                     <option value="logic">Logic</option>
                     <option value="sociology">Sociology</option>
                     <option value="islamic_history">Islamic History</option>
                     <option value="economics">Economics</option>
                 </select>
                </div>
                <div class="form_row">
                <label for="4th_subject">4th Subject</label>
                <select id="4th_subject" name="4th_subject">
                    <option value="civics">Civics</option>
                    <option value="logic">Logic</option>
                    <option value="sociology">Sociology</option>
                    <option value="islamic_history">Islamic History</option>
                    <option value="economics">Economics</option>
                </select>
            </div>
                    
                    ';
                   }


                  echo '
                  <input type="submit" value="Submit">
                 </form>
                  
                  ';
                    
                }

                   

                ?>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
