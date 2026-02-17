
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
                    
                        $group = $_GET['group'];
                        $student_id = $_GET['student_id'];
                        $table_name = 'student_info_' . $group;
                        $first_year_first_term='1st_year_1st_term_'.$group;
                        $first_year_second_term='1st_year_2nd_term_'.$group;
                        $first_year_final='1st_year_final_'.$group;
                        $pre_test='pre_test_'.$group;
                        $test='test_'.$group;

                        include('conn.php');
                        $fyft_table = mysqli_query($conn,"SELECT * FROM `$first_year_first_term` WHERE `Student ID` ='$student_id'");
                        $fyst_table= mysqli_query($conn,"SELECT * FROM $first_year_second_term WHERE `Student ID` ='$student_id'");
                        $fyf_table= mysqli_query($conn,"SELECT * FROM $first_year_final WHERE `Student ID` ='$student_id'");
                        $pt_table= mysqli_query($conn,"SELECT * FROM $pre_test WHERE `Student ID` ='$student_id'");
                        $t_table= mysqli_query($conn,"SELECT * FROM $test WHERE `Student ID` ='$student_id'");
                        

                        $fyft = mysqli_fetch_array($fyft_table);
                        $fyst= mysqli_fetch_array($fyst_table);
                        $fyf= mysqli_fetch_array($fyf_table);
                        $pt= mysqli_fetch_array($pt_table);
                        $t= mysqli_fetch_array($t_table);


                        $student_table='student_info_'.$group;
                        $subject_table= mysqli_query($conn,"SELECT * FROM $student_table WHERE `student_id` ='$student_id'");
                        $subjects=mysqli_fetch_array($subject_table);
                        $student_name=$subjects['student_name'];
                        $subject1= $subjects['subject1'];
                        $subject2= $subjects['subject2'];
                        $subject3= $subjects['subject3'];
                        $fourth_sub= $subjects['fourth_sub'];
                        
                       
                                     
                ?>
                   
                   <div class="info_container">
                    <div style="text-align:center;"> <?php echo $student_name;?><div>
                    <!-- Bangla starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="8">Bangla</th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft['bangla crtv'] ?></td><td><?php echo $fyft['bangla mcq'] ?></td><td><?php echo $fyft['bangla total'] ?></td><td><?php echo $fyft['bangla total90'] ?></td><td><?php echo $fyft['bangla ct'] ?></td><td><?php echo $fyft['bangla total final'] ?></td><td><?php echo $fyft['bangla lg'] ?></td><td><?php echo number_format($fyft['bangla gp'],2); ?></td>
                        </tr>
                        <tr>
                        <td>1st Year 2nd Term</td><td><?php echo $fyst['bangla crtv'] ?></td><td><?php echo $fyst['bangla mcq'] ?></td><td><?php echo $fyst['bangla total'] ?></td><td><?php echo $fyst['bangla total90'] ?></td><td><?php echo $fyst['bangla ct'] ?></td><td><?php echo $fyst['bangla total final'] ?></td><td><?php echo $fyst['bangla lg'] ?></td><td><?php echo number_format($fyst['bangla gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>1st Year final</td><td><?php echo $fyf['bangla crtv'] ?></td><td><?php echo $fyf['bangla mcq'] ?></td><td><?php echo $fyf['bangla total'] ?></td><td><?php echo $fyf['bangla total90'] ?></td><td><?php echo $fyf['bangla ct'] ?></td><td><?php echo $fyf['bangla total final'] ?></td><td><?php echo $fyf['bangla lg'] ?></td><td><?php echo number_format($fyf['bangla gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>Pre Test</td><td><?php echo $pt['bangla'] ?></td><td></td><td></td><td></td><td><?php echo $pt['bangla ct'] ?></td><td><?php echo $pt['bangla total final'] ?></td><td><?php echo $pt['bangla lg'] ?></td><td><?php echo number_format($pt['bangla gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t['bangla1 crtv'] ?></td><td><?php echo $t['bangla1 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t['bangla1 total'] ?></td><td rowspan="2"><?php echo $t['bangla lg'] ?></td><td rowspan="2"><?php echo number_format($t['bangla gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t['bangla2'] ?></td><td></td><td></td><td></td><td></td><td><?php echo $t['bangla2 total'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- Bangla Ends -->
                      <!-- English starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="6">English</th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft['english'] ?></td><td><?php echo $fyft['english90'] ?></td><td><?php echo $fyft['english ct'] ?></td><td><?php echo $fyft['english total final'] ?></td><td><?php echo $fyft['english lg'] ?></td><td><?php echo number_format($fyft['english gp'],2); ?></td>
                        </tr>
                        <tr>
                             <td>1st Year 2nd Term</td><td><?php echo $fyst['english'] ?></td><td><?php echo $fyst['english90'] ?></td><td><?php echo $fyst['english ct'] ?></td><td><?php echo $fyst['english total final'] ?></td><td><?php echo $fyst['english lg'] ?></td><td><?php echo number_format($fyst['english gp'],2); ?></td>
                        </tr>
                        <tr>
                             <td>1st Year Final</td><td><?php echo $fyf['english'] ?></td><td><?php echo $fyf['english90'] ?></td><td><?php echo $fyf['english ct'] ?></td><td><?php echo $fyf['english total final'] ?></td><td><?php echo $fyf['english lg'] ?></td><td><?php echo number_format($fyf['english gp'],2); ?></td>
                        </tr>
                        <tr>
                             <td>Pre Test</td><td><?php echo $pt['english'] ?></td><td><?php echo $pt['english90'] ?></td><td><?php echo $pt['english ct'] ?></td><td><?php echo $pt['english total final'] ?></td><td><?php echo $pt['english lg'] ?></td><td><?php echo number_format($pt['english gp'],2); ?></td>
                       
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t['english1'] ?></td><td></td><td></td><td><?php echo $t['english1'] ?></td><td rowspan="2"><?php echo $t['english lg'] ?></td><td rowspan="2"><?php echo number_format($t['english gp'],2); ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t['english2'] ?></td><td></td><td></td><td><?php echo $t['english2'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- English Ends -->

                     <!-- ict starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="9">ICT</th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Prac</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft['ict crtv'] ?></td><td><?php echo $fyft['ict mcq'] ?></td><td><?php echo $fyft['ict prac'] ?></td><td><?php echo $fyft['ict total'] ?></td><td><?php echo $fyft['ict total90'] ?></td><td><?php echo $fyft['ict ct'] ?></td><td><?php echo $fyft['ict total final'] ?></td><td><?php echo $fyft['ict lg'] ?></td><td><?php echo number_format($fyft['ict gp'],2); ?></td>
                        </tr>
                        <tr>
                             <td>1st Year 2nd Term</td><td><?php echo $fyst['ict crtv'] ?></td><td><?php echo $fyst['ict mcq'] ?></td><td><?php echo $fyst['ict prac'] ?></td><td><?php echo $fyst['ict total'] ?></td><td><?php echo $fyst['ict total90'] ?></td><td><?php echo $fyst['ict ct'] ?></td><td><?php echo $fyst['ict total final'] ?></td><td><?php echo $fyst['ict lg'] ?></td><td><?php echo number_format($fyst['ict gp'],2); ?></td>
                        
                        </tr>
                        <tr>
                             <td>1st Year Final</td><td><?php echo $fyf['ict crtv'] ?></td><td><?php echo $fyf['ict mcq'] ?></td><td><?php echo $fyf['ict prac'] ?></td><td><?php echo $fyf['ict total'] ?></td><td><?php echo $fyf['ict total90'] ?></td><td><?php echo $fyf['ict ct'] ?></td><td><?php echo $fyf['ict total final'] ?></td><td><?php echo $fyf['ict lg'] ?></td><td><?php echo number_format($fyf['ict gp'],2); ?></td>
                        </tr>
                        <tr>
                             <td>Pre Test</td><td><?php echo $pt['ict crtv'] ?></td><td><?php echo $pt['ict mcq'] ?></td><td><?php echo $pt['ict prac'] ?></td><td><?php echo $pt['ict total'] ?></td><td><?php echo $pt['ict total90'] ?></td><td><?php echo $pt['ict ct'] ?></td><td><?php echo $pt['ict total final'] ?></td><td><?php echo $pt['ict lg'] ?></td><td><?php echo number_format($pt['ict gp'],2); ?></td>
                        </tr>
                        <tr>
                            <td>Test</td><td><?php echo $t['ict crtv'] ?></td><td><?php echo $t['ict mcq'] ?></td><td><?php echo $t['ict prac'] ?></td><td><?php echo $t['ict total'] ?></td><td></td><td></td><td><?php echo $t['ict total'] ?></td><td><?php echo $t['ict lg'] ?></td><td><?php echo number_format($t['ict gp'],2); ?></td>
                        </tr>
                       

                    </table>
                    <br>
                     <!-- ict Ends -->

                     <!-- science subjects -->
                     <?php if($group=="science"): ?>
                             <!-- subject1 starts -->
                            <table>
                                <tr>
                                    <th rowspan="2">Exam Name</th><th colspan="9"><?php echo $subject1; ?></th>
                                </tr>
                                <tr>
                                    <th>Creative</th><th>MCQ</th><th>Prac</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                                </tr>
                                <tr>
                                    <td>1st Year 1st Term</td><td><?php echo $fyft[$subject1.' crtv'] ?></td><td><?php echo $fyft[$subject1.' mcq'] ?></td><td><?php echo $fyft[$subject1.' prac'] ?></td><td><?php echo $fyft[$subject1.' total'] ?></td><td><?php echo $fyft[$subject1.' total90'] ?></td><td><?php echo $fyft[$subject1.' ct'] ?></td><td><?php echo $fyft[$subject1.' total final'] ?></td><td><?php echo $fyft[$subject1.' lg'] ?></td><td><?php echo number_format($fyft[$subject1.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                  <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject1.' crtv'] ?></td><td><?php echo $fyst[$subject1.' mcq'] ?></td><td><?php echo $fyst[$subject1.' prac'] ?></td><td><?php echo $fyst[$subject1.' total'] ?></td><td><?php echo $fyst[$subject1.' total90'] ?></td><td><?php echo $fyst[$subject1.' ct'] ?></td><td><?php echo $fyst[$subject1.' total final'] ?></td><td><?php echo $fyst[$subject1.' lg'] ?></td><td><?php echo number_format($fyst[$subject1.' gp'],2); ?></td>
                                
                                </tr>
                                <tr>
                                     <td>1st Year Final</td><td><?php echo $fyf[$subject1.' crtv'] ?></td><td><?php echo $fyf[$subject1.' mcq'] ?></td><td><?php echo $fyf[$subject1.' prac'] ?></td><td><?php echo $fyf[$subject1.' total'] ?></td><td><?php echo $fyf[$subject1.' total90'] ?></td><td><?php echo $fyf[$subject1.' ct'] ?></td><td><?php echo $fyf[$subject1.' total final'] ?></td><td><?php echo $fyf[$subject1.' lg'] ?></td><td><?php echo number_format($fyf[$subject1.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                      <td>Pre Test</td><td><?php echo $pt[$subject1.' crtv'] ?></td><td><?php echo $pt[$subject1.' mcq'] ?></td><td><?php echo $pt[$subject1.' prac'] ?></td><td><?php echo $pt[$subject1.' total'] ?></td><td><?php echo $pt[$subject1.' total90'] ?></td><td><?php echo $pt[$subject1.' ct'] ?></td><td><?php echo $pt[$subject1.' total final'] ?></td><td><?php echo $pt[$subject1.' lg'] ?></td><td><?php echo number_format($pt[$subject1.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                    <td>Test(1st part)</td><td><?php echo $t[$subject1.'1 crtv'] ?></td><td><?php echo $t[$subject1.'1 mcq'] ?></td><td><?php echo $t[$subject1.'1 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject1.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject1.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject1.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                    <td>Test(2nd part)</td><td><?php echo $t[$subject1.'2 crtv'] ?></td><td><?php echo $t[$subject1.'2 mcq'] ?></td><td><?php echo $t[$subject1.'2 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject1.'2 total'] ?></td>
                                </tr>

                            </table>
                    <br>
                     <!-- subject1 Ends -->

                      <!-- subject2 starts -->
                      <table>
                                <tr>
                                    <th rowspan="2">Exam Name</th><th colspan="9"><?php echo $subject2; ?></th>
                                </tr>
                                <tr>
                                    <th>Creative</th><th>MCQ</th><th>Prac</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                                </tr>
                                <tr>
                                    <td>1st Year 1st Term</td><td><?php echo $fyft[$subject2.' crtv'] ?></td><td><?php echo $fyft[$subject2.' mcq'] ?></td><td><?php echo $fyft[$subject2.' prac'] ?></td><td><?php echo $fyft[$subject2.' total'] ?></td><td><?php echo $fyft[$subject2.' total90'] ?></td><td><?php echo $fyft[$subject2.' ct'] ?></td><td><?php echo $fyft[$subject2.' total final'] ?></td><td><?php echo $fyft[$subject2.' lg'] ?></td><td><?php echo number_format($fyft[$subject2.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                  <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject2.' crtv'] ?></td><td><?php echo $fyst[$subject2.' mcq'] ?></td><td><?php echo $fyst[$subject2.' prac'] ?></td><td><?php echo $fyst[$subject2.' total'] ?></td><td><?php echo $fyst[$subject2.' total90'] ?></td><td><?php echo $fyst[$subject2.' ct'] ?></td><td><?php echo $fyst[$subject2.' total final'] ?></td><td><?php echo $fyst[$subject2.' lg'] ?></td><td><?php echo number_format($fyst[$subject2.' gp'],2); ?></td>
                                
                                </tr>
                                <tr>
                                     <td>1st Year Final</td><td><?php echo $fyf[$subject2.' crtv'] ?></td><td><?php echo $fyf[$subject2.' mcq'] ?></td><td><?php echo $fyf[$subject2.' prac'] ?></td><td><?php echo $fyf[$subject2.' total'] ?></td><td><?php echo $fyf[$subject2.' total90'] ?></td><td><?php echo $fyf[$subject2.' ct'] ?></td><td><?php echo $fyf[$subject2.' total final'] ?></td><td><?php echo $fyf[$subject2.' lg'] ?></td><td><?php echo number_format($fyf[$subject2.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                      <td>Pre Test</td><td><?php echo $pt[$subject2.' crtv'] ?></td><td><?php echo $pt[$subject2.' mcq'] ?></td><td><?php echo $pt[$subject2.' prac'] ?></td><td><?php echo $pt[$subject2.' total'] ?></td><td><?php echo $pt[$subject2.' total90'] ?></td><td><?php echo $pt[$subject2.' ct'] ?></td><td><?php echo $pt[$subject2.' total final'] ?></td><td><?php echo $pt[$subject2.' lg'] ?></td><td><?php echo number_format($pt[$subject2.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                    <td>Test(1st part)</td><td><?php echo $t[$subject2.'1 crtv'] ?></td><td><?php echo $t[$subject2.'1 mcq'] ?></td><td><?php echo $t[$subject2.'1 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject2.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject2.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject2.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                    <td>Test(2nd part)</td><td><?php echo $t[$subject2.'2 crtv'] ?></td><td><?php echo $t[$subject2.'2 mcq'] ?></td><td><?php echo $t[$subject2.'2 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject2.'2 total'] ?></td>
                                </tr>

                            </table>
                    <br>
                     <!-- subject2 Ends -->

                     <!-- subject3 starts -->
                     <table>
                                <tr>
                                    <th rowspan="2">Exam Name</th><th colspan="9"><?php echo $subject3; ?></th>
                                </tr>
                                <tr>
                                    <th>Creative</th><th>MCQ</th><th>Prac</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                                </tr>
                                <tr>
                                    <td>1st Year 1st Term</td><td><?php echo $fyft[$subject3.' crtv'] ?></td><td><?php echo $fyft[$subject3.' mcq'] ?></td><td><?php echo $fyft[$subject3.' prac'] ?></td><td><?php echo $fyft[$subject3.' total'] ?></td><td><?php echo $fyft[$subject3.' total90'] ?></td><td><?php echo $fyft[$subject3.' ct'] ?></td><td><?php echo $fyft[$subject3.' total final'] ?></td><td><?php echo $fyft[$subject3.' lg'] ?></td><td><?php echo number_format($fyft[$subject3.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                  <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject3.' crtv'] ?></td><td><?php echo $fyst[$subject3.' mcq'] ?></td><td><?php echo $fyst[$subject3.' prac'] ?></td><td><?php echo $fyst[$subject3.' total'] ?></td><td><?php echo $fyst[$subject3.' total90'] ?></td><td><?php echo $fyst[$subject3.' ct'] ?></td><td><?php echo $fyst[$subject3.' total final'] ?></td><td><?php echo $fyst[$subject3.' lg'] ?></td><td><?php echo number_format($fyst[$subject3.' gp'],2); ?></td>
                                
                                </tr>
                                <tr>
                                     <td>1st Year Final</td><td><?php echo $fyf[$subject3.' crtv'] ?></td><td><?php echo $fyf[$subject3.' mcq'] ?></td><td><?php echo $fyf[$subject3.' prac'] ?></td><td><?php echo $fyf[$subject3.' total'] ?></td><td><?php echo $fyf[$subject3.' total90'] ?></td><td><?php echo $fyf[$subject3.' ct'] ?></td><td><?php echo $fyf[$subject3.' total final'] ?></td><td><?php echo $fyf[$subject3.' lg'] ?></td><td><?php echo number_format($fyf[$subject3.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                      <td>Pre Test</td><td><?php echo $pt[$subject3.' crtv'] ?></td><td><?php echo $pt[$subject3.' mcq'] ?></td><td><?php echo $pt[$subject3.' prac'] ?></td><td><?php echo $pt[$subject3.' total'] ?></td><td><?php echo $pt[$subject3.' total90'] ?></td><td><?php echo $pt[$subject3.' ct'] ?></td><td><?php echo $pt[$subject3.' total final'] ?></td><td><?php echo $pt[$subject3.' lg'] ?></td><td><?php echo number_format($pt[$subject3.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                    <td>Test(1st part)</td><td><?php echo $t[$subject3.'1 crtv'] ?></td><td><?php echo $t[$subject3.'1 mcq'] ?></td><td><?php echo $t[$subject3.'1 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject3.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject3.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject3.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                    <td>Test(2nd part)</td><td><?php echo $t[$subject3.'2 crtv'] ?></td><td><?php echo $t[$subject3.'2 mcq'] ?></td><td><?php echo $t[$subject3.'2 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject3.'2 total'] ?></td>
                                </tr>

                            </table>
                    <br>
                     <!-- subject3 Ends -->

                      <!-- fourth sub starts -->
                      <table>
                                <tr>
                                    <th rowspan="2">Exam Name</th><th colspan="9"><?php echo $fourth_sub; ?></th>
                                </tr>
                                <tr>
                                    <th>Creative</th><th>MCQ</th><th>Prac</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                                </tr>
                                <tr>
                                    <td>1st Year 1st Term</td><td><?php echo $fyft[$fourth_sub.' crtv'] ?></td><td><?php echo $fyft[$fourth_sub.' mcq'] ?></td><td><?php echo $fyft[$fourth_sub.' prac'] ?></td><td><?php echo $fyft[$fourth_sub.' total'] ?></td><td><?php echo $fyft[$fourth_sub.' total90'] ?></td><td><?php echo $fyft[$fourth_sub.' ct'] ?></td><td><?php echo $fyft[$fourth_sub.' total final'] ?></td><td><?php echo $fyft[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyft[$fourth_sub.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                  <td>1st Year 2nd Term</td><td><?php echo $fyst[$fourth_sub.' crtv'] ?></td><td><?php echo $fyst[$fourth_sub.' mcq'] ?></td><td><?php echo $fyst[$fourth_sub.' prac'] ?></td><td><?php echo $fyst[$fourth_sub.' total'] ?></td><td><?php echo $fyst[$fourth_sub.' total90'] ?></td><td><?php echo $fyst[$fourth_sub.' ct'] ?></td><td><?php echo $fyst[$fourth_sub.' total final'] ?></td><td><?php echo $fyst[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyst[$fourth_sub.' gp'],2); ?></td>
                                
                                </tr>
                                <tr>
                                     <td>1st Year Final</td><td><?php echo $fyf[$fourth_sub.' crtv'] ?></td><td><?php echo $fyf[$fourth_sub.' mcq'] ?></td><td><?php echo $fyf[$fourth_sub.' prac'] ?></td><td><?php echo $fyf[$fourth_sub.' total'] ?></td><td><?php echo $fyf[$fourth_sub.' total90'] ?></td><td><?php echo $fyf[$fourth_sub.' ct'] ?></td><td><?php echo $fyf[$fourth_sub.' total final'] ?></td><td><?php echo $fyf[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyf[$fourth_sub.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                      <td>Pre Test</td><td><?php echo $pt[$fourth_sub.' crtv'] ?></td><td><?php echo $pt[$fourth_sub.' mcq'] ?></td><td><?php echo $pt[$fourth_sub.' prac'] ?></td><td><?php echo $pt[$fourth_sub.' total'] ?></td><td><?php echo $pt[$fourth_sub.' total90'] ?></td><td><?php echo $pt[$fourth_sub.' ct'] ?></td><td><?php echo $pt[$fourth_sub.' total final'] ?></td><td><?php echo $pt[$fourth_sub.' lg'] ?></td><td><?php echo number_format($pt[$fourth_sub.' gp'],2); ?></td>
                                    
                                </tr>
                                <tr>
                                    <td>Test(1st part)</td><td><?php echo $t[$fourth_sub.'1 crtv'] ?></td><td><?php echo $t[$fourth_sub.'1 mcq'] ?></td><td><?php echo $t[$fourth_sub.'1 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$fourth_sub.'1 total'] ?></td><td rowspan="2"><?php echo $t[$fourth_sub.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$fourth_sub.' gp'],2); ?></td>
                                </tr>
                                <tr>
                                    <td>Test(2nd part)</td><td><?php echo $t[$fourth_sub.'2 crtv'] ?></td><td><?php echo $t[$fourth_sub.'2 mcq'] ?></td><td><?php echo $t[$fourth_sub.'2 prac'] ?></td><td></td><td></td><td></td><td><?php echo $t[$fourth_sub.'2 total'] ?></td>
                                </tr>

                            </table>
                    <br>
                     <!-- fourth sub Ends -->
                      <!-- science sub Ends -->

                      <?php else: ?>
                         <!-- subject1 starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="8"><?php echo $subject1; ?></th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft[$subject1.' crtv'] ?></td><td><?php echo $fyft[$subject1.' mcq'] ?></td><td><?php echo $fyft[$subject1.' total'] ?></td><td><?php echo $fyft[$subject1.' total90'] ?></td><td><?php echo $fyft[$subject1.' ct'] ?></td><td><?php echo $fyft[$subject1.' total final'] ?></td><td><?php echo $fyft[$subject1.' lg'] ?></td><td><?php echo number_format($fyft[$subject1.' gp'],2); ?></td>
                        </tr>
                        <tr>
                        <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject1.' crtv'] ?></td><td><?php echo $fyst[$subject1.' mcq'] ?></td><td><?php echo $fyst[$subject1.' total'] ?></td><td><?php echo $fyst[$subject1.' total90'] ?></td><td><?php echo $fyst[$subject1.' ct'] ?></td><td><?php echo $fyst[$subject1.' total final'] ?></td><td><?php echo $fyst[$subject1.' lg'] ?></td><td><?php echo number_format($fyst[$subject1.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>1st Year final</td><td><?php echo $fyf[$subject1.' crtv'] ?></td><td><?php echo $fyf[$subject1.' mcq'] ?></td><td><?php echo $fyf[$subject1.' total'] ?></td><td><?php echo $fyf[$subject1.' total90'] ?></td><td><?php echo $fyf[$subject1.' ct'] ?></td><td><?php echo $fyf[$subject1.' total final'] ?></td><td><?php echo $fyf[$subject1.' lg'] ?></td><td><?php echo number_format($fyf[$subject1.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>Pre Test</td><td><?php echo $pt[$subject1.' crtv'] ?></td><td><?php echo $pt[$subject1.' mcq'] ?></td><td><?php echo $pt[$subject1.' total'] ?></td><td><?php echo $pt[$subject1.' total90'] ?></td><td><?php echo $pt[$subject1.' ct'] ?></td><td><?php echo $pt[$subject1.' total final'] ?></td><td><?php echo $pt[$subject1.' lg'] ?></td><td><?php echo number_format($pt[$subject1.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t[$subject1.'1 crtv'] ?></td><td><?php echo $t[$subject1.'1 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject1.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject1.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject1.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t[$subject1.'2 crtv'] ?></td><td><?php echo $t[$subject1.'2 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject1.'2 total'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- subject1 Ends -->
                      <!-- subject2 starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="8"><?php echo $subject2; ?></th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft[$subject2.' crtv'] ?></td><td><?php echo $fyft[$subject2.' mcq'] ?></td><td><?php echo $fyft[$subject2.' total'] ?></td><td><?php echo $fyft[$subject2.' total90'] ?></td><td><?php echo $fyft[$subject2.' ct'] ?></td><td><?php echo $fyft[$subject2.' total final'] ?></td><td><?php echo $fyft[$subject2.' lg'] ?></td><td><?php echo number_format($fyft[$subject2.' gp'],2); ?></td>
                        </tr>
                        <tr>
                        <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject2.' crtv'] ?></td><td><?php echo $fyst[$subject2.' mcq'] ?></td><td><?php echo $fyst[$subject2.' total'] ?></td><td><?php echo $fyst[$subject2.' total90'] ?></td><td><?php echo $fyst[$subject2.' ct'] ?></td><td><?php echo $fyst[$subject2.' total final'] ?></td><td><?php echo $fyst[$subject2.' lg'] ?></td><td><?php echo number_format($fyst[$subject2.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>1st Year final</td><td><?php echo $fyf[$subject2.' crtv'] ?></td><td><?php echo $fyf[$subject2.' mcq'] ?></td><td><?php echo $fyf[$subject2.' total'] ?></td><td><?php echo $fyf[$subject2.' total90'] ?></td><td><?php echo $fyf[$subject2.' ct'] ?></td><td><?php echo $fyf[$subject2.' total final'] ?></td><td><?php echo $fyf[$subject2.' lg'] ?></td><td><?php echo number_format($fyf[$subject2.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>Pre Test</td><td><?php echo $pt[$subject2.' crtv'] ?></td><td><?php echo $pt[$subject2.' mcq'] ?></td><td><?php echo $pt[$subject2.' total'] ?></td><td><?php echo $pt[$subject2.' total90'] ?></td><td><?php echo $pt[$subject2.' ct'] ?></td><td><?php echo $pt[$subject2.' total final'] ?></td><td><?php echo $pt[$subject2.' lg'] ?></td><td><?php echo number_format($pt[$subject2.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t[$subject2.'1 crtv'] ?></td><td><?php echo $t[$subject2.'1 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject2.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject2.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject2.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t[$subject2.'2 crtv'] ?></td><td><?php echo $t[$subject2.'2 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject2.'2 total'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- subject2 Ends -->
                       <!-- subject3 starts -->
                    <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="8"><?php echo $subject3; ?></th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft[$subject3.' crtv'] ?></td><td><?php echo $fyft[$subject3.' mcq'] ?></td><td><?php echo $fyft[$subject3.' total'] ?></td><td><?php echo $fyft[$subject3.' total90'] ?></td><td><?php echo $fyft[$subject3.' ct'] ?></td><td><?php echo $fyft[$subject3.' total final'] ?></td><td><?php echo $fyft[$subject3.' lg'] ?></td><td><?php echo number_format($fyft[$subject3.' gp'],2); ?></td>
                        </tr>
                        <tr>
                        <td>1st Year 2nd Term</td><td><?php echo $fyst[$subject3.' crtv'] ?></td><td><?php echo $fyst[$subject3.' mcq'] ?></td><td><?php echo $fyst[$subject3.' total'] ?></td><td><?php echo $fyst[$subject3.' total90'] ?></td><td><?php echo $fyst[$subject3.' ct'] ?></td><td><?php echo $fyst[$subject3.' total final'] ?></td><td><?php echo $fyst[$subject3.' lg'] ?></td><td><?php echo number_format($fyst[$subject3.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>1st Year final</td><td><?php echo $fyf[$subject3.' crtv'] ?></td><td><?php echo $fyf[$subject3.' mcq'] ?></td><td><?php echo $fyf[$subject3.' total'] ?></td><td><?php echo $fyf[$subject3.' total90'] ?></td><td><?php echo $fyf[$subject3.' ct'] ?></td><td><?php echo $fyf[$subject3.' total final'] ?></td><td><?php echo $fyf[$subject3.' lg'] ?></td><td><?php echo number_format($fyf[$subject3.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>Pre Test</td><td><?php echo $pt[$subject3.' crtv'] ?></td><td><?php echo $pt[$subject3.' mcq'] ?></td><td><?php echo $pt[$subject3.' total'] ?></td><td><?php echo $pt[$subject3.' total90'] ?></td><td><?php echo $pt[$subject3.' ct'] ?></td><td><?php echo $pt[$subject3.' total final'] ?></td><td><?php echo $pt[$subject3.' lg'] ?></td><td><?php echo number_format($pt[$subject3.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t[$subject3.'1 crtv'] ?></td><td><?php echo $t[$subject3.'1 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject3.'1 total'] ?></td><td rowspan="2"><?php echo $t[$subject3.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$subject3.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t[$subject3.'2 crtv'] ?></td><td><?php echo $t[$subject3.'2 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$subject3.'2 total'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- subject3 Ends -->
                     <!-- fourth sub starts -->
                     <table>
                        <tr>
                            <th rowspan="2">Exam Name</th><th colspan="8"><?php echo $fourth_sub; ?></th>
                        </tr>
                        <tr>
                            <th>Creative</th><th>MCQ</th><th>Total(100%)</th><th>Total(90%)</th><th>CT</th><th>Total</th><th>LG</th><th>GP</th>
                        </tr>
                        <tr>
                            <td>1st Year 1st Term</td><td><?php echo $fyft[$fourth_sub.' crtv'] ?></td><td><?php echo $fyft[$fourth_sub.' mcq'] ?></td><td><?php echo $fyft[$fourth_sub.' total'] ?></td><td><?php echo $fyft[$fourth_sub.' total90'] ?></td><td><?php echo $fyft[$fourth_sub.' ct'] ?></td><td><?php echo $fyft[$fourth_sub.' total final'] ?></td><td><?php echo $fyft[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyft[$fourth_sub.' gp'],2); ?></td>
                        </tr>
                        <tr>
                        <td>1st Year 2nd Term</td><td><?php echo $fyst[$fourth_sub.' crtv'] ?></td><td><?php echo $fyst[$fourth_sub.' mcq'] ?></td><td><?php echo $fyst[$fourth_sub.' total'] ?></td><td><?php echo $fyst[$fourth_sub.' total90'] ?></td><td><?php echo $fyst[$fourth_sub.' ct'] ?></td><td><?php echo $fyst[$fourth_sub.' total final'] ?></td><td><?php echo $fyst[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyst[$fourth_sub.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>1st Year final</td><td><?php echo $fyf[$fourth_sub.' crtv'] ?></td><td><?php echo $fyf[$fourth_sub.' mcq'] ?></td><td><?php echo $fyf[$fourth_sub.' total'] ?></td><td><?php echo $fyf[$fourth_sub.' total90'] ?></td><td><?php echo $fyf[$fourth_sub.' ct'] ?></td><td><?php echo $fyf[$fourth_sub.' total final'] ?></td><td><?php echo $fyf[$fourth_sub.' lg'] ?></td><td><?php echo number_format($fyf[$fourth_sub.' gp'],2) ?></td>
                        </tr>
                        <tr>
                        <td>Pre Test</td><td><?php echo $pt[$fourth_sub.' crtv'] ?></td><td><?php echo $pt[$fourth_sub.' mcq'] ?></td><td><?php echo $pt[$fourth_sub.' total'] ?></td><td><?php echo $pt[$fourth_sub.' total90'] ?></td><td><?php echo $pt[$fourth_sub.' ct'] ?></td><td><?php echo $pt[$fourth_sub.' total final'] ?></td><td><?php echo $pt[$fourth_sub.' lg'] ?></td><td><?php echo number_format($pt[$fourth_sub.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(1st part)</td><td><?php echo $t[$fourth_sub.'1 crtv'] ?></td><td><?php echo $t[$fourth_sub.'1 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$fourth_sub.'1 total'] ?></td><td rowspan="2"><?php echo $t[$fourth_sub.' lg'] ?></td><td rowspan="2"><?php echo number_format($t[$fourth_sub.' gp'],2) ?></td>
                        </tr>
                        <tr>
                            <td>Test(2nd part)</td><td><?php echo $t[$fourth_sub.'2 crtv'] ?></td><td><?php echo $t[$fourth_sub.'2 mcq'] ?></td><td></td><td></td><td></td><td><?php echo $t[$fourth_sub.'2 total'] ?></td>
                        </tr>

                    </table>
                    <br>
                     <!-- fourth sub Ends -->
                   
                   
                   




                       <?php endif; ?>
                     


                     
                   </div>
                   
            </div>

            
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>
