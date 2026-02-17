
<?php

session_start();
include('conn.php');
 
  $exam_mark_table =  $_SESSION['exam_mark_table'];
  $subject = $_SESSION['subject'];
  $exam_name=$_SESSION['exam_name'];
  $group=$_SESSION['group'];
  $ct_mark_table= $_SESSION['ct_mark_table'];
  $year=$_SESSION['year'];
  $student_table='student_info_'.$group;
  //echo $exam_name;
  $subject = str_replace(" ","_",$_SESSION['subject']);
 // $exam_mark_info = mysqli_query($conn,"SELECT * FROM `$ct_mark_table`");
 $exam_mark_info = mysqli_query($conn,"SELECT $ct_mark_table.*,$student_table.`year` FROM $ct_mark_table INNER JOIN $student_table ON $ct_mark_table.`Student_ID`=$student_table.student_id WHERE `year`='$year'");
 while($table_content = mysqli_fetch_array($exam_mark_info)):
     $student_id = $table_content['Student_ID'];
     //$mark = $table_content[$col_name];
     
     $roll_creative="roll_".$student_id. $subject."creative";
     $roll_mcq="roll_".$student_id. $subject."mcq";
     $roll_practical="roll_".$student_id. $subject."practical";
     $roll_ct="roll_".$student_id. $subject."ct";

     if($subject=='physics' || $subject=='chemistry' || $subject=='biology' || $subject=='math' || $subject=='ict')
     {
      $mark_creative = $_POST[$roll_creative];
      $mark_mcq = $_POST[$roll_mcq];
      $mark_practical = $_POST[$roll_practical];
      $ct = $_POST[$roll_ct];
      if($mark_creative==null){$mark_creative=0;}
      if($mark_mcq==null){$mark_mcq=0;}
      if($mark_practical==null){$mark_practical=0;}
      if($ct==null){$ct=0;}

      $total_mark=$mark_creative+$mark_mcq+$mark_practical;
      $total_90=ceil($total_mark*0.9);
      $total_final=$total_90+$ct;

         if($mark_creative<17 || $mark_mcq<8){
          $lg='F';
          $gp=0;
         }  
         else{
          if($total_final>=80){
            $lg='A+';
            $gp=5;
           }
           elseif($total_final>=70 && $total_final<80){
            $lg='A';
            $gp=4;
           }
           elseif($total_final>=60 && $total_final<70){
            $lg='A-';
            $gp=3.5;
           }
           elseif($total_final>=50 && $total_final<60){
            $lg='B';
            $gp=3;
           }
           elseif($total_final>=40 && $total_final<50){
            $lg='C';
            $gp=2;
           }
           elseif($total_final>=33 && $total_final<40){
            $lg='D';
            $gp=1;
           }
           else{
            $lg='F';
            $gp=0;
           }

         }

         

     $col_name_creative = $subject.' '.'crtv';
     $col_name_mcq = $subject.' '.'mcq';
     $col_name_practical = $subject.' '.'prac';
     $col_name_total = $subject.' '.'total';
     $col_name_total90 = $subject.' '.'total90';
     $col_name_ct=$subject.' '.'ct';
     $col_name_total_final=$subject.' '.'total'.' '.'final';
     $col_name_lg=$subject.' '.'lg';
     $col_name_gp=$subject.' '.'gp';
   
     
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative`='$mark_creative' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq`='$mark_mcq' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_practical`='$mark_practical' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total`='$total_mark' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total90`='$total_90' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_ct`='$ct' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total_final`='$total_final' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");

     }

     elseif($subject=='english' || ($subject=='bangla' && $exam_name=='pre_test'))
     {
      $mark_creative = $_POST[$roll_creative];
      if($mark_creative==null){
        $mark_creative=0;
      }
      $ct = $_POST[$roll_ct];
      if($ct==null){
        $ct=0;
      }
      $total_mark=$mark_creative;
      
      $total_90=ceil($total_mark*0.9);
      $total_final=$total_90+$ct;

      if($total_final>=80){
        $lg='A+';
        $gp=5;
       }
       elseif($total_final>=70 && $total_final<80){
        $lg='A';
        $gp=4;
       }
       elseif($total_final>=60 && $total_final<70){
        $lg='A-';
        $gp=3.5;
       }
       elseif($total_final>=50 && $total_final<60){
        $lg='B';
        $gp=3;
       }
       elseif($total_final>=40 && $total_final<50){
        $lg='C';
        $gp=2;
       }
       elseif($total_final>=33 && $total_final<40){
        $lg='D';
        $gp=1;
       }
       else{
        $lg='F';
        $gp=0;
       }
 
 
     $col_name_creative = $subject;
     $col_name_total = $subject.' '.'total';
     $col_name_total90 = $subject.' total90';
     $col_name_ct=$subject.' '.'ct';
     $col_name_total_final=$subject.' '.'total'.' '.'final';
     $col_name_lg=$subject.' '.'lg';
     $col_name_gp=$subject.' '.'gp';
     
      //mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative`='$mark_creative' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total`='$total_mark' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total90`='$total_90' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_ct`='$ct' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total_final`='$total_final' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");

     }

     else{
        echo $subject;
        $mark_creative = $_POST[$roll_creative];
        echo '_'.$mark_creative;
        if($mark_creative==null){
          $mark_creative=0;
        }
        $mark_mcq = $_POST[$roll_mcq];
        echo '_'.$mark_mcq;
        if($mark_mcq==null){
          $mark_mcq=0;
        }
        $ct = $_POST[$roll_ct];
        if($ct==null){
          $ct=0;
        }
        $total_mark=$mark_creative+$mark_mcq;
        echo '_'.$total_mark;
        $total_90=ceil($total_mark*0.9);
        $total_final=$total_90+$ct;

        if($mark_creative<23 || $mark_mcq<10){
          $lg='F';
          $gp=0;
         }  
         else{
          if($total_final>=80){
            $lg='A+';
            $gp=5;
           }
           elseif($total_final>=70 && $total_final<80){
            $lg='A';
            $gp=4;
           }
           elseif($total_final>=60 && $total_final<70){
            $lg='A-';
            $gp=3.5;
           }
           elseif($total_final>=50 && $total_final<60){
            $lg='B';
            $gp=3;
           }
           elseif($total_final>=40 && $total_final<50){
            $lg='C';
            $gp=2;
           }
           elseif($total_final>=33 && $total_final<40){
            $lg='D';
            $gp=1;
           }
           else{
            if($mark_creative>=23 && $mark_mcq>=10){
              $lg='D';
              $gp=1;
            }else{
              $lg='F';
              $gp=0;
            }
            
           }

         }
   
         
       $col_name_creative = $subject.' '.'crtv';
       $col_name_mcq = $subject.' '.'mcq';
       $col_name_total = $subject.' '.'total';
       echo '<br>'.$col_name_total;
       $col_name_total90 = $subject.' '.'total90';
        $col_name_ct=$subject.' '.'ct';
        $col_name_total_final=$subject.' '.'total'.' '.'final';
        $col_name_lg=$subject.' '.'lg';
        $col_name_gp=$subject.' '.'gp';
        //echo '_'.$exam_mark_table;
       
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative`='$mark_creative' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq`='$mark_mcq' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total`='$total_mark' WHERE `Student ID`=$student_id");

      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total90`='$total_90' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_ct`='$ct' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total_final`='$total_final' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");
  
       
     }

     
     $subjects = mysqli_query($conn,"SELECT `subject1`,`subject2`,`subject3`, `fourth_sub` FROM `$student_table` WHERE `student_id`=$student_id");
      $sub_list = mysqli_fetch_array($subjects);
      $subject1=$sub_list['subject1']; 
      $subject2=$sub_list['subject2']; 
      $subject3=$sub_list['subject3']; 
      $fourth_sub=$sub_list['fourth_sub']; 
      $subject1_gp_col= $sub_list['subject1'].' '.'gp';
      $subject2_gp_col= $sub_list['subject2'].' '.'gp';
      $subject3_gp_col= $sub_list['subject3'].' '.'gp';
      $fourth_subject_gp_col= $sub_list['fourth_sub'].' '.'gp';

      //edit starts
      $subject1_mark_col=$sub_list['subject1'].' total '.'final';
      $subject2_mark_col=$sub_list['subject2'].' total '.'final';
      $subject3_mark_col=$sub_list['subject3'].' total '.'final';
      $fourth_subject_mark_col=$sub_list['fourth_sub'].' total '.'final';
      


      $exam_mark_info_gp = mysqli_query($conn,"SELECT `bangla gp`, `english gp`,`ict gp`,`$subject1_gp_col`,`$subject2_gp_col`,`$subject3_gp_col`,`$fourth_subject_gp_col`,`bangla total final`,`english total final`,`ict total final`,`$subject1_mark_col`,`$subject2_mark_col`,`$subject3_mark_col`,`$fourth_subject_mark_col` FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
      $table_content_gp = mysqli_fetch_array($exam_mark_info_gp);

     //echo $fourth_subject_gp_col;
     $fourth_subject_gp=$table_content_gp[$fourth_subject_gp_col];
     //echo  $fourth_subject_gp;
     if($fourth_subject_gp>=2){
      $point_from_4th=$fourth_subject_gp-2;
     }
     else{
      $point_from_4th=0;
     }

  


      $total_gp=$table_content_gp['bangla gp']+$table_content_gp['english gp']+$table_content_gp['ict gp']+$table_content_gp[$subject1_gp_col]+$table_content_gp[$subject2_gp_col]+$table_content_gp[$subject3_gp_col]+$table_content_gp[$fourth_subject_gp_col];

      $total_mark=$table_content_gp['bangla total final']+$table_content_gp['english total final']+$table_content_gp['ict total final']+$table_content_gp[$subject1_mark_col]+$table_content_gp[$subject2_mark_col]+$table_content_gp[$subject3_mark_col]+$table_content_gp[$fourth_subject_mark_col];


      $total_gp_without_4th=$total_gp - $fourth_subject_gp;
      $gpa_without_4th = round($total_gp_without_4th/6,2);
      $gpa= round(($total_gp_without_4th+$point_from_4th)/6,2);
      if($gpa>=5){$gpa=5;}

      if($table_content_gp['bangla gp']==0 || $table_content_gp['english gp']==0 || $table_content_gp['ict gp'] ==0 ||$table_content_gp[$subject1_gp_col]==0 || $table_content_gp[$subject2_gp_col]==0 || $table_content_gp[$subject3_gp_col]==0){
        $grade='F';
        $gpa_without_4th=0;
        $gpa=0;

      }
      else{
        if($gpa==5){
          $grade='A+';
        }
        elseif($gpa>=4 && $gpa<5){
          $grade='A';
        }
        elseif($gpa>=3.5 && $gpa<4){
          $grade='A-';
        }
        elseif($gpa>=3 && $gpa<3.5){
          $grade='B';
        }
        elseif($gpa>=2 && $gpa<3){
          $grade='C';
        }
        elseif($gpa>=1 && $gpa<2){
          $grade='D';
        }
        else{
          $grade='F';
        }
      }

       
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `fourth_sub`='$fourth_sub' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `total gp`='$total_gp_without_4th' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `point_from_4th`='$point_from_4th' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `gpa without 4th`='$gpa_without_4th' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `gpa`='$gpa' WHERE `Student ID`=$student_id");
       
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `grade`='$grade' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `number`='$total_mark' WHERE `Student ID`=$student_id");

        $position_gp = mysqli_query($conn,"SELECT `bangla gp`, `english gp`,`ict gp`,`$subject1_gp_col`,`$subject2_gp_col`,`$subject3_gp_col`,`$fourth_subject_gp_col`,`gpa` FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
        $table_content_position_gp = mysqli_fetch_array($position_gp);
        if($table_content_position_gp['gpa']==0){
          if($table_content_position_gp['bangla gp']==0){
            $bangla=1;
          }else{$bangla=0;}
          if($table_content_position_gp['english gp']==0){
            $english=1;
          }else{$english=0;}
          if($table_content_position_gp['ict gp']==0){
            $ict=1;
          }else{$ict=0;}
          if($table_content_position_gp[$subject1_gp_col]==0){
            $subject1=1;
          }else{$subject1=0;}
          if($table_content_position_gp[$subject2_gp_col]==0){
            $subject2=1;
          }else{$subject2=0;}
          if($table_content_position_gp[$subject3_gp_col]==0){
            $subject3=1;
          }else{$subject3=0;}
          if($table_content_position_gp[$fourth_subject_gp_col]==0){
            $fourth_sub=1;
          }else{$fourth_sub=0;}
          $pos_grade= -($bangla+$english+$ict+$subject1+$subject2+$subject3+$fourth_sub);

        }else{
          $pos_grade=$table_content_position_gp['gpa'];
        }
        
        
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `pos_grade`='$pos_grade' WHERE `Student ID`=$student_id");

 endwhile;

 $exam_position = mysqli_query($conn,"SELECT $exam_mark_table.`Student ID`,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year' ORDER BY pos_grade DESC,`number` DESC");
 $pos=0;
 while($position_content = mysqli_fetch_array($exam_position)):
     $student_id = $position_content['Student ID'];
     $pos=$pos+1;
     //echo $student_id.'_'.$pos; echo '<br>';
     mysqli_query($conn,"UPDATE `$exam_mark_table` SET `position`='$pos' WHERE `Student ID`=$student_id");

     //edit ends

     echo 'total_mark_'.$total_mark;
 endwhile;

 
 
  if( $_SESSION['login']=='teacher'){
     header('location:../put_marks.php');
  } 
 if( $_SESSION['login']=='admin'){
     header('location:../put_marks_select_admin.php');
  }
  