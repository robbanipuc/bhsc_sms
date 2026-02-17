
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
session_start();
$subject = $_SESSION['subject'];
?>
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

                  <?php

                  if($subject=='bangla' || $subject=='english'  || $subject=='ict'){
              
                   echo "<div class='page_heading'>Put Class Test Marks</div>
                   <form action='inc/ct_mark_input.php' method='post'>
                    <div class='form_row'><label for='ct_no'>Class Test No.:</label><input type='text' id='ct_no' name='ct_no'></div>
                    
                    <div class='form_row'>
                    <label for='group'>Group</label>
                        <select id='group' name='group'>
                            <option value='science'>Science</option>
                            <option value='business'>Business Studies</option>
                            <option value='humanities'>Humanities</option>
                        </select>
                    </div>

                    <div class='form_row'><label for='student_id'>Student ID:</label><input type='text' id='student_id' name='student_id'></div>
                    <div class='form_row'> <label for='student_name'>Student Name:</label><input type='text' id='student_name' name='student_name'></div>
                    <div class='form_row'> <label for='ct_mark'>Marks Obtained:</label><input type='text' id='ct_mark' name='ct_mark'></div>
                   
                    <input class='form_button' type='submit' value='Save & Next'>
                   </form>";

                  }else{
                    echo "<div class='page_heading'>Put Class Test Marks</div>
                   <form action='inc/ct_mark_input.php' method='post'>
                    <div class='form_row'><label for='ct_no'>Class Test No.:</label><input type='text' id='ct_no' name='ct_no'></div>
                    <div class='form_row'><label for='student_id'>Student ID:</label><input type='text' id='student_id' name='student_id'></div>
                    <div class='form_row'> <label for='student_name'>Student Name:</label><input type='text' id='student_name' name='student_name'></div>
                    <div class='form_row'> <label for='ct_mark'>Marks Obtained:</label><input type='text' id='ct_mark' name='ct_mark'></div>
                   
                    <input class='form_button' type='submit' value='Save & Next'>
                   </form>";

                  }

                  ?>
                   
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
