
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';?>
       <span class="panel_name">Teacher Panel</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="assigned_students.php">Assigned Students</a></li>
                <li><a class="menu" href="ct_marks.php">Put Class Test Marks</a></li>
                <li><a class="menu" href="exam_marks.php">Put Exam Marks</a></li>
                <li><a class="menu" href="see_marks.php">See Marks</a></li>
              </ul>
            </div>

            <div class="content">
                   <div class="page_heading">Put Exam Marks</div>
                   <form action="/action_page.php">
                   <div class="form_row">
                    <label for="exam_name">Exam Name</label>
                        <select id="exam_name" name="exam_name">
                            <option value="1st_y_1term">1st Yeaar 1st Term</option>
                            <option value="2nd_y_2term">1st Year 2nd Term</option>
                            <option value="1st_y_final">1st Year Final</option>
                            <option value="pre_test">Pre Test</option>
                            <option value="test">Test</option>
                        </select>
                    </div>
                    <div class="form_row"><label for="student_id">Student ID:</label><input type="text" id="student_id" name="student_id"></div>
                    <div class="form_row"> <label for="student_name">Student Name:</label><input type="text" id="student_name" name="student_name"></div>
                    <div class="form_row"> <label for="ct_mark">Marks Obtained:</label><input type="text" id="ct_mark" name="ct_mark"></div>
                   
                    <input class="form_button" type="submit" value="Save & Next">
                </form>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
