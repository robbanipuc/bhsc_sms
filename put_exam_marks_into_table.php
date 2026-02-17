
<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';
session_start();
$subject = $_SESSION['subject'];
$subject = str_replace(" ","_",$_SESSION['subject']);


?>

       <span class="panel_name"> <?php if( $_SESSION['login']=='teacher'){echo 'Teacher Panel['.$_SESSION['subject'].']';} if( $_SESSION['login']=='admin'){echo 'Admin Panel';}?></span>
     <div class="main-body">
              
            <div class="sidebar">
              <?php
               if($_SESSION['login']=='teacher'){
                echo '
                <ul class="main_menu"> 
                <li><a class="menu" href="assigned_students.php">Assigned Students</a></li>
                <li><a class="menu" href="put_marks.php">Put Marks</a></li>
                <li><a class="menu" href="see_marks.php">See Marks</a></li>
              </ul>
                ';

               }

               if($_SESSION['login']=='admin'){
                echo '
                <ul class="main_menu"> 
                <li><a class="menu" href="student_registration.php?group=select">Student Registration</a></li>
                <li><a class="menu" href="student_profile.php?test=0">Student Profile</a></li>
                <li><a class="menu" href="put_marks_select_admin.php">Put Marks</a></li>
                <li><a class="menu" href="exam_results.php">Exam Results</a></li>
                <li><a class="menu" href="add_teacher.php">Add Teacher</a></li>
                <li><a class="menu" href="mentors.php">Mentors</a></li>
              </ul>
                ';

               }

              ?>
             
            </div>

            <div class="content">
                
                <?php
                     include('conn.php');
                     $exam_name= $_SESSION['exam_name'];
                     $group = $_SESSION['group'];
                     $year=$_SESSION['year'];
                     $student_table='student_info_'.$group;
                     $exam_mark_table = $exam_name.'_'.$group;
                     $_SESSION['exam_mark_table'] = $exam_mark_table;
                     $ct_mark_table='ct_mark_'.$subject.'_'.$group;
                     $_SESSION['ct_mark_table']=$ct_mark_table;
                    // $ct_mark_table_info = mysqli_query($conn,"SELECT * FROM `$ct_mark_table`");
                    $ct_mark_table_info   = mysqli_query($conn,"SELECT $ct_mark_table.*,$student_table.`year` FROM $ct_mark_table INNER JOIN $student_table ON $ct_mark_table.`Student_ID`=$student_table.student_id WHERE `year`='$year'");
                    // $exam_mark_info = mysqli_query($conn,"SELECT  FROM `$exam_mark_table`");
                    $exam_mark_info = mysqli_query($conn,"SELECT $exam_mark_table.*,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");
                    if($exam_name=='test'){
                      echo '<form action="inc/put_test_exam_marks_into_inc.php" method="POST">';
                    }else{
                      echo ' <form action="inc/put_exam_marks_into_inc.php" method="POST">';
                    }
                    //echo $ct_mark_info;
                    $subject = str_replace(" ","_",$_SESSION['subject']);
                    $exam = str_replace("_"," ",$exam_name);
                      echo  '<h3>Put '.$exam.' Exam Marks</h3>';
                      echo '<h3>Group: '.$group.'</h3>';
                      echo '<h3>Subject: '.$subject.'</h3>';
                      echo '<h3>Academic Year: '.$year.'</h3>';

                       
                        if($subject=='physics' || $subject=='chemistry' || $subject=='biology' || $subject=='math'){
                                   if($exam_name=='test'){
                                    echo '<table>
                                    <tr><th rowspan="2">Student ID</th><th colspan="3">'; echo $subject.' '.'1st Part'; echo ' </th><th colspan="3">'; echo $subject.' '.'2nd Part';  echo '</th></tr>
                                    <tr><th>Creative</th><th>MCQ</th><th>Practical</th><th>Creative</th><th>MCQ</th><th>Practical</th></tr>';
                                    while($table_content = mysqli_fetch_array($exam_mark_info)):
                                      $student_id = $table_content['Student ID'];
                                    
                                    
                                    $mark_creative1 = $table_content[$subject.'1'.' '.'crtv'];
                                    $mark_mcq1 = $table_content[$subject.'1'.' '.'mcq'];
                                    $mark_prac1 = $table_content[$subject.'1'.' '.'prac'];

                                    $mark_creative2 = $table_content[$subject.'2'.' '.'crtv'];
                                    $mark_mcq2 = $table_content[$subject.'2'.' '.'mcq'];
                                    $mark_prac2 = $table_content[$subject.'2'.' '.'prac'];
                                   
                                      $st_roll="roll_".$student_id;
                                      
                                      //echo $st_roll;
                                    // $_SESSION[$st_roll]=$st_roll."marks";
                                      echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1creative'; echo '" value='; echo $mark_creative1; echo '></div></td>'; 
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1mcq'; echo '" value='; echo $mark_mcq1; echo '></div></td>';
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1practical'; echo '" value='; echo $mark_prac1; echo '></div></td>';
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2creative'; echo '" value='; echo $mark_creative2; echo '></div></td>'; 
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2mcq'; echo '" value='; echo $mark_mcq2; echo '></div></td>';
                                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2practical'; echo '" value='; echo $mark_prac2; echo '></div></td>';
                                        echo '</tr>';
                                        //echo $student_id;
                                      // echo $mark; echo "<br>";
                                    endwhile;
                                    echo '</table>';

                                   }
                                   else{
                                            echo '<table>
                                            <tr><th>Student ID</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Class Test</th></tr>';
                                            while($table_content = mysqli_fetch_array($exam_mark_info)):
                                              $student_id = $table_content['Student ID'];
                                            
                                            
                                            $mark_creative = $table_content[$subject.' '.'crtv'];
                                            $mark_mcq = $table_content[$subject.' '.'mcq'];
                                            $mark_prac = $table_content[$subject.' '.'prac'];
                                            $mark_ct = $table_content[$subject.' '.'ct'];
                                              $st_roll="roll_".$student_id;
                                              
                                              //echo $st_roll;
                                            // $_SESSION[$st_roll]=$st_roll."marks";
                                              echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                                echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'creative'; echo '" value='; echo $mark_creative; echo '></div></td>'; 
                                                echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'mcq'; echo '" value='; echo $mark_mcq; echo '></div></td>';
                                                echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'practical'; echo '" value='; echo $mark_prac; echo '></div></td>';
                                                echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'ct'; echo '" value='; echo $mark_ct; echo '></div></td>';
                                                echo '</tr>';
                                                //echo $student_id;
                                              // echo $mark; echo "<br>";
                                            endwhile;
                                            echo '</table>';
                                   }
                        }
                        elseif($subject=='ict'){
                          if($exam_name=='test'){
                            echo '<table>
                          <tr><th>Student ID</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Class Test</th></tr>';
                          while($table_content = mysqli_fetch_array($exam_mark_info)):
                            $student_id = $table_content['Student ID'];
                          
                          
                          $mark_creative = $table_content[$subject.' '.'crtv'];
                          $mark_mcq = $table_content[$subject.' '.'mcq'];
                          $mark_prac = $table_content[$subject.' '.'prac'];
                         
                            $st_roll="roll_".$student_id;
                            
                            //echo $st_roll;
                          // $_SESSION[$st_roll]=$st_roll."marks";
                            echo '<tr><td>'; echo $student_id; echo '</td>'; 
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'creative'; echo '" value='; echo $mark_creative; echo '></div></td>'; 
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'mcq'; echo '" value='; echo $mark_mcq; echo '></div></td>';
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'practical'; echo '" value='; echo $mark_prac; echo '></div></td>';
                              
                              
                              echo '</tr>';
                              //echo $student_id;
                            // echo $mark; echo "<br>";
                          endwhile;
                          echo '</table>';

                          }else{
                            echo '<table>
                          <tr><th>Student ID</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Class Test</th></tr>';
                          while($table_content = mysqli_fetch_array($exam_mark_info)):
                            $student_id = $table_content['Student ID'];
                          
                          
                          $mark_creative = $table_content[$subject.' '.'crtv'];
                          $mark_mcq = $table_content[$subject.' '.'mcq'];
                          $mark_prac = $table_content[$subject.' '.'prac'];
                          $mark_ct = $table_content[$subject.' '.'ct'];
                         
                            $st_roll="roll_".$student_id;
                            
                            //echo $st_roll;
                          // $_SESSION[$st_roll]=$st_roll."marks";
                            echo '<tr><td>'; echo $student_id; echo '</td>'; 
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'creative'; echo '" value='; echo $mark_creative; echo '></div></td>'; 
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'mcq'; echo '" value='; echo $mark_mcq; echo '></div></td>';
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'practical'; echo '" value='; echo $mark_prac; echo '></div></td>';
                              
                              echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'ct'; echo '" value='; echo $mark_ct; echo '></div></td>';
                              echo '</tr>';
                              //echo $student_id;
                            // echo $mark; echo "<br>";
                          endwhile;
                          echo '</table>';

                          }
                        }
                        elseif($subject=='english' || ($subject=='bangla' && $exam_name=='pre_test') ){
                          if($exam_name=='test'){
                            echo '<table>
                            <tr><th>Student ID</th><th>English 1st paper</th><th>English 2nd paper</th></tr>';
                  while($table_content = mysqli_fetch_array($exam_mark_info)):
                      $student_id = $table_content['Student ID'];
                      $mark_creative1 = $table_content[$subject.'1'];
                      $mark_creative2 = $table_content[$subject.'2'];
                      
                    // $mark = $table_content[$col_name];
                      $st_roll="roll_".$student_id;
                     // echo $st_roll;
                    // $_SESSION[$st_roll]=$st_roll."marks";
                      echo '<tr><td>'; echo $student_id; echo '</td>'; 
                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1creative'; echo '" value='; echo $mark_creative1; echo '></div></td>'; 
                        echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2creative'; echo '" value='; echo $mark_creative2; echo '></div></td>'; 
                       
                        
                        echo '</tr>';
                        //echo $student_id;
                      // echo $mark; echo "<br>";
                    endwhile;
                    echo '</table>';

                          }else{
                            echo '<table>
                                        <tr><th>Student ID</th><th>Creative</th><th>Class Test</th></tr>';
                              while($table_content = mysqli_fetch_array($exam_mark_info)):
                                  $student_id = $table_content['Student ID'];
                                  $mark_creative = $table_content[$subject.' '.'total'];
                                  $mark_ct = $table_content[$subject.' '.'ct'];
                                // $mark = $table_content[$col_name];
                                  $st_roll="roll_".$student_id;
                                 // echo $st_roll;
                                // $_SESSION[$st_roll]=$st_roll."marks";
                                  echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'creative'; echo '" value='; echo $mark_creative; echo '></div></td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'ct'; echo '" value='; echo $mark_ct; echo '></div></td>';
                                    
                                    echo '</tr>';
                                    //echo $student_id;
                                  // echo $mark; echo "<br>";
                                endwhile;
                                echo '</table>';
                          }
                        }
                        elseif($subject=='bangla' && $exam_name=='test'){
                        
                          echo '<table>
                          <tr><th rowspan="2">Student ID</th><th colspan="2">'; echo $subject.' '.'1st Part'; echo ' </th><th colspan="1">'; echo $subject.' '.'2nd Part';  echo '</th></tr>
                          <tr><th>Creative</th><th>MCQ</th><th>Creative</th></tr>';
                              while($table_content_ct = mysqli_fetch_array($ct_mark_table_info)):
                                  $student_id = $table_content_ct['Student_ID'];

                                  $crtv_col1= $subject.'1 '.'crtv';
                                  $mcq_col1= $subject.'1 '.'mcq';
                                  $crtv_col2= $subject.'2';
                                  
                                  
                                  $exam_mark_info = mysqli_query($conn,"SELECT `$crtv_col1`,`$mcq_col1`,`$crtv_col2` FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
                                  $table_content_exam=mysqli_fetch_array($exam_mark_info);
                                      if ($table_content_exam) {
                                          $mark_creative1 = $table_content_exam[$crtv_col1];
                                          $mark_mcq1      = $table_content_exam[$mcq_col1];
                                          $mark_creative2 = $table_content_exam[$crtv_col2];
                                      } else {
                                          // handle the case where there is no data
                                          $mark_creative1 = 0; // or null
                                          $mark_mcq1      = 0;
                                          $mark_creative2 = 0;
}
                                
                               
                                // $mark = $table_content[$col_name];
                                  $st_roll="roll_".$student_id;
                                // $_SESSION[$st_roll]=$st_roll."marks";
                               
                                  echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1creative'; echo '" value="'; echo $mark_creative1; echo '"></div></td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1mcq'; echo '" value="'; echo  $mark_mcq1; echo '"></div></td>';
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2creative'; echo '" value="'; echo $mark_creative2; echo '"></div></td>';
                                    echo '</tr>';
                                    //echo $student_id;
                                  // echo $mark; echo "<br>";
                                endwhile;
                                echo '</table>';

                        }

                        else{
                                               
                        if($exam_name=='test'){
                          echo '<table>
                          <tr><th rowspan="2">Student ID</th><th colspan="2">'; echo $subject.' '.'1st Part'; echo ' </th><th colspan="2">'; echo $subject.' '.'2nd Part';  echo '</th></tr>
                          <tr><th>Creative</th><th>MCQ</th><th>Creative</th><th>MCQ</th></tr>';
                              while($table_content_ct = mysqli_fetch_array($ct_mark_table_info)):
                                  $student_id = $table_content_ct['Student_ID'];

                                  $crtv_col1= $subject.'1 '.'crtv';
                                  $mcq_col1= $subject.'1 '.'mcq';
                                  $crtv_col2= $subject.'2 '.'crtv';
                                  $mcq_col2= $subject.'2 '.'mcq';
                                  
                                  $exam_mark_info = mysqli_query($conn,"SELECT `$crtv_col1`,`$mcq_col1`,`$crtv_col2`,`$mcq_col2` FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
                                  $table_content_exam=mysqli_fetch_array($exam_mark_info);
                                  $mark_creative1 = $table_content_exam[$crtv_col1] ?? 0;
                                  $mark_mcq1      = $table_content_exam[$mcq_col1] ?? 0;
                                  $mark_creative2 = $table_content_exam[$crtv_col2] ?? 0;
                                  $mark_mcq2      = $table_content_exam[$mcq_col2] ?? 0;
                               
                                // $mark = $table_content[$col_name];
                                  $st_roll="roll_".$student_id;
                                // $_SESSION[$st_roll]=$st_roll."marks";
                               
                                  echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1creative'; echo '" value="'; echo $mark_creative1; echo '"></div></td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'1mcq'; echo '" value="'; echo  $mark_mcq1; echo '"></div></td>';
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2creative'; echo '" value="'; echo $mark_creative2; echo '"></div></td>';
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'2mcq'; echo '" value="'; echo  $mark_mcq2; echo '"></div></td>';
                                    echo '</tr>';
                                    //echo $student_id;
                                  // echo $mark; echo "<br>";
                                endwhile;
                                echo '</table>';

                        }else{
                          echo '<table>
                                        <tr><th>Student ID</th><th>Creative</th><th>MCQ</th><th>Class Test</th></tr>';
                              while($table_content_ct = mysqli_fetch_array($ct_mark_table_info)):
                                  $student_id = $table_content_ct['Student_ID'];

                                  $crtv_col= $subject.' '.'crtv';
                                  $mcq_col= $subject.' '.'mcq';
                                  $ct_col= $subject.' '.'ct';
                                  $exam_mark_info = mysqli_query($conn,"SELECT `$crtv_col`,`$mcq_col`,`$ct_col` FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
                                  $table_content_exam=mysqli_fetch_array($exam_mark_info);
                                  $mark_creative = $table_content_exam[$crtv_col];
                                $mark_mcq = $table_content_exam[$mcq_col];
                                $mark_ct = $table_content_exam[$ct_col];
                                // $mark = $table_content[$col_name];
                                  $st_roll="roll_".$student_id;
                                // $_SESSION[$st_roll]=$st_roll."marks";
                               
                                  echo '<tr><td>'; echo $student_id; echo '</td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'creative'; echo '" value="'; echo $mark_creative; echo '"></div></td>'; 
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'mcq'; echo '" value="'; echo  $mark_mcq; echo '"></div></td>';
                                    echo '<td><div class="form_row"> <input type="text" name="'; echo $st_roll.$subject.'ct'; echo '" value='; echo $mark_ct; echo '></div></td>';
                                    echo '</tr>';
                                    //echo $student_id;
                                  // echo $mark; echo "<br>";
                                endwhile;
                                echo '</table>';

                        }
                        
                        }
                       

                    
                    echo '<input type="submit" value="Submit">';
                    echo '</form>';
                ?>
     
                   
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>

