
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
                <h4> Put Marks</h4>

                  <?php

                  if($subject=='bangla' || $subject=='english'  || $subject=='ict'){
              
                   echo "<div class='page_heading'>Put Class Test Marks</div>
                   <form action='inc/put_marks_inc.php' method='post'>
                    <div class='form_row'>
                    <label for='group'>Group</label>
                        <select id='group' name='group'>
                            <option value='science'>Science</option>
                            <option value='business'>Business Studies</option>
                            <option value='humanities'>Humanities</option>
                        </select>
                    </div>
                    <div class='form_row'>
                    <label for='session'>Session</label>
                        <select id='session' name='session'>
                        <option value='2021-2022'>2021-2022</option>
                        <option value='2022-2023'>2022-2023</option>
                        <option value='2023-2024'>2023-2024</option>
                        <option value='2024-2025'>2024-2025</option>
                        <option value='2025-2026'>2025-2026</option>
                        </select>
                    </div>
                    <div class='form_row'>
                    <label for='exam_type'>Exam Type</label>
                        <select id='exam_name' name='exam_name'>
                        <option value='class_test'>Class Test</option>
                        <option value='1st_year_1st_term'>1st Yeaar 1st Term</option>
                        <option value='1st_year_2nd_term'>1st Year 2nd Term</option>
                        <option value='1st_year_final'>1st Year Final</option>
                        <option value='pre_test'>Pre Test</option>
                        <option value='test'>Test</option>
                        </select>
                    </div>

                    
                   
                    <input class='form_button' type='submit' value='Next'>
                   </form>";

                  }
                  else if($subject=='economics'){
              
                    echo "<div class='page_heading'>Put Class Test Marks</div>
                    <form action='inc/put_marks_inc.php' method='post'>
                     <div class='form_row'>
                     <label for='group'>Group</label>
                         <select id='group' name='group'>
                             <option value='business'>Business Studies</option>
                             <option value='humanities'>Humanities</option>
                         </select>
                     </div>
                     <div class='form_row'>
                     <label for='session'>Session</label>
                         <select id='session' name='session'>
                         <option value='2021-2022'>2021-2022</option>
                         <option value='2022-2023'>2022-2023</option>
                         <option value='2023-2024'>2023-2024</option>
                         <option value='2024-2025'>2024-2025</option>
                         <option value='2025-2026'>2025-2026</option>
                         </select>
                     </div>
                     <div class='form_row'>
                     <label for='exam_type'>Exam Type</label>
                         <select id='exam_name' name='exam_name'>
                             <option value='class_test'>Class Test</option>
                             <option value='1st_year_1st_term'>1st Yeaar 1st Term</option>
                             <option value='1st_year_2nd_term'>1st Year 2nd Term</option>
                             <option value='1st_year_final'>1st Year Final</option>
                             <option value='pre_test'>Pre Test</option>
                             <option value='test'>Test</option>
                         </select>
                     </div>
 
                     
                    
                     <input class='form_button' type='submit' value='Next'>
                    </form>";
 
                   }
                  
                  else{
                    echo "
                    <form action='inc/put_marks_inc.php' method='post'>
                    <div class='form_row'>
                    <label for='session'>Session</label>
                        <select id='session' name='session'>
                        <option value='2021-2022'>2021-2022</option>
                        <option value='2022-2023'>2022-2023</option>
                        <option value='2023-2024'>2023-2024</option>
                        <option value='2024-2025'>2024-2025</option>
                        <option value='2025-2026'>2025-2026</option>
                        </select>
                    </div>
                    <div class='form_row'>
                    <label for='exam_type'>Exam Type</label>
                        <select id='exam_name' name='exam_name'>
                        <option value='class_test'>Class Test</option>
                        <option value='1st_year_1st_term'>1st Yeaar 1st Term</option>
                        <option value='1st_year_2nd_term'>1st Year 2nd Term</option>
                        <option value='1st_year_final'>1st Year Final</option>
                        <option value='pre_test'>Pre Test</option>
                        <option value='test'>Test</option>
                        </select>
                    </div>

                    
                   
                    <input class='form_button' type='submit' value='Next'>
                   </form>";

                  }

                  ?>
                   
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
