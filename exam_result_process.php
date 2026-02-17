

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
                    
                        $exam_name = $_POST['exam_name'];
                       $year = $_POST['academic_year'];
                       $group = $_POST['group'];

                      
                       $exam_table_name=$exam_name.'_'.$group;
                       $student_table='student_info_'.$group;
                       $ct_mark_bangla='ct_mark_bangla_'.$group;
                       $exam = str_replace("_"," ",$exam_name);

                       if($exam_name=='test'){
                        header('location:test_exam_result_process.php?exam_name=test&year='.$year.'&group='.$group);
                       }
                        
                       echo '<div class="result-head">';
                       echo '<h3>'; echo 'Exam Result: '.$exam; echo '</h3>';
                       echo '<h3>Group: '.$group.'</h3>';
                      echo '<h3>Academic Year: '.$year.'</h3>';
                      echo '<a href="gradesheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Transcript </a>&nbsp;&nbsp;';
                      echo '<a href="result.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Final Result</a>&nbsp;&nbsp;';
                      echo '<a href="tabulation.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'" target="_blank">Print Tabulation</a>';

                      if($group=='science'){
                        echo '<div "><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#physics">Physics</a><a href="#chemistry">Chemistry</a><a href="#biology">Biology</a><a href="#math">Math</a><a href="#result">Result</a></div>';
                      }
                      if($group=='business'){
                        echo '<div><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#accounting">Accounting</a><a href="#bo">Business Organization</a><a href="#pm">Production Management</a><a href="#eco">Economics</a><a href="#finance">Finance and Banking</a><a href="#result">Result</a></div>';
                      }
                      if($group=='humanities'){
                        echo '<div><a href="#bangla">Bangla</a><a href="#english">English</a><a href="#ict">ICT</a><a href="#civics">Civics</a><a href="#logic">Logic</a><a href="#sociology">sociology</a><a href="#ih">Islamic History</a><a href="#economics">Economics</a><a href="#result">Result</a></div>';
                      }
                      echo '</div>';

                        //Bangla exam marks table start
                        include('conn.php');
                        $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                        echo '<div id="bangla"> <br><br><br><br></div>';  
                           
                           if($exam_name=='pre_test'){
                            echo '<br><br><table class="studenttable">
                            <tr><th colspan="10">Bangla <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=bangla" target="_blank">Print Marksheet</a></th></tr>
                            <tr>
                            <th>Student ID</th><th>Student Name</th><th>Creative</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
                            </tr>'; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['bangla total']; echo '</td>
                        <td>'; echo $table_content['bangla total90']; echo '</td> 
                        <td>'; echo $table_content['bangla ct']; echo '</td> 
                        <td>'; echo $table_content['bangla total final']; echo '</td> 
                        <td>'; echo $table_content['bangla lg']; echo '</td> 
                        <td>'; echo $table_content['bangla gp']; echo '</td> 
                        
                        </td> </tr>' ;
                        endwhile;
                    echo "</table> <br><br>"; 

                           }else{
                            echo '<br><br><table class="studenttable">
                            <tr><th colspan="10">Bangla <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=bangla">Print Marksheet</a></th></tr>
                            <tr>
                            <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
                            </tr>'; 
                        while($table_content = mysqli_fetch_array($result_info)):
                            $student_id = $table_content['Student ID'];
                            $student_name=$table_content['student_name'];
                            
                        echo '<tr>
                        <td>';  echo $table_content['Student ID']; echo '</td> 
                        <td>'; echo $table_content['student_name']; echo '</td> 
                        <td>'; echo $table_content['bangla crtv']; echo '</td> 
                        <td>'; echo $table_content['bangla mcq']; echo '</td> 
                        <td>'; echo $table_content['bangla total']; echo '</td> 
                        <td>'; echo $table_content['bangla total90']; echo '</td> 
                        <td>'; echo $table_content['bangla ct']; echo '</td> 
                        <td>'; echo $table_content['bangla total final']; echo '</td> 
                        <td>'; echo $table_content['bangla lg']; echo '</td> 
                        <td>'; echo $table_content['bangla gp']; echo '</td> 
                        
                        </td> </tr>' ;
                        endwhile;
                    echo "</table> <br><br>"; 
                           }
                  
                    //Bangla exam marks table ends


                     //English exam marks table start
                     include('conn.php');
                     $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,$ct_mark_bangla.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN $ct_mark_bangla ON $exam_table_name.`Student ID`=$ct_mark_bangla.Student_ID) WHERE `year`='$year'");
                     echo '<div id="english"> <br><br><br><br></div>';  
                         echo '<table class="studenttable" >
                         <tr><th colspan="8">English <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=english" target="_blank">Print Marksheet</a></th></tr>
                         <tr>
                         <th>Student ID</th><th>Student Name</th><th>Total Marks(100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
                         </tr>'; 
                     while($table_content = mysqli_fetch_array($result_info)):
                         $student_id = $table_content['Student ID'];
                         $student_name=$table_content['student_name'];
                         
                     echo '<tr>
                     <td>';  echo $table_content['Student ID']; echo '</td> 
                     <td>'; echo $table_content['student_name']; echo '</td>
                     <td>'; echo $table_content['english total']; echo '</td> 
                     <td>'; echo $table_content['english total90']; echo '</td> 
                     <td>'; echo $table_content['english ct']; echo '</td> 
                     <td>'; echo $table_content['english total final']; echo '</td> 
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
                     echo '<table class="studenttable">
                     <tr><th colspan="11">Information and Communication Technology <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=ict" target="_blank">Print Marksheet</a></th></tr>
                     <tr>
                     <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
                     </tr>'; 
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
                 <td>'; echo $table_content['ict total90']; echo '</td> 
                 <td>'; echo $table_content['ict ct']; echo '</td> 
                 <td>'; echo $table_content['ict total final']; echo '</td> 
                 <td>'; echo $table_content['ict lg']; echo '</td> 
                 <td>'; echo $table_content['ict gp']; echo '</td> 
                 
                 </td> </tr>' ;
                     
                     
                 
                 
                 endwhile;
             echo "</table> <br><br>"; 
           
             //ict exam marks table ends


             //Science students exam marks
             if($group=='science'){


              //physics exam marks table start
              include('conn.php');
              $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_physics_science.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_physics_science ON $exam_table_name.`Student ID`=ct_mark_physics_science.Student_ID) WHERE `year`='$year'");
                 
              echo '<div id="physics"> <br><br><br><br></div>';    
              echo '<table class="studenttable">
                  <tr><th colspan="11">Physics <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=physics" target="_blank">Print Marksheet</a></th></tr>
                  <tr>
                  <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
                  </tr>'; 
              while($table_content = mysqli_fetch_array($result_info)):
                  $student_id = $table_content['Student ID'];
                  $student_name=$table_content['student_name'];
                  
              echo '<tr>
              <td>';  echo $table_content['Student ID']; echo '</td> 
              <td>'; echo $table_content['student_name']; echo '</td> 
              <td>'; echo $table_content['physics crtv']; echo '</td> 
              <td>'; echo $table_content['physics mcq']; echo '</td> 
              <td>'; echo $table_content['physics prac']; echo '</td> 
              <td>'; echo $table_content['physics total']; echo '</td> 
              <td>'; echo $table_content['physics total90']; echo '</td> 
              <td>'; echo $table_content['physics ct']; echo '</td> 
              <td>'; echo $table_content['physics total final']; echo '</td> 
              <td>'; echo $table_content['physics lg']; echo '</td> 
              <td>'; echo $table_content['physics gp']; echo '</td> 
              
              </td> </tr>' ;
                  
                  
              
              
              endwhile;
          echo "</table> <br><br>"; 
        
          //physics exam marks table ends

           //chemistry exam marks table start
           include('conn.php');
           $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_chemistry_science.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_chemistry_science ON $exam_table_name.`Student ID`=ct_mark_chemistry_science.Student_ID) WHERE `year`='$year'");
           echo '<div id="chemistry"> <br><br><br><br></div>';  
               echo '<table class="studenttable" >
               <tr><th colspan="11">Chemistry <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=chemistry" target="_blank">Print Marksheet</a></th></tr>
               <tr>
               <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
               </tr>'; 
           while($table_content = mysqli_fetch_array($result_info)):
               $student_id = $table_content['Student ID'];
               $student_name=$table_content['student_name'];
               
           echo '<tr>
           <td>';  echo $table_content['Student ID']; echo '</td> 
           <td>'; echo $table_content['student_name']; echo '</td> 
           <td>'; echo $table_content['chemistry crtv']; echo '</td> 
           <td>'; echo $table_content['chemistry mcq']; echo '</td> 
           <td>'; echo $table_content['chemistry prac']; echo '</td> 
           <td>'; echo $table_content['chemistry total']; echo '</td> 
           <td>'; echo $table_content['chemistry total90']; echo '</td> 
           <td>'; echo $table_content['chemistry ct']; echo '</td> 
           <td>'; echo $table_content['chemistry total final']; echo '</td> 
           <td>'; echo $table_content['chemistry lg']; echo '</td> 
           <td>'; echo $table_content['chemistry gp']; echo '</td> 
           
           </td> </tr>' ;
               
               
           
           
           endwhile;
       echo "</table> <br>"; 
     
       //chemistry exam marks table ends


       //biology exam marks table start
       include('conn.php');
       $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_biology_science.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_biology_science ON $exam_table_name.`Student ID`=ct_mark_biology_science.Student_ID) WHERE `year`='$year'");
       echo '<div id="biology"> <br><br><br><br></div>';  
           echo '<table class="studenttable">
           <tr><th colspan="11">Biology <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=biology" target="_blank">Print Marksheet</a></th></tr>
           <tr>
           <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
           </tr>'; 
       while($table_content = mysqli_fetch_array($result_info)):
           
       echo '<tr>
       <td>';  echo $table_content['Student ID']; echo '</td> 
       <td>'; echo $table_content['student_name']; echo '</td> 
       <td>'; echo $table_content['biology crtv']; echo '</td> 
       <td>'; echo $table_content['biology mcq']; echo '</td> 
       <td>'; echo $table_content['biology prac']; echo '</td> 
       <td>'; echo $table_content['biology total']; echo '</td> 
       <td>'; echo $table_content['biology total90']; echo '</td> 
       <td>'; echo $table_content['biology ct']; echo '</td> 
       <td>'; echo $table_content['biology total final']; echo '</td> 
       <td>'; echo $table_content['biology lg']; echo '</td> 
       <td>'; echo $table_content['biology gp']; echo '</td> 
       
       </td> </tr>' ;
           
           
       
       
       endwhile;
   echo "</table> <br>"; 
 
   //biology exam marks table ends

   //math exam marks table start
   include('conn.php');
   $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_math_science.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_math_science ON $exam_table_name.`Student ID`=ct_mark_math_science.Student_ID) WHERE `year`='$year'");
   echo '<div id="math"> <br><br><br><br></div>';  
       echo '<table class="studenttable" >
       <tr><th colspan="11">Math <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=math" target="_blank">Print Marksheet</a></th></tr>
       <tr>
       <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Practical</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
       </tr>'; 
   while($table_content = mysqli_fetch_array($result_info)):
       
   echo '<tr>
   <td>';  echo $table_content['Student ID']; echo '</td> 
   <td>'; echo $table_content['student_name']; echo '</td> 
   <td>'; echo $table_content['math crtv']; echo '</td> 
   <td>'; echo $table_content['math mcq']; echo '</td> 
   <td>'; echo $table_content['math prac']; echo '</td> 
   <td>'; echo $table_content['math total']; echo '</td> 
   <td>'; echo $table_content['math total90']; echo '</td> 
   <td>'; echo $table_content['math ct']; echo '</td> 
   <td>'; echo $table_content['math total final']; echo '</td> 
   <td>'; echo $table_content['math lg']; echo '</td> 
   <td>'; echo $table_content['math gp']; echo '</td> 
   
   </td> </tr>' ;
       
       
   
   
   endwhile;
