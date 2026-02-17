

<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include 'header.php';?>
       <span class="panel_name">Admin Panel</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="student_registration.php">Student Registration</a></li>
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
                    
                        $exam_name = $_GET['exam_name'];
                       $year = $_GET['year'];
                       $group = $_GET['group'];
                       $exam_table_name=$exam_name.'_'.$group;
                       $student_table='student_info_'.$group;
                       $ct_mark_bangla='ct_mark_bangla_'.$group;
                       $exam = str_replace("_"," ",$exam_name);

                        
                       echo '<div class="result-head">';
                       echo '<h3>'; echo 'Exam Result: '.$exam; echo '</h3>';
                       echo '<h3>Group: '.$group.'</h3>';
                      echo '<h3>Academic Year: '.$year.'</h3>';
                      echo '<a href="test_gradesheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Transcript </a>&nbsp;&nbsp;';
                      echo '<a href="result.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Final Result</a>&nbsp;&nbsp;';
                      echo '<a href="test_tabulation.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Tabulation</a>';
                      if($group=='science'){
                        echo '<div "><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#physics">Physics</a><a href="#chemistry">Chemistry</a><a href="#biology">Biology</a><a href="#math">Math</a><a href="#result">Result</a></div>';
                      }
                      if($group=='business'){
                        echo '<div><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#accounting">Accounting</a><a href="#bo">Business Organization</a><a href="#pm">Production Management</a><a href="#eco">Economics</a><a href="#finance">Finance and Banking</a><a href="#result">Result</a></div>';
                      }
                      if($group=='humanities'){
                        echo '<div><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#civics">Civics</a><a href="#logic">Logic</a><a href="#pm">Production Management</a><a href="#sociology">sociology</a><a href="#ih">Islamic History</a><a href="#economics">Economics</a><a href="#result">Result</a></div>';
                      }
                      echo '</div>';

                        //Bangla exam marks table start
                        include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bangla"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Bangla 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=bangla&part=1" target="_blank">Print Marksheet</a></th><th colspan="2">Bangla 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=bangla&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['bangla1 crtv']; echo '</td> 
                        <td>'; echo $table_content['bangla1 mcq']; echo '</td> 
                        <td>'; echo $table_content['bangla1 total']; echo '</td> 
                        <td>'; echo $table_content['bangla2']; echo '</td> 
                        <td>'; echo $table_content['bangla2 total']; echo '</td> 
                        <td>'; echo $table_content['bangla avg']; echo '</td> 
                        <td>'; echo $table_content['bangla lg']; echo '</td> 
                        <td>'; echo $table_content['bangla gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
                    //Bangla exam marks table ends


                     //English exam marks table start
                     include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="english"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th>Student ID</th><th>Student Name</th><th>English 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=english&part=1" target="_blank">Print Marksheet</a></th><th>English 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=english&part=2" target="_blank">Print Marksheet</a></th><th>Average</th><th>Letter Grade</th><th>Grade Point</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['english1']; echo '</td>
                        <td>'; echo $table_content['english2']; echo '</td>
                        <td>'; echo $table_content['english avg']; echo '</td> 
                        <td>'; echo $table_content['english lg']; echo '</td> 
                        <td>'; echo $table_content['english gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
                 //English exam marks table ends

                 //ict exam marks table start
                 include('conn.php');
                 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                 echo '<div id="ict"> <br><br><br><br></div>';  
                    
                     echo '<br><table class="studenttable">
                    
                     <tr>
                     <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="4">ICT<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=ict&part=" target="_blank">Print Marksheet</a></th><th rowspan="2">Total</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                     </tr>
                     <tr>
                     <th>Creative</th><th>MCQ</th><th>Practical</th>
                     </tr>
                     '; 
                 while($table_content = mysqli_fetch_array($result_info)):
                     $student_id = $table_content['Student ID'];
                     $student_name=$table_content['student_name'];
                     
                 echo '<tr>
                 <td>';  echo $table_content['Student ID']; echo '</td> 
                 <td>'; echo $table_content['student_name']; echo '</td> 
                 <td>'; echo $table_content['ict crtv']; echo '</td>
                 <td>'; echo $table_content['ict mcq']; echo '</td>
                 <td>'; echo $table_content['ict prac']; echo '</td>
                 <td>'; echo $table_content['ict total']; echo '</td>
                 <td>'; echo $table_content['bangla avg']; echo '</td> 
                 <td>'; echo $table_content['bangla lg']; echo '</td> 
                 <td>'; echo $table_content['bangla gp']; echo '</td> 
                 
                 </td> </tr>' ;
                     
                     
                 
                 
                 endwhile;
             echo "</table> <br><br>"; 
           
             //ict exam marks table ends


             //Science students exam marks
             if($group=='science'){


              //physics exam marks table start
              include('conn.php');
              $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
              echo '<div id="physics"> <br><br><br><br></div>';  
                 
                  echo '<br><table class="studenttable">
                 
                  <tr>
                  <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="4">Physics 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=physics&part=1" target="_blank">Print Marksheet</a></th><th colspan="4">Physics 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=physics&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                  </tr>
                  <tr>
                  <th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th>
                  </tr>
                  '; 
              while($table_content = mysqli_fetch_array($result_info)):
                  $student_id = $table_content['Student ID'];
                  $student_name=$table_content['student_name'];
                  
              echo '<tr>
              <td>';  echo $table_content['Student ID']; echo '</td> 
              <td>'; echo $table_content['student_name']; echo '</td> 
              <td>'; echo $table_content['physics1 crtv']; echo '</td> 
              <td>'; echo $table_content['physics1 mcq']; echo '</td> 
              <td>'; echo $table_content['physics1 prac']; echo '</td> 
              <td>'; echo $table_content['physics1 total']; echo '</td> 
              <td>'; echo $table_content['physics2 crtv']; echo '</td> 
              <td>'; echo $table_content['physics2 mcq']; echo '</td> 
              <td>'; echo $table_content['physics2 prac']; echo '</td> 
              <td>'; echo $table_content['physics2 total']; echo '</td> 
              <td>'; echo $table_content['physics avg']; echo '</td> 
              <td>'; echo $table_content['physics lg']; echo '</td> 
              <td>'; echo $table_content['physics gp']; echo '</td> 
              
              </td> </tr>' ;
                  
                  
              
              
              endwhile;
          echo "</table> <br><br>"; 
        
          //physics exam marks table ends

           //chemistry exam marks table start
           include('conn.php');
           $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
           echo '<div id="physics"> <br><br><br><br></div>';  
              
               echo '<br><table class="studenttable">
              
               <tr>
               <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="4">Chemistry 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=chemistry&part=1" target="_blank">Print Marksheet</a></th><th colspan="4">Chemistry 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=chemistry&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
               </tr>
               <tr>
               <th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th>
               </tr>
               '; 
           while($table_content = mysqli_fetch_array($result_info)):
               $student_id = $table_content['Student ID'];
               $student_name=$table_content['student_name'];
               
           echo '<tr>
           <td>';  echo $table_content['Student ID']; echo '</td> 
           <td>'; echo $table_content['student_name']; echo '</td> 
           <td>'; echo $table_content['physics1 crtv']; echo '</td> 
           <td>'; echo $table_content['physics1 mcq']; echo '</td> 
           <td>'; echo $table_content['physics1 prac']; echo '</td> 
           <td>'; echo $table_content['physics1 total']; echo '</td> 
           <td>'; echo $table_content['physics2 crtv']; echo '</td> 
           <td>'; echo $table_content['physics2 mcq']; echo '</td> 
           <td>'; echo $table_content['physics2 prac']; echo '</td> 
           <td>'; echo $table_content['physics2 total']; echo '</td> 
           <td>'; echo $table_content['physics avg']; echo '</td> 
           <td>'; echo $table_content['physics lg']; echo '</td> 
           <td>'; echo $table_content['physics gp']; echo '</td> 
           
           </td> </tr>' ;
               
               
           
           
           endwhile;
       echo "</table> <br><br>"; 
     
       //chemistry exam marks table ends


       //biology exam marks table start
       include('conn.php');
       $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
       echo '<div id="chemistry"> <br><br><br><br></div>';  
          
           echo '<br><table class="studenttable">
          
           <tr>
           <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="4">Biology 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=biology&part=1" target="_blank">Print Marksheet</a></th><th colspan="4">Biology 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=biology&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
           </tr>
           <tr>
           <th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th>
           </tr>
           '; 
       while($table_content = mysqli_fetch_array($result_info)):
           $student_id = $table_content['Student ID'];
           $student_name=$table_content['student_name'];
           
       echo '<tr>
       <td>';  echo $table_content['Student ID']; echo '</td> 
       <td>'; echo $table_content['student_name']; echo '</td> 
       <td>'; echo $table_content['chemistry1 crtv']; echo '</td> 
       <td>'; echo $table_content['chemistry1 mcq']; echo '</td> 
       <td>'; echo $table_content['chemistry1 prac']; echo '</td> 
       <td>'; echo $table_content['chemistry1 total']; echo '</td> 
       <td>'; echo $table_content['chemistry2 crtv']; echo '</td> 
       <td>'; echo $table_content['chemistry2 mcq']; echo '</td> 
       <td>'; echo $table_content['chemistry2 prac']; echo '</td> 
       <td>'; echo $table_content['chemistry2 total']; echo '</td> 
       <td>'; echo $table_content['chemistry avg']; echo '</td> 
       <td>'; echo $table_content['chemistry lg']; echo '</td> 
       <td>'; echo $table_content['chemistry gp']; echo '</td> 
       
       </td> </tr>' ;
           
           
       
       
       endwhile;
   echo "</table> <br><br>"; 
 
   //biology exam marks table ends

   //math exam marks table start
   include('conn.php');
              $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
              echo '<div id="math"> <br><br><br><br></div>';  
                 
                  echo '<br><table class="studenttable">
                 
                  <tr>
                  <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="4">Math 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=math&part=1" target="_blank">Print Marksheet</a></th><th colspan="4">Math 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=math&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                  </tr>
                  <tr>
                  <th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total</th>
                  </tr>
                  '; 
              while($table_content = mysqli_fetch_array($result_info)):
                  $student_id = $table_content['Student ID'];
                  $student_name=$table_content['student_name'];
                  
              echo '<tr>
              <td>';  echo $table_content['Student ID']; echo '</td> 
              <td>'; echo $table_content['student_name']; echo '</td> 
              <td>'; echo $table_content['math1 crtv']; echo '</td> 
              <td>'; echo $table_content['math1 mcq']; echo '</td> 
              <td>'; echo $table_content['math1 prac']; echo '</td> 
              <td>'; echo $table_content['math1 total']; echo '</td> 
              <td>'; echo $table_content['math2 crtv']; echo '</td> 
              <td>'; echo $table_content['math2 mcq']; echo '</td> 
              <td>'; echo $table_content['math2 prac']; echo '</td> 
              <td>'; echo $table_content['math2 total']; echo '</td> 
              <td>'; echo $table_content['math avg']; echo '</td> 
              <td>'; echo $table_content['math lg']; echo '</td> 
              <td>'; echo $table_content['math gp']; echo '</td> 
              
              </td> </tr>' ;
                  
                  
              
              
              endwhile;
          echo "</table> <br><br>"; 
        
//math exam marks table ends

//result table starts
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year` FROM $exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id WHERE `year`='$year'");
echo '<div id="result"> <br><br><br><br></div>';  
    echo '<table class="studenttable">
    <tr><th colspan="21">Result</th></tr>
    <tr>
    <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="2">Bangla</th><th colspan="2">English</th><th colspan="2">ICT</th><th colspan="2">Physics</th><th colspan="2">Chemistry</th><th colspan="2">Biology</th><th colspan="2">Math</th><th rowspan="2">4th Subject</th><th rowspan="2">GPA without 4th</th><th rowspan="2">Points from 4th subject</th><th rowspan="2">GPA</th><th rowspan="2">Grade</th>
    </tr>
    <tr>
    <th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th>
    </tr>'; 
while($table_content = mysqli_fetch_array($result_info)):
    $student_id = $table_content['Student ID'];
    $student_name=$table_content['student_name'];
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['bangla lg']; echo '</td> 
<td>'; echo $table_content['bangla gp']; echo '</td> 
<td>'; echo $table_content['english lg']; echo '</td> 
<td>'; echo $table_content['english gp']; echo '</td> 
<td>'; echo $table_content['ict lg']; echo '</td> 
<td>'; echo $table_content['ict gp']; echo '</td> 
<td>'; echo $table_content['physics lg']; echo '</td> 
<td>'; echo $table_content['physics gp']; echo '</td> 
<td>'; echo $table_content['chemistry lg']; echo '</td> 
<td>'; echo $table_content['chemistry gp']; echo '</td> 
<td>'; echo $table_content['biology lg']; echo '</td> 
<td>'; echo $table_content['biology gp']; echo '</td> 
<td>'; echo $table_content['math lg']; echo '</td> 
<td>'; echo $table_content['math gp']; echo '</td> 
<td>'; echo $table_content['fourth_sub']; echo '</td> 
<td>'; echo $table_content['gpa without 4th']; echo '</td> 
<td>'; echo $table_content['point_from_4th']; echo '</td> 
<td>'; echo $table_content['gpa']; echo '</td> 
<td>'; echo $table_content['grade']; echo '</td> 

</td> </tr>' ;
    
    


endwhile;
echo "</table> <br><br>"; 

//result table ends

   

             }


      //business students marks
      if($group=='business'){

         //accounting exam marks table start
         include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="accounting"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Accounting 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=accounting&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Accounting 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=accounting&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['accounting1 crtv']; echo '</td> 
                        <td>'; echo $table_content['accounting1 mcq']; echo '</td> 
                        <td>'; echo $table_content['accounting1 total']; echo '</td> 
                        <td>'; echo $table_content['accounting2 crtv']; echo '</td> 
                        <td>'; echo $table_content['accounting2 mcq']; echo '</td> 
                        <td>'; echo $table_content['accounting2 total']; echo '</td> 
                        <td>'; echo $table_content['accounting avg']; echo '</td> 
                        <td>'; echo $table_content['accounting lg']; echo '</td> 
                        <td>'; echo $table_content['accounting gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
     //accounting exam marks table ends

      //business organization exam marks table start
      include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bo"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Business Organization 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=business_organization&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Business Organization 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=business_organization&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['business_organization1 crtv']; echo '</td> 
                        <td>'; echo $table_content['business_organization1 mcq']; echo '</td> 
                        <td>'; echo $table_content['business_organization1 total']; echo '</td> 
                        <td>'; echo $table_content['business_organization2 crtv']; echo '</td> 
                        <td>'; echo $table_content['business_organization2 mcq']; echo '</td> 
                        <td>'; echo $table_content['business_organization2 total']; echo '</td> 
                        <td>'; echo $table_content['business_organization avg']; echo '</td> 
                        <td>'; echo $table_content['business_organization lg']; echo '</td> 
                        <td>'; echo $table_content['business_organization gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
  //business organization exam marks table ends


  //production management exam marks table start
  include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bangla"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Production Management 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=production_management&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Production Management 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=production_management&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['production_management1 crtv']; echo '</td> 
                        <td>'; echo $table_content['production_management1 mcq']; echo '</td> 
                        <td>'; echo $table_content['production_management1 total']; echo '</td> 
                        <td>'; echo $table_content['production_management2 crtv']; echo '</td> 
                        <td>'; echo $table_content['production_management2 mcq']; echo '</td> 
                        <td>'; echo $table_content['production_management2 total']; echo '</td> 
                        <td>'; echo $table_content['production_management avg']; echo '</td> 
                        <td>'; echo $table_content['production_management lg']; echo '</td> 
                        <td>'; echo $table_content['production_management gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
//production management exam marks table ends


 //economics exam marks table start
 include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bangla"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Economics 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Economics 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['economics1 crtv']; echo '</td> 
                        <td>'; echo $table_content['economics1 mcq']; echo '</td> 
                        <td>'; echo $table_content['economics1 total']; echo '</td> 
                        <td>'; echo $table_content['economics2 crtv']; echo '</td> 
                        <td>'; echo $table_content['economics2 mcq']; echo '</td> 
                        <td>'; echo $table_content['economics2 total']; echo '</td> 
                        <td>'; echo $table_content['economics avg']; echo '</td> 
                        <td>'; echo $table_content['economics lg']; echo '</td> 
                        <td>'; echo $table_content['economics gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
                  
 //economics exam marks table ends

//finance exam marks table start
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
echo '<div id="bangla"> <br><br><br><br></div>';  
   
    echo '<br><br><table class="studenttable">
   
    <tr>
    <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Finance 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=finance&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Finance 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=finance&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
    </tr>
    <tr>
    <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
    </tr>
    '; 
while($table_content = mysqli_fetch_array($result_info)):
    $student_id = $table_content['Student ID'];
    $student_name=$table_content['student_name'];
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['finance1 crtv']; echo '</td> 
<td>'; echo $table_content['finance1 mcq']; echo '</td> 
<td>'; echo $table_content['finance1 total']; echo '</td> 
<td>'; echo $table_content['finance2 crtv']; echo '</td> 
<td>'; echo $table_content['finance2 mcq']; echo '</td> 
<td>'; echo $table_content['finance2 total']; echo '</td> 
<td>'; echo $table_content['finance avg']; echo '</td> 
<td>'; echo $table_content['finance lg']; echo '</td> 
<td>'; echo $table_content['finance gp']; echo '</td> 

</td> </tr>' ;
    
    


endwhile;
echo "</table> <br><br>"; 

//finance exam marks table ends

//result table starts
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year` FROM $exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id WHERE `year`='$year'");
echo '<div id="result"> <br><br><br><br></div>';  
    echo '<table class="studenttable">
    <tr><th colspan="23">Result</th></tr>
    <tr>
    <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="2">Bangla</th><th colspan="2">English</th><th colspan="2">ICT</th><th colspan="2">Accounting</th><th colspan="2">Business Organization</th><th colspan="2">Production Management</th><th colspan="2">Economics</th><th colspan="2">Finance</th><th rowspan="2">4th Subject</th><th rowspan="2">GPA without 4th</th><th rowspan="2">Points from 4th subject</th><th rowspan="2">GPA</th><th rowspan="2">Grade</th>
    </tr>
    <tr>
    <th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th>
    </tr>'; 
while($table_content = mysqli_fetch_array($result_info)):
    $student_id = $table_content['Student ID'];
    $student_name=$table_content['student_name'];
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['bangla lg']; echo '</td> 
<td>'; echo $table_content['bangla gp']; echo '</td> 
<td>'; echo $table_content['english lg']; echo '</td> 
<td>'; echo $table_content['english gp']; echo '</td> 
<td>'; echo $table_content['ict lg']; echo '</td> 
<td>'; echo $table_content['ict gp']; echo '</td> 
<td>'; echo $table_content['accounting lg']; echo '</td> 
<td>'; echo $table_content['accounting gp']; echo '</td> 
<td>'; echo $table_content['business_organization lg']; echo '</td> 
<td>'; echo $table_content['business_organization gp']; echo '</td> 
<td>'; echo $table_content['production_management lg']; echo '</td> 
<td>'; echo $table_content['production_management gp']; echo '</td> 
<td>'; echo $table_content['economics lg']; echo '</td> 
<td>'; echo $table_content['economics gp']; echo '</td> 
<td>'; echo $table_content['finance lg']; echo '</td> 
<td>'; echo $table_content['finance gp']; echo '</td> 
<td>'; echo str_replace("_"," ",$table_content['fourth_sub']);  echo '</td> 
<td>'; echo $table_content['gpa without 4th']; echo '</td> 
<td>'; echo $table_content['point_from_4th']; echo '</td> 
<td>'; echo $table_content['gpa']; echo '</td> 
<td>'; echo $table_content['grade']; echo '</td> 

</td> </tr>' ;
    
    


endwhile;
echo "</table> <br><br>"; 

//result table ends


      }



      //humanities student exam marks

      if($group=='humanities'){

        //civics exam marks table start
        include('conn.php');
        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
        echo '<div id="bangla"> <br><br><br><br></div>';  
           
            echo '<br><br><table class="studenttable">
           
            <tr>
            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Civics 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=civics&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Civics 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=civics&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
            </tr>
            <tr>
            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
            </tr>
            '; 
        while($table_content = mysqli_fetch_array($result_info)):
            $student_id = $table_content['Student ID'];
            $student_name=$table_content['student_name'];
            
        echo '<tr>
        <td>';  echo $table_content['Student ID']; echo '</td> 
        <td>'; echo $table_content['student_name']; echo '</td> 
        <td>'; echo $table_content['civics1 crtv']; echo '</td> 
        <td>'; echo $table_content['civics1 mcq']; echo '</td> 
        <td>'; echo $table_content['civics1 total']; echo '</td> 
        <td>'; echo $table_content['civics2 crtv']; echo '</td> 
        <td>'; echo $table_content['civics2 mcq']; echo '</td> 
        <td>'; echo $table_content['civics2 total']; echo '</td> 
        <td>'; echo $table_content['civics avg']; echo '</td> 
        <td>'; echo $table_content['civics lg']; echo '</td> 
        <td>'; echo $table_content['civics gp']; echo '</td> 
        
        </td> </tr>' ;
            
            
        
        
        endwhile;
        echo "</table> <br><br>"; 
//civics exam marks table ends

 //logic exam marks table start
 
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
 echo '<div id="bangla"> <br><br><br><br></div>';  
    
     echo '<br><br><table class="studenttable">
    
     <tr>
     <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Logic 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=logic&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Logic 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=logic&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
     </tr>
     <tr>
     <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
     </tr>
     '; 
 while($table_content = mysqli_fetch_array($result_info)):
     $student_id = $table_content['Student ID'];
     $student_name=$table_content['student_name'];
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['logic1 crtv']; echo '</td> 
 <td>'; echo $table_content['logic1 mcq']; echo '</td> 
 <td>'; echo $table_content['logic1 total']; echo '</td> 
 <td>'; echo $table_content['logic2 crtv']; echo '</td> 
 <td>'; echo $table_content['logic2 mcq']; echo '</td> 
 <td>'; echo $table_content['logic2 total']; echo '</td> 
 <td>'; echo $table_content['logic avg']; echo '</td> 
 <td>'; echo $table_content['logic lg']; echo '</td> 
 <td>'; echo $table_content['logic gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 //logic exam marks table ends

 //sociology exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
 echo '<div id="bangla"> <br><br><br><br></div>';  
    
     echo '<br><br><table class="studenttable">
    
     <tr>
     <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Sociology 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=sociology&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Sociology 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=sociology&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
     </tr>
     <tr>
     <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
     </tr>
     '; 
 while($table_content = mysqli_fetch_array($result_info)):
     $student_id = $table_content['Student ID'];
     $student_name=$table_content['student_name'];
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['sociology1 crtv']; echo '</td> 
 <td>'; echo $table_content['sociology1 mcq']; echo '</td> 
 <td>'; echo $table_content['sociology1 total']; echo '</td> 
 <td>'; echo $table_content['sociology2 crtv']; echo '</td> 
 <td>'; echo $table_content['sociology2 mcq']; echo '</td> 
 <td>'; echo $table_content['sociology2 total']; echo '</td> 
 <td>'; echo $table_content['sociology avg']; echo '</td> 
 <td>'; echo $table_content['sociology lg']; echo '</td> 
 <td>'; echo $table_content['sociology gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 
 //sociology exam marks table ends

 //islamic history exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
 echo '<div id="bangla"> <br><br><br><br></div>';  
    
     echo '<br><br><table class="studenttable">
    
     <tr>
     <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Islamic History 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=islamic_history&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Islamic History 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=islamic_history&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
     </tr>
     <tr>
     <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
     </tr>
     '; 
 while($table_content = mysqli_fetch_array($result_info)):
     $student_id = $table_content['Student ID'];
     $student_name=$table_content['student_name'];
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['islamic_history1 crtv']; echo '</td> 
 <td>'; echo $table_content['islamic_history1 mcq']; echo '</td> 
 <td>'; echo $table_content['islamic_history1 total']; echo '</td> 
 <td>'; echo $table_content['islamic_history2 crtv']; echo '</td> 
 <td>'; echo $table_content['islamic_history2 mcq']; echo '</td> 
 <td>'; echo $table_content['islamic_history2 total']; echo '</td> 
 <td>'; echo $table_content['islamic_history avg']; echo '</td> 
 <td>'; echo $table_content['islamic_history lg']; echo '</td> 
 <td>'; echo $table_content['islamic_history gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 
 //islamic history exam marks table ends

  //economics exam marks table start
  include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bangla"> <br><br><br><br></div>';  
                           
                            echo '<br><br><table class="studenttable">
                           
                            <tr>
                            <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="3">Economics 1st Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics&part=1" target="_blank">Print Marksheet</a></th><th colspan="3">Economics 2nd Paper<br><a href="test_marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics&part=2" target="_blank">Print Marksheet</a></th><th rowspan="2">Average</th><th rowspan="2">Letter Grade</th><th rowspan="2">Grade Point</th>
                            </tr>
                            <tr>
                            <th>Creative</th><th>MCQ</th><th>Total</th><th>Creative</th><th>MCQ</th><th>Total</th>
                            </tr>
                            '; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['economics1 crtv']; echo '</td> 
                        <td>'; echo $table_content['economics1 mcq']; echo '</td> 
                        <td>'; echo $table_content['economics1 total']; echo '</td> 
                        <td>'; echo $table_content['economics2 crtv']; echo '</td> 
                        <td>'; echo $table_content['economics2 mcq']; echo '</td> 
                        <td>'; echo $table_content['economics2 total']; echo '</td> 
                        <td>'; echo $table_content['economics avg']; echo '</td> 
                        <td>'; echo $table_content['economics lg']; echo '</td> 
                        <td>'; echo $table_content['economics gp']; echo '</td> 
                        
                        </td> </tr>' ;
                            
                            
                        
                        
                        endwhile;
                    echo "</table> <br><br>"; 
  
  //economics exam marks table ends

 //result table starts
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year` FROM $exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id WHERE `year`='$year'");
   
    echo '<table class="studenttable">
    <tr><th colspan="23">Result</th></tr>
    <tr>
    <th rowspan="2">Student ID</th><th rowspan="2">Student Name</th><th colspan="2">Bangla</th><th colspan="2">English</th><th colspan="2">ICT</th><th colspan="2">Civics</th><th colspan="2">Logic</th><th colspan="2">Sociology</th><th colspan="2">Islamic History</th><th colspan="2">Economics</th><th rowspan="2">4th Subject</th><th rowspan="2">GPA without 4th</th><th rowspan="2">Points from 4th subject</th><th rowspan="2">GPA</th><th rowspan="2">Grade</th>
    </tr>
    <tr>
    <th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th><th>LG</th><th>GP</th>
    </tr>'; 
while($table_content = mysqli_fetch_array($result_info)):
    $student_id = $table_content['Student ID'];
    $student_name=$table_content['student_name'];
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['bangla lg']; echo '</td> 
<td>'; echo $table_content['bangla gp']; echo '</td> 
<td>'; echo $table_content['english lg']; echo '</td> 
<td>'; echo $table_content['english gp']; echo '</td> 
<td>'; echo $table_content['ict lg']; echo '</td> 
<td>'; echo $table_content['ict gp']; echo '</td> 
<td>'; echo $table_content['civics lg']; echo '</td> 
<td>'; echo $table_content['civics gp']; echo '</td> 
<td>'; echo $table_content['logic lg']; echo '</td> 
<td>'; echo $table_content['logic gp']; echo '</td> 
<td>'; echo $table_content['sociology lg']; echo '</td> 
<td>'; echo $table_content['sociology gp']; echo '</td> 
<td>'; echo $table_content['islamic_history lg']; echo '</td> 
<td>'; echo $table_content['islamic_history gp']; echo '</td> 
<td>'; echo $table_content['economics lg']; echo '</td> 
<td>'; echo $table_content['economics gp']; echo '</td> 
<td>'; echo str_replace("_"," ",$table_content['fourth_sub']);  echo '</td> 
<td>'; echo $table_content['gpa without 4th']; echo '</td> 
<td>'; echo $table_content['point_from_4th']; echo '</td> 
<td>'; echo $table_content['gpa']; echo '</td> 
<td>'; echo $table_content['grade']; echo '</td> 

</td> </tr>' ;
    
    


endwhile;
echo "</table> <br><br>"; 

//result table ends

      }

      
                          
                                     
                ?>
                   
                  
                   
            </div>

            
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
