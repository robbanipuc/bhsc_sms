
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
     
     $roll_creative1="roll_".$student_id. $subject."1creative";
     $roll_mcq1="roll_".$student_id. $subject."1mcq";
     $roll_practical1="roll_".$student_id. $subject."1practical";

     $roll_creative2="roll_".$student_id. $subject."2creative";
     $roll_mcq2="roll_".$student_id. $subject."2mcq";
     $roll_practical2="roll_".$student_id. $subject."2practical";
    

     if($subject=='physics' || $subject=='chemistry' || $subject=='biology' || $subject=='math')
     {
      $mark_creative1 = $_POST[$roll_creative1];
      $mark_mcq1 = $_POST[$roll_mcq1];
      $mark_practical1 = $_POST[$roll_practical1];

      $mark_creative2 = $_POST[$roll_creative2];
      $mark_mcq2 = $_POST[$roll_mcq2];
      $mark_practical2 = $_POST[$roll_practical2];

      if($mark_creative1==null){$mark_creative1=0;}
      if($mark_mcq1==null){$mark_mcq1=0;}
      if($mark_practical1==null){$mark_practical1=0;}
      if($mark_creative2==null){$mark_creative2=0;}
      if($mark_mcq2==null){$mark_mcq2=0;}
      if($mark_practical2==null){$mark_practical2=0;}

      $total_mark1=$mark_creative1+$mark_mcq1+$mark_practical1;
      $total_mark2=$mark_creative2+$mark_mcq2+$mark_practical2;
      $average= ceil(($total_mark1+$total_mark2)/2);

      if($mark_creative1<17 || $mark_mcq1<8){
        $lg1='F';
        $gp1=0;
       }  
       else{
        if($total_mark1>=80){
          $lg1='A+';
          $gp1=5;
         }
         elseif($total_mark1>=70 && $total_mark1<80){
          $lg1='A';
          $gp1=4;
         }
         elseif($total_mark1>=60 && $total_mark1<70){
          $lg1='A-';
          $gp1=3.5;
         }
         elseif($total_mark1>=50 && $total_mark1<60){
          $lg1='B';
          $gp1=3;
         }
         elseif($total_mark1>=40 && $total_mark1<50){
          $lg1='C';
          $gp1=2;
         }
         elseif($total_mark1>=33 && $total_mark1<40){
          $lg1='D';
          $gp1=1;
         }
         else{
          $lg1='F';
          $gp1=0;
         }

       }

       if($mark_creative2<17 || $mark_mcq2<8){
        $lg2='F';
        $gp2=0;
       }  
       else{
        if($total_mark2>=80){
          $lg2='A+';
          $gp2=5;
         }
         elseif($total_mark2>=70 && $total_mark2<80){
          $lg2='A';
          $gp2=4;
         }
         elseif($total_mark2>=60 && $total_mark2<70){
          $lg2='A-';
          $gp2=3.5;
         }
         elseif($total_mark2>=50 && $total_mark2<60){
          $lg2='B';
          $gp2=3;
         }
         elseif($total_mark2>=40 && $total_mark2<50){
          $lg2='C';
          $gp2=2;
         }
         elseif($total_mark2>=33 && $total_mark2<40){
          $lg2='D';
          $gp2=1;
         }
         else{
          $lg2='F';
          $gp2=0;
         }

       }

         if($mark_creative1<17 || $mark_mcq1<8 || $mark_creative2<17 || $mark_mcq2<8){
          $lg='F';
          $gp=0;
         }  
         else{
          if($average>=80){
            $lg='A+';
            $gp=5;
           }
           elseif($average>=70 && $average<80){
            $lg='A';
            $gp=4;
           }
           elseif($average>=60 && $average<70){
            $lg='A-';
            $gp=3.5;
           }
           elseif($average>=50 && $average<60){
            $lg='B';
            $gp=3;
           }
           elseif($average>=40 && $average<50){
            $lg='C';
            $gp=2;
           }
           elseif($average>=33 && $average<40){
            $lg='D';
            $gp=1;
           }
           else{
            $lg='F';
            $gp=0;
           }

         }

         

     $col_name_creative1 = $subject.'1 '.'crtv';
     $col_name_mcq1 = $subject.'1 '.'mcq';
     $col_name_practical1 = $subject.'1 '.'prac';
     

     $col_name_creative2 = $subject.'2 '.'crtv';
     $col_name_mcq2 = $subject.'2 '.'mcq';
     $col_name_practical2 = $subject.'2 '.'prac';

     $col_name_lg1=$subject.'1 lg';
     $col_name_gp1=$subject.'1 gp';
     $col_name_lg2=$subject.'2 lg';
     $col_name_gp2=$subject.'2 gp';


     $col_name_total1 = $subject.'1 '.'total';
     $col_name_total2 = $subject.'2 '.'total';
     $col_name_average=$subject.' '.'avg';
     $col_name_lg=$subject.' '.'lg';
     $col_name_gp=$subject.' '.'gp';
   
     
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative1`='$mark_creative1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq1`='$mark_mcq1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_practical1`='$mark_practical1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative2`='$mark_creative2' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq2`='$mark_mcq2' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_practical2`='$mark_practical2' WHERE `Student ID`=$student_id");

      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg1`='$lg1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp1`='$gp1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg2`='$lg2' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp2`='$gp2' WHERE `Student ID`=$student_id");

      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total1`='$total_mark1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total2`='$total_mark2' WHERE `Student ID`=$student_id");
    
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_average`='$average' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");

     }

     elseif($subject=='ict'){

      $roll_creative="roll_".$student_id. $subject."creative";
      $roll_mcq="roll_".$student_id. $subject."mcq";
      $roll_practical="roll_".$student_id. $subject."practical";

      $mark_creative = $_POST[$roll_creative];
      $mark_mcq = $_POST[$roll_mcq];
      $mark_practical = $_POST[$roll_practical];

      if($mark_creative==null){$mark_creative=0;}
      if($mark_mcq==null){$mark_mcq=0;}
      if($mark_practical==null){$mark_practical=0;}
     
      $total_mark=$mark_creative+$mark_mcq+$mark_practical;


         if($mark_creative<17 || $mark_mcq<8){
          $lg='F';
          $gp=0;
         }  
         else{
          if($total_mark>=80){
            $lg='A+';
            $gp=5;
           }
           elseif($total_mark>=70 && $total_mark<80){
            $lg='A';
            $gp=4;
           }
           elseif($total_mark>=60 && $total_mark<70){
            $lg='A-';
            $gp=3.5;
           }
           elseif($total_mark>=50 && $total_mark<60){
            $lg='B';
            $gp=3;
           }
           elseif($total_mark>=40 && $total_mark<50){
            $lg='C';
            $gp=2;
           }
           elseif($total_mark>=33 && $total_mark<40){
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
     $col_name_lg=$subject.' '.'lg';
     $col_name_gp=$subject.' '.'gp';
   
     
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative`='$mark_creative' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq`='$mark_mcq' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_practical`='$mark_practical' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total`='$total_mark' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");

     }

     elseif($subject=='english')
     {
      $mark_creative1 = $_POST[$roll_creative1];
      $mark_creative2 = $_POST[$roll_creative2];
      if($mark_creative1==null){
        $mark_creative1=0;
      }
      if($mark_creative2==null){
        $mark_creative2=0;
      }
      
      $average= ceil(($mark_creative1+$mark_creative2)/2);
      

      
        if($mark_creative1>=80){
          $lg1='A+';
          $gp1=5;
         }
         elseif($mark_creative1>=70 && $mark_creative1<80){
          $lg1='A';
          $gp1=4;
         }
         elseif($mark_creative1>=60 && $mark_creative1<70){
          $lg1='A-';
          $gp1=3.5;
         }
         elseif($mark_creative1>=50 && $mark_creative1<60){
          $lg1='B';
          $gp1=3;
         }
         elseif($mark_creative1>=40 && $mark_creative1<50){
          $lg1='C';
          $gp1=2;
         }
         elseif($mark_creative1>=33 && $mark_creative1<40){
          $lg1='D';
          $gp1=1;
         }
         else{
          $lg1='F';
          $gp1=0;
         }


       
        if($mark_creative2>=80){
          $lg2='A+';
          $gp2=5;
         }
         elseif($mark_creative2>=70 && $mark_creative2<80){
          $lg2='A';
          $gp2=4;
         }
         elseif($mark_creative2>=60 && $mark_creative2<70){
          $lg2='A-';
          $gp2=3.5;
         }
         elseif($mark_creative2>=50 && $mark_creative2<60){
          $lg2='B';
          $gp2=3;
         }
         elseif($mark_creative2>=40 && $mark_creative2<50){
          $lg2='C';
          $gp2=2;
         }
         elseif($mark_creative2>=33 && $mark_creative2<40){
          $lg2='D';
          $gp2=1;
         }
         else{
          $lg2='F';
          $gp2=0;
         }

      

      if($average>=80){
        $lg='A+';
        $gp=5;
       }
       elseif($average>=70 && $average<80){
        $lg='A';
        $gp=4;
       }
       elseif($average>=60 && $average<70){
        $lg='A-';
        $gp=3.5;
       }
       elseif($average>=50 && $average<60){
        $lg='B';
        $gp=3;
       }
       elseif($average>=40 && $average<50){
        $lg='C';
        $gp=2;
       }
       elseif($average>=33 && $average<40){
        $lg='D';
        $gp=1;
       }
       else{
        $lg='F';
        $gp=0;
       }
 
 
     $col_name_creative1 = $subject.'1';
     $col_name_creative2 = $subject.'2';
     $col_name_average = $subject.' avg';

     $col_name_lg1=$subject.'1 lg';
     $col_name_gp1=$subject.'1 gp';
     $col_name_lg2=$subject.'2 lg';
     $col_name_gp2=$subject.'2 gp';
     
     $col_name_lg=$subject.' '.'lg';
     $col_name_gp=$subject.' '.'gp';
     
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative1`='$mark_creative1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative2`='$mark_creative2' WHERE `Student ID`=$student_id");

      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg1`='$lg1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp1`='$gp1' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg2`='$lg2' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp2`='$gp2' WHERE `Student ID`=$student_id");

      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_average`='$average' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
      mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");

     }

     elseif($subject=='bangla')
     {
      echo $subject;
      $mark_creative1 = $_POST[$roll_creative1];
      $mark_mcq1 = $_POST[$roll_mcq1];
      $mark_creative2 = $_POST[$roll_creative2];
      
      
      if($mark_creative1==null){$mark_creative1=0;}
    if($mark_mcq1==null){$mark_mcq1=0;}
    if($mark_creative2==null){$mark_creative2=0;}
    

      $total_mark1=$mark_creative1+$mark_mcq1;
      $total_mark2=$mark_creative2;

      $average= ceil(($total_mark1+$total_mark2)/2);

      if($mark_creative1<23 || $mark_mcq1<10){
        $lg1='F';
        $gp1=0;
       }  
       else{
        if($total_mark1>=80){
          $lg1='A+';
          $gp1=5;
         }
         elseif($total_mark1>=70 && $total_mark1<80){
          $lg1='A';
          $gp1=4;
         }
         elseif($total_mark1>=60 && $total_mark1<70){
          $lg1='A-';
          $gp1=3.5;
         }
         elseif($total_mark1>=50 && $total_mark1<60){
          $lg1='B';
          $gp1=3;
         }
         elseif($total_mark1>=40 && $total_mark1<50){
          $lg1='C';
          $gp1=2;
         }
         elseif($total_mark1>=33 && $total_mark1<40){
          $lg1='D';
          $gp1=1;
         }
         else{
          $lg1='F';
          $gp1=0;
         }

       }

      
        if($mark_creative2>=80){
          $lg2='A+';
          $gp2=5;
         }
         elseif($mark_creative2>=70 && $mark_creative2<80){
          $lg2='A';
          $gp2=4;
         }
         elseif($mark_creative2>=60 && $mark_creative2<70){
          $lg2='A-';
          $gp2=3.5;
         }
         elseif($mark_creative2>=50 && $mark_creative2<60){
          $lg2='B';
          $gp2=3;
         }
         elseif($mark_creative2>=40 && $mark_creative2<50){
          $lg2='C';
          $gp2=2;
         }
         elseif($mark_creative2>=33 && $mark_creative2<40){
          $lg2='D';
          $gp2=1;
         }
         else{
          $lg2='F';
          $gp2=0;
         }

      

      if($mark_creative1<23 || $mark_mcq1<10 || $mark_creative2<33){
        $lg='F';
        $gp=0;
       }  
       else{
        if($average>=80){
          $lg='A+';
          $gp=5;
         }
         elseif($average>=70 && $average<80){
          $lg='A';
          $gp=4;
         }
         elseif($average>=60 && $average<70){
          $lg='A-';
          $gp=3.5;
         }
         elseif($average>=50 && $average<60){
          $lg='B';
          $gp=3;
         }
         elseif($average>=40 && $average<50){
          $lg='C';
          $gp=2;
         }
         elseif($average>=33 && $total_final<40){
          $lg='D';
          $gp=1;
         }
         else{
          $lg='F';
          $gp=0;
         }

       }
 
       
       $col_name_creative1 = $subject.'1 '.'crtv';
       $col_name_mcq1 = $subject.'1 '.'mcq';
  
       $col_name_creative2 = $subject.'2';

       $col_name_lg1=$subject.'1 lg';
       $col_name_gp1=$subject.'1 gp';
       $col_name_lg2=$subject.'2 lg';
       $col_name_gp2=$subject.'2 gp';
       

       $col_name_total1 = $subject.'1 '.'total';
       $col_name_total2 = $subject.'2 '.'total';
       $col_name_average=$subject.' '.'avg';
       $col_name_lg=$subject.' '.'lg';
       $col_name_gp=$subject.' '.'gp';
     
       
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative1`='$mark_creative1' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq1`='$mark_mcq1' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative2`='$mark_creative2' WHERE `Student ID`=$student_id");

        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg1`='$lg1' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp1`='$gp1' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg2`='$lg2' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp2`='$gp2' WHERE `Student ID`=$student_id");
       
        
  
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total1`='$total_mark1' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total2`='$total_mark2' WHERE `Student ID`=$student_id");
      
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_average`='$average' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg`='$lg' WHERE `Student ID`=$student_id");
        mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp`='$gp' WHERE `Student ID`=$student_id");
  

     
      
     }


     else{
        echo $subject;
        $mark_creative1 = $_POST[$roll_creative1];
        $mark_mcq1 = $_POST[$roll_mcq1];
        $mark_creative2 = $_POST[$roll_creative2];
        $mark_mcq2 = $_POST[$roll_mcq2];
        
        if($mark_creative1==null){$mark_creative1=0;}
      if($mark_mcq1==null){$mark_mcq1=0;}
      if($mark_creative2==null){$mark_creative2=0;}
      if($mark_mcq2==null){$mark_mcq2=0;}

        $total_mark1=$mark_creative1+$mark_mcq1;
        $total_mark2=$mark_creative2+$mark_mcq2;

        $average= ceil(($total_mark1+$total_mark2)/2);

        if($mark_creative1<23 || $mark_mcq1<10){
          $lg1='F';
          $gp1=0;
         }  
         else{
          if($total_mark1>=80){
            $lg1='A+';
            $gp1=5;
           }
           elseif($total_mark1>=70 && $total_mark1<80){
            $lg1='A';
            $gp1=4;
           }
           elseif($total_mark1>=60 && $total_mark1<70){
            $lg1='A-';
            $gp1=3.5;
           }
           elseif($total_mark1>=50 && $total_mark1<60){
            $lg1='B';
            $gp1=3;
           }
           elseif($total_mark1>=40 && $total_mark1<50){
            $lg1='C';
            $gp1=2;
           }
           elseif($total_mark1>=33 && $total_mark1<40){
            $lg1='D';
            $gp1=1;
           }
           else{
            $lg1='F';
            $gp1=0;
           }
  
         }
  
         if($mark_creative2<23 || $mark_mcq2<10){
          $lg2='F';
          $gp2=0;
         }  
         else{
          if($total_mark2>=80){
            $lg2='A+';
            $gp2=5;
           }
           elseif($total_mark2>=70 && $total_mark2<80){
            $lg2='A';
            $gp2=4;
           }
           elseif($total_mark2>=60 && $total_mark2<70){
            $lg2='A-';
            $gp2=3.5;
           }
           elseif($total_mark2>=50 && $total_mark2<60){
            $lg2='B';
            $gp2=3;
           }
           elseif($total_mark2>=40 && $total_mark2<50){
            $lg2='C';
            $gp2=2;
           }
           elseif($total_mark2>=33 && $total_mark2<40){
            $lg2='D';
            $gp2=1;
           }
           else{
            $lg2='F';
            $gp2=0;
           }
  
         }

        if($mark_creative1<23 || $mark_mcq1<10 || $mark_creative2<23 || $mark_mcq2<10){
          $lg='F';
          $gp=0;
         }  
         else{
          if($average>=80){
            $lg='A+';
            $gp=5;
           }
           elseif($average>=70 && $average<80){
            $lg='A';
            $gp=4;
           }
           elseif($average>=60 && $average<70){
            $lg='A-';
            $gp=3.5;
           }
           elseif($average>=50 && $average<60){
            $lg='B';
            $gp=3;
           }
           elseif($average>=40 && $average<50){
            $lg='C';
            $gp=2;
           }
           elseif($average>=33 && $total_final<40){
            $lg='D';
            $gp=1;
           }
           else{
            $lg='F';
            $gp=0;
           }

         }
   
         
         $col_name_creative1 = $subject.'1 '.'crtv';
         $col_name_mcq1 = $subject.'1 '.'mcq';
    
         $col_name_creative2 = $subject.'2 '.'crtv';
         $col_name_mcq2 = $subject.'2 '.'mcq';

         $col_name_lg1=$subject.'1 lg';
         $col_name_gp1=$subject.'1 gp';
         $col_name_lg2=$subject.'2 lg';
         $col_name_gp2=$subject.'2 gp';

         $col_name_total1 = $subject.'1 '.'total';
         $col_name_total2 = $subject.'2 '.'total';
         $col_name_average=$subject.' '.'avg';
         $col_name_lg=$subject.' '.'lg';
         $col_name_gp=$subject.' '.'gp';
       
         
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative1`='$mark_creative1' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq1`='$mark_mcq1' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_creative2`='$mark_creative2' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_mcq2`='$mark_mcq2' WHERE `Student ID`=$student_id");

          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg1`='$lg1' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp1`='$gp1' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_lg2`='$lg2' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_gp2`='$gp2' WHERE `Student ID`=$student_id");
          
    
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total1`='$total_mark1' WHERE `Student ID`=$student_id");
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_total2`='$total_mark2' WHERE `Student ID`=$student_id");
        
          mysqli_query($conn,"UPDATE `$exam_mark_table` SET `$col_name_average`='$average' WHERE `Student ID`=$student_id");
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
      
      $subject1_1_marks=$subject1.'1 total'; $subject1_2_marks=$subject1.'2 total';
      $subject2_1_marks=$subject2.'1 total'; $subject2_2_marks=$subject2.'2 total';
      $subject3_1_marks=$subject3.'1 total'; $subject3_2_marks=$subject3.'2 total';
      $fourth_sub_1_marks=$fourth_sub.'1 total'; $fourth_sub_2_marks=$fourth_sub.'2 total';


echo $exam_mark_table;
      $exam_mark_info_gp = mysqli_query($conn,"SELECT * FROM `$exam_mark_table` WHERE `Student ID`=$student_id");
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

  
     //$total_mark=$table_content_gp['bangla1 total']+$table_content_gp['bangla2 total']+$table_content_gp['english1']+$table_content_gp['english2']+$table_content_gp['ict total']+$table_content_gp[$subject1_1_marks]+$table_content_gp[$subject1_2_marks]+$table_content_gp[$subject2_1_marks]+$table_content_gp[$subject2_1_marks]+$table_content_gp[$subject3_1_marks]+$table_content_gp[$subject3_1_marks]+$table_content_gp[$fourth_sub_1_marks]+$table_content_gp[$fourth_sub_2_marks];

     $total_mark=$table_content_gp['bangla1 total']+$table_content_gp['bangla2 total']+$table_content_gp['english1']+$table_content_gp['english2']+$table_content_gp['ict total']+$table_content_gp[$subject1_1_marks]+$table_content_gp[$subject1_2_marks]+$table_content_gp[$subject2_1_marks]+$table_content_gp[$subject2_2_marks]+$table_content_gp[$subject3_1_marks]+$table_content_gp[$subject3_2_marks]+$table_content_gp[$fourth_sub_1_marks]+$table_content_gp[$fourth_sub_2_marks];



      $total_gp=$table_content_gp['bangla gp']+$table_content_gp['english gp']+$table_content_gp['ict gp']+$table_content_gp[$subject1_gp_col]+$table_content_gp[$subject2_gp_col]+$table_content_gp[$subject3_gp_col]+$table_content_gp[$fourth_subject_gp_col];

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
        echo '<br>'; echo 'gp___'.$total_gp; echo '<br>';
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
     echo $student_id.'_'.$pos; echo '<br>';
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
 