echo "</table> <br>"; 

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
         $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_accounting_business.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_accounting_business ON $exam_table_name.`Student ID`=ct_mark_accounting_business.Student_ID) WHERE `year`='$year'");
         echo '<div id="accounting"> <br><br><br><br></div>';  
             echo '<table class="studenttable">
             <tr><th colspan="10">Accounting <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=accounting" target="_blank">Print Marksheet</a></th></tr>
             <tr>
             <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
             </tr>'; 
         while($table_content = mysqli_fetch_array($result_info)):
             
         echo '<tr>
         <td>';  echo $table_content['Student ID']; echo '</td> 
         <td>'; echo $table_content['student_name']; echo '</td> 
         <td>'; echo $table_content['accounting crtv']; echo '</td> 
         <td>'; echo $table_content['accounting mcq']; echo '</td> 
         <td>'; echo $table_content['accounting total']; echo '</td> 
         <td>'; echo $table_content['accounting total90']; echo '</td> 
         <td>'; echo $table_content['accounting ct']; echo '</td> 
         <td>'; echo $table_content['accounting total final']; echo '</td> 
         <td>'; echo $table_content['accounting lg']; echo '</td> 
         <td>'; echo $table_content['accounting gp']; echo '</td> 
         
         </td> </tr>' ;
             
             
         
         
         endwhile;
     echo "</table> <br><br>"; 
   
     //accounting exam marks table ends

      //business organization exam marks table start
      include('conn.php');
      $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_business_organization_business.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_business_organization_business ON $exam_table_name.`Student ID`=ct_mark_business_organization_business.Student_ID) WHERE `year`='$year'");
      echo '<div id="bo"> <br><br><br><br></div>';  
          echo '<table class="studenttable" >
          <tr><th colspan="10">Business Organization and Management <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=business_organization" target="_blank">Print Marksheet</a></th></tr>
          <tr>
          <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
          </tr>'; 
      while($table_content = mysqli_fetch_array($result_info)):
          
      echo '<tr>
      <td>';  echo $table_content['Student ID']; echo '</td> 
      <td>'; echo $table_content['student_name']; echo '</td> 
      <td>'; echo $table_content['business_organization crtv']; echo '</td> 
      <td>'; echo $table_content['business_organization mcq']; echo '</td> 
      <td>'; echo $table_content['business_organization total']; echo '</td> 
      <td>'; echo $table_content['business_organization total90']; echo '</td> 
      <td>'; echo $table_content['business_organization ct']; echo '</td> 
      <td>'; echo $table_content['business_organization total final']; echo '</td> 
      <td>'; echo $table_content['business_organization lg']; echo '</td> 
      <td>'; echo $table_content['business_organization gp']; echo '</td> 
      
      </td> </tr>' ;
          
          
      
      
      endwhile;
  echo "</table> <br><br>"; 

  //business organization exam marks table ends


  //production management exam marks table start
  include('conn.php');
  $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_production_management_business.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_production_management_business ON $exam_table_name.`Student ID`=ct_mark_production_management_business.Student_ID) WHERE `year`='$year'");
  echo '<div id="pm"> <br><br><br><br></div>';  
      echo '<table class="studenttable">
      <tr><th colspan="10">Production Management and Marketing <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=production_management" target="_blank">Print Marksheet</a></th></tr>
      <tr>
      <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
      </tr>'; 
  while($table_content = mysqli_fetch_array($result_info)):
      
  echo '<tr>
  <td>';  echo $table_content['Student ID']; echo '</td> 
  <td>'; echo $table_content['student_name']; echo '</td> 
  <td>'; echo $table_content['production_management crtv']; echo '</td> 
  <td>'; echo $table_content['production_management mcq']; echo '</td> 
  <td>'; echo $table_content['production_management total']; echo '</td> 
  <td>'; echo $table_content['production_management total90']; echo '</td> 
  <td>'; echo $table_content['production_management ct']; echo '</td> 
  <td>'; echo $table_content['production_management total final']; echo '</td> 
  <td>'; echo $table_content['production_management lg']; echo '</td> 
  <td>'; echo $table_content['production_management gp']; echo '</td> 
  
  </td> </tr>' ;
      
      
  
  
  endwhile;
