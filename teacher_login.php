
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';?>

     <div class="main-body">
         <div class="home_menu">
         <form action="teacher_validation.php" method="POST">
                    

                    <div class="form_row">
                  <label for="subject">Select Subject</label>
                      <select id="subject" name="subject_name">
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
                    <div class="form_row"><label for="password">Password</label><input type="text" id="password" name="password"></div>
                    <input class="form_button" type="submit" value="Login">
                </form>
         </div>
    </div>


      
     </div>
     <div class="footer">
     

     </div>
  

</body>
</html>
