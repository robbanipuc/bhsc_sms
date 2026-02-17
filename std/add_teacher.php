
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
                <form action="/action_page.php">
                    <div class="form_row"><label for="t_name">Teacher Name:</label><input type="text" id="t_name" name="t_name"></div>
                    <div class="form_row"><label for="teacher_id">Teacher ID:</label><input type="text" id="teacher_id" name="teacher_id"></div>
                    <div class="form_row"> <label for="subject">Subject:</label><input type="text" id="subject" name="subject"></div>
                    <div class="form_row"> <label for="phone_no">Phone No:</label><input type="text" id="phone_no" name="phone_no"></div>
                    <div class="form_row"> <label for="birth_date">Date of Birth:</label><input type="date" id="birth_date" name="birth_date"></div>
                    <div class="form_row"> <label for="present_address">Present Address:</label><textarea name="present_address" style="width:300px; height:50px;">
                    </textarea></div>
                    <div class="form_row"> <label for="permanent_address">Permanent Address:</label><textarea name="permanent_address" style="width:300px; height:50px;">
                    </textarea></div>
                    <div class="form_row"> <label for="blood">Blood Group:</label><input type="text" id="blood" name="blood"></div>
                    <div class="form_row"><label for="image">Upload Image:</label><input type="file" id="image" name="image"></div>


                    <input class="form_button" type="submit" value="Save">
                </form>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
