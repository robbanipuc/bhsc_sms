
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

            <div class="content profile">
              
                

                <?php 
                        session_start();
                    
                        $group = $_GET['group'];
                        $student_id = $_GET['student_id'];
                        $table_name = 'student_info_' . $group;
                        $_SESSION["table_name"] =  $table_name;
                        include('conn.php');
                            $student_info = mysqli_query($conn,"SELECT * FROM $table_name WHERE `student_id` ='$student_id'");
                           
                            $table_content = mysqli_fetch_array($student_info);
                                $student_id = $table_content['student_id'];
                                $_SESSION["student_id"] = $student_id;
                                $student_name = $table_content['student_name'];
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
                                     
                ?>
                   
                   <div class="info_container">
                   <div class="profile-pic"> <img style=" height:200px;width:200px;" src="image/<?php echo $image;?>" alt=""></div>
                   
                        
                            <div class="st-name"> <?php echo $student_name; ?> </div>
                            
                        
                        <div class="info_row">
                            <span class="info_name"> Student ID:</span>
                            <span class="info_content"><?php echo $student_id; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Academic Year:</span>
                            <span class="info_content"><?php echo $year; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Group:</span>
                            <span class="info_content"><?php echo $group; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Father's Name:</span>
                            <span class="info_content"><?php echo $fathers_name; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Mother's Name</span>
                            <span class="info_content"><?php echo $mothers_name; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Date of Birth</span>
                            <span class="info_content"><?php echo $birth_date; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Present Address:</span>
                            <span class="info_content"><?php echo $present_address; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Permanent Address:</span>
                            <span class="info_content"><?php echo $permanent_address; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Phone No:</span>
                            <span class="info_content"><?php echo $phone; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Gaurdian Phone No:</span>
                            <span class="info_content"><?php echo $g_phone; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">Blood Group:</span>
                            <span class="info_content"><?php echo $blood; ?></span>
                        </div>
                        <div class="info_row">
                            <span class="info_name">SSC GPA:</span>
                            <span class="info_content"><?php echo $ssc_gpa; ?></span>
                        </div>
                        <div><a href="detail_result.php?student_id=<?php echo $student_id;?>&group=<?php echo $group; ?>">Detail Result</a></div>
                        <div><a href="inc/delete_student_profile_inc.php" style="float:right;">Delete Record</a></div>
                        <div><a href="edit_student_profile.php?student_id=<?php echo $student_id;?>&group=<?php echo $group; ?>&table=<?php echo $table_name; ?>">Edit</a></div>
                        
                   </div>
                   
            </div>

            
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