echo "</table> <br><br>"; 

//production management exam marks table ends


 //economics exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_economics_business.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_economics_business ON $exam_table_name.`Student ID`=ct_mark_economics_business.Student_ID) WHERE `year`='$year'");
 echo '<div id="eco"> <br><br><br><br></div>';  
     echo '<table class="studenttable" >
     <tr><th colspan="10">Economics <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics" target="_blank">Print Marksheet</a></th></tr>
     <tr>
     <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
     </tr>'; 
 while($table_content = mysqli_fetch_array($result_info)):
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['economics crtv']; echo '</td> 
 <td>'; echo $table_content['economics mcq']; echo '</td> 
 <td>'; echo $table_content['economics total']; echo '</td> 
 <td>'; echo $table_content['economics total90']; echo '</td> 
 <td>'; echo $table_content['economics ct']; echo '</td> 
 <td>'; echo $table_content['economics total final']; echo '</td> 
 <td>'; echo $table_content['economics lg']; echo '</td> 
 <td>'; echo $table_content['economics gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
echo "</table> <br><br>"; 

//economics exam marks table ends

//finance exam marks table start
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_finance_business.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_finance_business ON $exam_table_name.`Student ID`=ct_mark_finance_business.Student_ID) WHERE `year`='$year'");
echo '<div id="finance"> <br><br><br><br></div>';  
    echo '<table class="studenttable" >
    <tr><th colspan="10">Finance and Banking <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=finance" target="_blank">Print Marksheet</a></th></tr>
    <tr>
    <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
    </tr>'; 
