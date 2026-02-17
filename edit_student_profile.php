
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';?>
       <span class="panel_name">Admin Panel</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="student_registration.php?group=select">Student Registration</a></li>
                <li><a class="menu" href="student_profile.php?test=0">Student Profile</a></li>
                <li><a class="menu" href="exam_results.php">Exam Results</a></li>
                <li><a class="menu" href="add_teacher.php">Add Teacher</a></li>
                <li><a class="menu" href="mentors.php">Mentors</a></li>
              </ul>
            </div>

            <div class="content">

            <?php 
                        session_start();
                    
                        
                        $student_id = $_GET['student_id'];
                        $table_name = $_GET['table'];
                        include('conn.php');
                            $student_info = mysqli_query($conn,"SELECT * FROM $table_name WHERE `student_id` ='$student_id'");
                           
                            $table_content = mysqli_fetch_array($student_info);
                                $student_id = $table_content['student_id'];
                                $_SESSION["student_id"] = $student_id;
                                $student_name = $table_content['student_name'];
                                $name_bangla = $table_content['name_bangla'];
                                $year = $table_content['year'];
                                $group = $table_content['student_group'];
                                $fathers_name = $table_content['fathers_name'];
                                $mothers_name = $table_content['mothers_name'];
                                $birth_date = $table_content['date_of_birth'];
                                $present_address = $table_content['present_address'];
                                $permanent_address = $table_content['permanent_address'];
                                $phone = $table_content['phone_no'];
                                $g_phone = $table_content['gaurdian_phone_no'];
                                $blood = $table_content['blood_group'];
                                $image = $table_content['image'];
                                $ssc_gpa = $table_content['ssc_gpa'];
                                $subject1=$table_content['subject1'];
                                $subject2=$table_content['subject2'];
                                $subject3=$table_content['subject3'];
                                $fourth_sub=$table_content['fourth_sub'];
                                     
                ?>

                <div><h2>Edit Student Profile</h2></div>
                <form action="inc/edit_student_profile_inc.php" method="POST" enctype="multipart/form-data">
                    <div class="form_row"><label for="student_id">Student ID:</label><input type="text" id="student_id" name="student_id" value="<?php echo $student_id; ?>"></div>
                    
                    <div class="form_row"><label for="name">Name:</label><input type="text" id="name" name="name" value="<?php echo $student_name; ?>"></div>
                    <div class="form_row"><label for="name_bangla">Name (বাংলায়):</label><input type="text" id="name_bangla" name="name_bangla" value="<?php echo $name_bangla; ?>"></div>
                    <div class="form_row">
                    <label for="group">Group</label>
                        <select id="group" name="group">
                            <option <?php if($group=='science'){echo 'selected';} else{echo '';}  ?> value="science">Science</option>
                            <option <?php if($group=='business'){echo 'selected';} else{echo '';}  ?> value="business">Business Studies</option>
                            <option <?php if($group=='humanities'){echo 'selected';} else{echo '';}  ?> value="humanities">Humanities</option>
                        </select>
                    </div>
                    <div class="form_row">
                    <label for="year">Academic Year</label>
                        <select id="year" name="year">
                            <option value="2021-2022">2021-2022</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>
                    <div class="form_row"> <label for="fathers_name">Father's Name:</label><input type="text" id="fathers_name" name="fathers_name" value="<?php echo $fathers_name; ?>"></div>
                    <div class="form_row"> <label for="mothers_name">Mothers_name:</label><input type="text" id="mothers_name" name="mothers_name" value="<?php echo $mothers_name; ?>"></div>
                    <div class="form_row"> <label for="birth_date">Date of Birth:</label><input type="date" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>"></div>
                    <div class="form_row"> <label for="present_address">Present Address:</label><textarea name="present_address" style="width:300px; height:50px;" > <?php echo $present_address; ?>
                    </textarea></div>
                    <div class="form_row"> <label for="permanent_address">Permanent Address:</label><textarea name="permanent_address" style="width:300px; height:50px;" ><?php echo $permanent_address; ?>
                    </textarea></div>
                    <div class="form_row"> <label for="phone">Phone No:</label><input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"></div>
                    <div class="form_row"> <label for="g_phone">Gaurdian Phone No:</label><input type="text" id="g_phone" name="g_phone" value="<?php echo $g_phone; ?>"></div>
                    <div class="form_row"> <label for="blood">Blood Group:</label><input type="text" id="blood" name="blood" value="<?php echo $blood; ?>"></div>
                    <div class="form_row"><label for="image">Upload Image:</label><input type="file" id="image" name="image"></div>
                    <div class="form_row"><label for="ssc_gpa">SSC GPA:</label><input type="text" id="ssc_gpa" name="ssc_gpa"></div>

                    <?php
                         if($group=='science'){
                           
                            echo '
                            <br>
                            
                            <div class="form_row">
                              <label for="subject1">Subject 1</label>
                              <select id="subject1" name="subject1">
                                  <option '; if($subject1=='Physics'){echo 'selected';} else{echo '';} echo ' value="Physics">Physics</option>
                                  <option '; if($subject1=='chemistry'){echo 'selected';} else{echo '';} echo ' value="chemistry">Chemistry</option>
                                  <option '; if($subject1=='biology'){echo 'selected';} else{echo '';} echo ' value="biology">Biology</option>
                                  <option '; if($subject1=='math'){echo 'selected';} else{echo '';}  echo ' value="math">Math</option>
                              </select>
                          </div>';

                          echo '
                          <br>
                          
                          <div class="form_row">
                            <label for="subject2">Subject 2</label>
                            <select id="subject2" name="subject2">
                                <option '; if($subject2=='Physics'){echo 'selected';} else{echo '';} echo ' value="Physics">Physics</option>
                                <option '; if($subject2=='chemistry'){echo 'selected';} else{echo '';} echo ' value="chemistry">Chemistry</option>
                                <option '; if($subject2=='biology'){echo 'selected';} else{echo '';} echo ' value="biology">Biology</option>
                                <option '; if($subject2=='math'){echo 'selected';} else{echo '';}  echo ' value="math">Math</option>
                            </select>
                        </div>';

                        echo '
                          <br>
                          
                          <div class="form_row">
                            <label for="subject3">Subject 3</label>
                            <select id="subject3" name="subject3">
                                <option '; if($subject3=='Physics'){echo 'selected';} else{echo '';} echo ' value="Physics">Physics</option>
                                <option '; if($subject3=='chemistry'){echo 'selected';} else{echo '';} echo ' value="chemistry">Chemistry</option>
                                <option '; if($subject3=='biology'){echo 'selected';} else{echo '';} echo ' value="biology">Biology</option>
                                <option '; if($subject3=='math'){echo 'selected';} else{echo '';}  echo ' value="math">Math</option>
                            </select>
                        </div>';

                        echo '
                          <br>
                          
                          <div class="form_row">
                            <label for="fourth_sub">4th Subject</label>
                            <select id="fourth_sub" name="fourth_sub">
                                <option '; if($fourth_sub=='biology'){echo 'selected';} else{echo '';} echo ' value="biology">Biology</option>
                                <option '; if($fourth_sub=='math'){echo 'selected';} else{echo '';}  echo ' value="math">Math</option>
                            </select>
                        </div>';


                         
                           }
        
                           if($group=='business'){

                            echo $subject1;
                            echo '
                            <br>
                            
                            <div class="form_row">
                              <label for="subject1">Subject 1</label>
                              <select id="subject1" name="subject1">
                                  <option '; if($subject1=='accounting'){echo 'selected';} else{echo '';} echo ' value="accounting">Accounting</option>
                                  <option '; if($subject1=='business_organization'){echo 'selected';} else{echo '';} echo ' value="business_organization">Business Organization and Management</option>
                                  <option '; if($subject1=='production_management'){echo 'selected';} else{echo '';} echo ' value="production_management">Production Management and Marketing</option>
                                  <option '; if($subject1=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                                  <option '; if($subject1=='finance'){echo 'selected';} else{echo '';}   echo ' value="finance">Finance and Banking</option>
                              </select>
                          </div>';

                          echo '
                          <div class="form_row">
                            <label for="subject2">Subject 2</label>
                            <select id="subject2" name="subject2">
                                <option '; if($subject2=='accounting'){echo 'selected';} else{echo '';} echo ' value="accounting">Accounting</option>
                                <option '; if($subject2=='business_organization'){echo 'selected';} else{echo '';} echo ' value="business_organization">Business Organization and Management</option>
                                <option '; if($subject2=='production_management'){echo 'selected';} else{echo '';} echo ' value="production_management">Production Management and Marketing</option>
                                <option '; if($subject2=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                                <option '; if($subject2=='finance'){echo 'selected';} else{echo '';}   echo ' value="finance">Finance and Banking</option>
                            </select>
                        </div>';
                        echo '
                          <div class="form_row">
                            <label for="subject3">Subject 3</label>
                            <select id="subject3" name="subject3">
                                <option '; if($subject3=='accounting'){echo 'selected';} else{echo '';} echo ' value="accounting">Accounting</option>
                                <option '; if($subject3=='business_organization'){echo 'selected';} else{echo '';} echo ' value="business_organization">Business Organization and Management</option>
                                <option '; if($subject3=='production_management'){echo 'selected';} else{echo '';} echo ' value="production_management">Production Management and Marketing</option>
                                <option '; if($subject3=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                                <option '; if($subject3=='finance'){echo 'selected';} else{echo '';}   echo ' value="finance">Finance and Banking</option>
                            </select>
                        </div>';
                        echo '
                          <div class="form_row">
                            <label for="fourth_sub">4th Subject</label>
                            <select id="fourth_sub" name="fourth_sub">
                                <option '; if($fourth_sub=='production_management'){echo 'selected';} else{echo '';} echo ' value="production_management">Production Management and Marketing</option>
                                <option '; if($fourth_sub=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                                <option '; if($fourth_sub=='finance'){echo 'selected';} else{echo '';}   echo ' value="finance">Finance and Banking</option>
                            </select>
                        </div>';

                            
                            
                           }
        
                           if($group=='humanities'){
                            echo '
                            <br>
                            
                            <div class="form_row">
                              <label for="subject1">Subject 1</label>
                              <select id="subject1" name="subject1">
                                  <option '; if($subject1=='civics'){echo 'selected';} else{echo '';} echo ' value="civics">Civics</option>
                                  <option '; if($subject1=='logic'){echo 'selected';} else{echo '';} echo ' value="logic">Logic</option>
                                  <option '; if($subject1=='sociology'){echo 'selected';} else{echo '';} echo ' value="sociology">Sociology</option>
                                  <option '; if($subject1=='islamic_history'){echo 'selected';} else{echo '';}  echo ' value="islamic_history">Islamic History</option>
                                  <option '; if($subject1=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                              </select>
                          </div>';

                          echo '
                            <br>
                            
                            <div class="form_row">
                              <label for="subject2">Subject 2</label>
                              <select id="subject2" name="subject2">
                                  <option '; if($subject2=='civics'){echo 'selected';} else{echo '';} echo ' value="civics">Civics</option>
                                  <option '; if($subject2=='logic'){echo 'selected';} else{echo '';} echo ' value="logic">Logic</option>
                                  <option '; if($subject2=='sociology'){echo 'selected';} else{echo '';} echo ' value="sociology">Sociology</option>
                                  <option '; if($subject2=='islamic_history'){echo 'selected';} else{echo '';}  echo ' value="islamic_history">Islamic History</option>
                                  <option '; if($subject2=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                              </select>
                          </div>';

                          echo '
                          <br>
                          
                          <div class="form_row">
                            <label for="subject3">Subject 3</label>
                            <select id="subject3" name="subject3">
                                <option '; if($subject3=='civics'){echo 'selected';} else{echo '';} echo ' value="civics">Civics</option>
                                <option '; if($subject3=='logic'){echo 'selected';} else{echo '';} echo ' value="logic">Logic</option>
                                <option '; if($subject3=='sociology'){echo 'selected';} else{echo '';} echo ' value="sociology">Sociology</option>
                                <option '; if($subject3=='islamic_history'){echo 'selected';} else{echo '';}  echo ' value="islamic_history">Islamic History</option>
                                <option '; if($subject3=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                            </select>
                        </div>';

                        echo '
                        <br>
                        
                        <div class="form_row">
                          <label for="fourth_sub">4th Subject</label>
                          <select id="fourth_sub" name="fourth_sub">
                              <option '; if($fourth_sub=='civics'){echo 'selected';} else{echo '';} echo ' value="civics">Civics</option>
                              <option '; if($fourth_sub=='logic'){echo 'selected';} else{echo '';} echo ' value="logic">Logic</option>
                              <option '; if($fourth_sub=='sociology'){echo 'selected';} else{echo '';} echo ' value="sociology">Sociology</option>
                              <option '; if($fourth_sub=='islamic_history'){echo 'selected';} else{echo '';}  echo ' value="islamic_history">Islamic History</option>
                              <option '; if($fourth_sub=='economics'){echo 'selected';} else{echo '';}  echo ' value="economics">Economics</option>
                          </select>
                      </div>';
                           }

                    ?>

                    <input type="submit" value="Submit">
                </form>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