while($table_content = mysqli_fetch_array($result_info)):
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['finance crtv']; echo '</td> 
<td>'; echo $table_content['finance mcq']; echo '</td> 
<td>'; echo $table_content['finance total']; echo '</td> 
<td>'; echo $table_content['finance total90']; echo '</td> 
<td>'; echo $table_content['finance ct']; echo '</td> 
<td>'; echo $table_content['finance total final']; echo '</td> 
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
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_civics_humanities.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_civics_humanities ON $exam_table_name.`Student ID`=ct_mark_civics_humanities.Student_ID) WHERE `year`='$year'");
echo '<div id="civics"> <br><br><br><br></div>';  
    echo '<table class="studenttable">
    <tr><th colspan="10">Civics <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=civics" target="_blank">Print Marksheet</a></th></tr>
    <tr>
    <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
    </tr>'; 
while($table_content = mysqli_fetch_array($result_info)):
    
echo '<tr>
<td>';  echo $table_content['Student ID']; echo '</td> 
<td>'; echo $table_content['student_name']; echo '</td> 
<td>'; echo $table_content['civics crtv']; echo '</td> 
<td>'; echo $table_content['civics mcq']; echo '</td> 
<td>'; echo $table_content['civics total']; echo '</td> 
<td>'; echo $table_content['civics total90']; echo '</td> 
<td>'; echo $table_content['civics ct']; echo '</td> 
<td>'; echo $table_content['civics total final']; echo '</td> 
<td>'; echo $table_content['civics lg']; echo '</td> 
<td>'; echo $table_content['civics gp']; echo '</td> 

</td> </tr>' ;
    
    


endwhile;
echo "</table> <br><br>"; 

//civics exam marks table ends

 //logic exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_logic_humanities.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_logic_humanities ON $exam_table_name.`Student ID`=ct_mark_logic_humanities.Student_ID) WHERE `year`='$year'");
 echo '<div id="logic"> <br><br><br><br></div>';  
     echo '<table class="studenttable">
     <tr><th colspan="10">Logic <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=logic" target="_blank">Print Marksheet</a></th></tr>
     <tr>
     <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
     </tr>'; 
 while($table_content = mysqli_fetch_array($result_info)):
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['logic crtv']; echo '</td> 
 <td>'; echo $table_content['logic mcq']; echo '</td> 
 <td>'; echo $table_content['logic total']; echo '</td> 
 <td>'; echo $table_content['logic total90']; echo '</td> 
 <td>'; echo $table_content['logic ct']; echo '</td> 
 <td>'; echo $table_content['logic total final']; echo '</td> 
 <td>'; echo $table_content['logic lg']; echo '</td> 
 <td>'; echo $table_content['logic gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 
 //logic exam marks table ends

 //sociology exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_sociology_humanities.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_sociology_humanities ON $exam_table_name.`Student ID`=ct_mark_sociology_humanities.Student_ID) WHERE `year`='$year'");
 echo '<div id="sociology"> <br><br><br><br></div>';  
     echo '<table class="studenttable" >
     <tr><th colspan="10">Sociology <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=sociology" target="_blank">Print Marksheet</a></th></tr>
     <tr>
     <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
     </tr>'; 
 while($table_content = mysqli_fetch_array($result_info)):
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['sociology crtv']; echo '</td> 
 <td>'; echo $table_content['sociology mcq']; echo '</td> 
 <td>'; echo $table_content['sociology total']; echo '</td> 
 <td>'; echo $table_content['sociology total90']; echo '</td> 
 <td>'; echo $table_content['sociology ct']; echo '</td> 
 <td>'; echo $table_content['sociology total final']; echo '</td> 
 <td>'; echo $table_content['sociology lg']; echo '</td> 
 <td>'; echo $table_content['sociology gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 
 //sociology exam marks table ends

 //islamic history exam marks table start
 include('conn.php');
 $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_islamic_history_humanities.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_islamic_history_humanities ON $exam_table_name.`Student ID`=ct_mark_islamic_history_humanities.Student_ID) WHERE `year`='$year'");
 echo '<div id="ih"> <br><br><br><br></div>';  
     echo '<table class="studenttable">
     <tr><th colspan="10">Islamic History <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=islamic_history" target="_blank">Print Marksheet</a></th></tr>
     <tr>
     <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
     </tr>'; 
 while($table_content = mysqli_fetch_array($result_info)):
     
 echo '<tr>
 <td>';  echo $table_content['Student ID']; echo '</td> 
 <td>'; echo $table_content['student_name']; echo '</td> 
 <td>'; echo $table_content['islamic_history crtv']; echo '</td> 
 <td>'; echo $table_content['islamic_history mcq']; echo '</td> 
 <td>'; echo $table_content['islamic_history total']; echo '</td> 
 <td>'; echo $table_content['islamic_history total90']; echo '</td> 
 <td>'; echo $table_content['islamic_history ct']; echo '</td> 
 <td>'; echo $table_content['islamic_history total final']; echo '</td> 
 <td>'; echo $table_content['islamic_history lg']; echo '</td> 
 <td>'; echo $table_content['islamic_history gp']; echo '</td> 
 
 </td> </tr>' ;
     
     
 
 
 endwhile;
 echo "</table> <br><br>"; 
 
 //islamic history exam marks table ends

  //economics exam marks table start
  include('conn.php');
  $result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year`,ct_mark_economics_humanities.Student_ID FROM (($exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id) INNER JOIN ct_mark_economics_humanities ON $exam_table_name.`Student ID`=ct_mark_economics_humanities.Student_ID) WHERE `year`='$year'");
  echo '<div id="economics"> <br><br><br><br></div>';  
      echo '<table class="studenttable">
      <tr><th colspan="10">Economics <a href="marksheet.php?exam='.$exam_name.'&group='.$group.'&year='.$year.'&subject=economics" target="_blank">Print Marksheet</a></th></tr>
      <tr>
      <th>Student ID</th><th>Student Name</th><th>Creative</th><th>MCQ</th><th>Total (100%)</th><th>Total (90%)</th><th>Class Test</th><th>Total</th><th>Letter Grade</th><th>Grade Point</th>
      </tr>'; 
  while($table_content = mysqli_fetch_array($result_info)):
      
  echo '<tr>
  <td>';  echo $table_content['Student ID']; echo '</td> 
  <td>'; echo $table_content['student_name']; echo '</td> 
  <td>'; echo $table_content['economics crtv']; echo '</td> 
  <td>'; echo $table_content['economics mcq']; echo '</td> 
  <td>'; echo $table_content['economics total']; echo '</td> 
  <td>'; echo $table_content['economics total90']; echo '</td> 
  <td>'; echo $table_content['economics ct']; echo '</td> 
  <td>'; echo $table_content['economics total final']; echo '</td> 
  <td>'; echo $table_content['economics lg']; echo '</td> 
  <td>'; echo $table_content['economics gp']; echo '</td> 
  
  </td> </tr>' ;
      
      
  
  
  endwhile;
  echo "</table> <br><br>"; 
  
  //economics exam marks table ends

 //result table starts
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`year` FROM $exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id WHERE `year`='$year'");
echo '<div id="result"> <br><br><br><br></div>'; 
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
