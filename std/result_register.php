

<?php
include('conn.php');
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' => 3,'margin_bottom' => 3]);
//$mpdf = new \Mpdf\Mpdf(['','A4',40,'nikosh']);

$data='';
$data.='
<html>
<head>
  <style>
    body{
        font-family:kalpurush;
        
    }
    .gradesheet_table tr td{
        border:1px solid black;
        padding:5px;
    }
    .gradesheet_table{
        border-collapse:collapse;
        text-align:center;
        margin-left: 100px;
    }
    .upper_table{
        width:100%;
        border:none;
    }
    .upper_table tr td{
        border:none;
    }
    .upper_table .heading{
       
        text-align:center;
        width:50%;

    }
    .upper_table .student_info{
        
        width:25%;
        font-size:16px;
       
    }
    .upper_table .right_table{
        
        align:right;
        width:25%;
        
    }
    .upper_table .right_table tr td{
        border:1px solid black;
    }
   .result_table{
   
    border-collapse:collapse;
    width:100%;
    text-align:center;
   
   }
   .result_table tr th,td{
    border:1px solid black;
    padding:2px;
   }
   .lower_table{
   
    border-collapse:collapse;
    width:100%;
    text-align:center;
   }
   .lower_table tr td{
    border:1px solid black;
   }
   .sign_table{
   
    border-collapse:collapse;
    width:100%;
    text-align:center;
   }
   .sign_table tr td{
    border:none;
   }

  </style>
</head>
<body>
';
$i=0;

function bfn($str){
    $english_num=array('0','1','2','3','4','5','6','7','8','9');
    $bangla_num=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    return str_replace($english_num,$bangla_num,$str);
}

function lg_bangla($grade){
    $english_lg=array('F','D','C','B','A-','A','A+');
    $bangla_lg=array('এফ','ডি','সি','বি','এ-','এ','এ+');
    return str_replace($english_lg,$bangla_lg,$grade);
}

function exam_name_bangla($exam_name){
    $english_name=array('1st_year_1st_term','1st_year_2nd_term','1st_year_final','pre_test','test');
    $bangla_name=array('অর্ধবার্ষিকী','২য় সাময়িক','বর্ষ সমাপনী','প্রাক নির্বাচনী','নির্বাচনী');
    return str_replace($english_name,$bangla_name,$exam_name);
}

function subject_name_bangla($subject_name){
    $english_name=array('bangla','english','ict','physics','chemistry','biology','math','accounting','production_management','business_organization','finance','economics','civics','logic','sociology','islamic_history');
    $bangla_name=array('বাংলা','ইংরেজি','তথ্য ও যোগাযোগ প্রযুক্তি','পদার্থবিজ্ঞান','রসায়নবিজ্ঞান','জীববিজ্ঞান','উচ্চতর গনিত','হিসাববিজ্ঞান','উৎপাদন ব্যবস্থাপনা ও বিপণন','ব্যবসায় সংগঠন ও ব্যবস্থাপনা','ফাইনান্স ও ব্যাংকিং','অর্থনীতি','পৌরনীতি','যুক্তিবিদ্যা','সমাজবিজ্ঞান','ইসলামে ইতিহাস');
    return str_replace($english_name,$bangla_name,$subject_name);
}

function comment_on_grade($str){
    $grade=array('F','D','C','B','A-','A','A+');
    $comment=array('অগ্রগতি প্রয়োজন','অগ্রগতি প্রয়োজন','অগ্রগতি প্রয়োজন','ভালো','উত্তম','উত্তম','অতি উত্তম');
    return str_replace($grade,$comment,$str);
}

function redmark($mark){
    if($mark=='F'){
        return 'red';
    }
}

session_start();
//$exam_name = $_GET['exam'];
$year = $_GET['academic_year'];
$group = $_GET['group'];
//$exam_mark_table=$exam_name.'_'.$group;
$student_table='student_info_'.$group;




if($group=='science'){
    $group_bangla='বিজ্ঞান';
}
elseif($group=='business'){
    $group_bangla='ব্যবসায় শিক্ষা';
}else{
    $group_bangla='মানবিক';
}


//$fyft = mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");

$all_students= mysqli_query($conn,"SELECT * FROM $student_table WHERE `year`='$year'");

while($table_content = mysqli_fetch_array($all_students)):
    $student_id = $table_content['student_id'];
    $student_name=$table_content['name_bangla'];
    $subject1= $table_content['subject1'];
    $subject2= $table_content['subject2'];
    $subject3= $table_content['subject3'];
    $fourth_sub= $table_content['fourth_sub'];
    

    
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
    
    
$data.='

<table class="upper_table">
             <tr>
                <td class="student_info">
                <img src="inc/img/logo.jpg" alt="Girl in a jacket" width="100"><br><br>
                নাম:'.$student_name.'<br>
                শাখা:'.$group_bangla.'<br>
                রোল: '.bfn($student_id).'<br>
                শিক্ষাবর্ষ: '.bfn($year).'
                 </td>
              <td class="heading" >
                  <span style="font-size:26px;">বাড়বকুণ্ড হাই স্কুল এন্ড কলেজ (কলেজ শাখা)</span><br>
                  <span style="font-size:15px;">বাড়বকুন্ড, সীতাকুন্ড, চট্টগ্রাম।</span><br><br><br>
                  <span style="font-size:20px;">পরীক্ষার ফলাফল রেজিস্টার</span><br><br><br><br><br><br>
                  
              </td>
             
             <td class="right_table">
            <table class="gradesheet_table" style="font-size:10px;">
                <tr><td colspan="3">গ্রেডিং পদ্ধতি </td> </tr>
                <tr><td>নম্বর </td> <td>লেটার গ্রেড </td> <td> গ্রেড পয়েন্ট </td><tr>
                <tr><td>৮০-১০০</td><td>এ+</td><td>৫</td></tr>
                <tr><td>৭০-৭৯</td><td>এ</td><td>৪</td></tr>
                <tr><td>৬০-৬৯</td><td>এ-</td><td>৩.৫</td></tr>
                <tr><td>৫০-৫৯</td><td>বি</td><td>৩</td></tr>
                <tr><td>৪০-৪৯</td><td>সি</td><td>২</td></tr>
                <tr><td>৩৩-৩৯</td><td>ডি</td><td>১</td></tr>
                <tr><td>০-৩২</td><td>এফ</td><td>০</td></tr>

            </table>

              </td>
              </tr>

    </table>
    <br><br>
    <table class="result_table">
        <tr>
           <th rowspan="2" style="width:200px;">বিষয়</th> <th colspan="3">অর্ধ-বার্ষিকী পরীক্ষা <br> (একাদশ শ্রেণি)</th> <th colspan="3">বর্ষ সমাপনী পরীক্ষা <br> (একাদশ শ্রেণি)</th><th colspan="3">প্রাক-নির্বাচনি পরীক্ষা <br> (দ্বাদশ শ্রেণি)</th> <th colspan="6">নির্বাচনী পরীক্ষা <br> (দ্বাদশ শ্রেণি)</th>  
         </tr>';    

         $data.='
          <tr>
                <td>প্রাপ্ত <br>নম্বর </td><td>গ্রেড<br> পয়েন্ট </td><td>লেটার<br> গ্রেড </td><td>প্রাপ্ত <br>নম্বর </td><td>গ্রেড <br>পয়েন্ট </td><td>লেটার<br> গ্রেড </td><td>প্রাপ্ত <br>নম্বর </td><td>গ্রেড <br>পয়েন্ট </td><td>লেটার <br>গ্রেড </td><td style="width:80px;">প্রাপ্ত নম্বর<br>১ম পত্র</td><td style="width:80px;">প্রাপ্ত নম্বর<br>২য় পত্র</td><td>মোট <br>নম্বর </td><td>গড় <br>নম্বর </td><td>গ্রেড<br> পয়েন্ট </td><td>লেটার <br>গ্রেড </td>
          </tr>
         ';
        
        
        $data.='<tr>
        <td style="padding:5px;">বাংলা</td><td>'.bfn($fyft['bangla total final']).'</td><td>'.bfn(number_format($fyft['bangla gp'],2)).'</td><td style="color:'.redmark($fyft['bangla lg']).';">'.lg_bangla($fyft['bangla lg']).'</td>

        <td>'.bfn($fyf['bangla total final']).'</td><td>'.bfn(number_format($fyf['bangla gp'],2)).'</td><td style="color:'.redmark($fyf['bangla lg']).';">'.lg_bangla($fyf['bangla lg']).'</td>

        <td>'.bfn($pt['bangla total final']).'</td><td>'.bfn(number_format($pt['bangla gp'],2)).'</td><td style="color:'.redmark($fyf['bangla lg']).';">'.lg_bangla($pt['bangla lg']).'</td>

        <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>

        <tr>
        <td style="padding:5px;">ইংরেজি</td><td>'.bfn($fyft['english total final']).'</td><td>'.bfn(number_format($fyft['english gp'],2)).'</td><td style="color:'.redmark($fyft['english lg']).';">'.lg_bangla($fyft['english lg']).'</td>

        <td>'.bfn($fyf['english total final']).'</td><td>'.bfn(number_format($fyf['english gp'],2)).'</td><td style="color:'.redmark($fyf['english lg']).';">'.lg_bangla($fyf['english lg']).'</td>

        <td>'.bfn($pt['english total final']).'</td><td>'.bfn(number_format($pt['english gp'],2)).'</td><td style="color:'.redmark($fyf['english lg']).';">'.lg_bangla($pt['english lg']).'</td>
        
       <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>

        <tr>
        <td style="padding:5px;">তথ্য ও যোগাযোগ প্রযুক্তি</td><td>'.bfn($fyft['ict total final']).'</td><td>'.bfn(number_format($fyft['ict gp'],2)).'</td><td style="color:'.redmark($fyft['ict lg']).';">'.lg_bangla($fyft['ict lg']).'</td>

        <td>'.bfn($fyf['ict total final']).'</td><td>'.bfn(number_format($fyf['ict gp'],2)).'</td><td style="color:'.redmark($fyf['ict lg']).';">'.lg_bangla($fyf['ict lg']).'</td>

        <td>'.bfn($pt['ict total final']).'</td><td>'.bfn(number_format($pt['ict gp'],2)).'</td><td style="color:'.redmark($fyf['ict lg']).';">'.lg_bangla($pt['ict lg']).'</td>
        
        <td colspan="4"> </td>  <td> </td> <td> </td>
        </tr>

         <tr>
        <td style="padding:5px;">'.subject_name_bangla($subject1).'</td><td>'.bfn($fyft[$subject1.' total final']).'</td><td>'.bfn(number_format($fyft[$subject1.' gp'],2)).'</td><td style="color:'.redmark($fyft[$subject1.' lg']).';">'.lg_bangla($fyft[$subject1.' lg']).'</td>

        <td>'.bfn($fyf[$subject1.' total final']).'</td><td>'.bfn(number_format($fyf[$subject1.' gp'],2)).'</td><td style="color:'.redmark($fyf[$subject1.' lg']).';">'.lg_bangla($fyf[$subject1.' lg']).'</td>

        <td>'.bfn($pt[$subject1.' total final']).'</td><td>'.bfn(number_format($pt[$subject1.' gp'],2)).'</td><td style="color:'.redmark($pt[$subject1.' lg']).';">'.lg_bangla($pt[$subject1.' lg']).'</td>

       
        
        <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>

         <tr>
        <td style="padding:5px;">'.subject_name_bangla($subject2).'</td><td>'.bfn($fyft[$subject2.' total final']).'</td><td>'.bfn(number_format($fyft[$subject2.' gp'],2)).'</td><td style="color:'.redmark($fyft[$subject2.' lg']).';">'.lg_bangla($fyft[$subject2.' lg']).'</td>

        <td>'.bfn($fyf[$subject2.' total final']).'</td><td>'.bfn(number_format($fyf[$subject2.' gp'],2)).'</td><td style="color:'.redmark($fyf[$subject2.' lg']).';">'.lg_bangla($fyf[$subject2.' lg']).'</td>

        <td>'.bfn($pt[$subject2.' total final']).'</td><td>'.bfn(number_format($pt[$subject2.' gp'],2)).'</td><td style="color:'.redmark($pt[$subject2.' lg']).';">'.lg_bangla($pt[$subject2.' lg']).'</td>

       
        
        <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>

        <tr>
        <td style="padding:5px;">'.subject_name_bangla($subject3).'</td><td>'.bfn($fyft[$subject3.' total final']).'</td><td>'.bfn(number_format($fyft[$subject3.' gp'],2)).'</td><td style="color:'.redmark($fyft[$subject3.' lg']).';">'.lg_bangla($fyft[$subject3.' lg']).'</td>

        <td>'.bfn($fyf[$subject3.' total final']).'</td><td>'.bfn(number_format($fyf[$subject3.' gp'],2)).'</td><td style="color:'.redmark($fyf[$subject3.' lg']).';">'.lg_bangla($fyf[$subject3.' lg']).'</td>

        <td>'.bfn($pt[$subject3.' total final']).'</td><td>'.bfn(number_format($pt[$subject3.' gp'],2)).'</td><td style="color:'.redmark($pt[$subject3.' lg']).';">'.lg_bangla($pt[$subject3.' lg']).'</td>

       
        
       <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>


        <tr>
        <td style="padding:5px;">'.subject_name_bangla($fourth_sub).'</td><td>'.bfn($fyft[$fourth_sub.' total final']).'</td><td>'.bfn(number_format($fyft[$fourth_sub.' gp'],2)).'</td><td style="color:'.redmark($fyft[$fourth_sub.' lg']).';">'.lg_bangla($fyft[$fourth_sub.' lg']).'</td>

        <td>'.bfn($fyf[$fourth_sub.' total final']).'</td><td>'.bfn(number_format($fyf[$fourth_sub.' gp'],2)).'</td><td style="color:'.redmark($fyf[$fourth_sub.' lg']).';">'.lg_bangla($fyf[$fourth_sub.' lg']).'</td>

        <td>'.bfn($pt[$fourth_sub.' total final']).'</td><td>'.bfn(number_format($pt[$fourth_sub.' gp'],2)).'</td><td style="color:'.redmark($pt[$fourth_sub.' lg']).';">'.lg_bangla($pt[$fourth_sub.' lg']).'</td>

       
        
        <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td>
        </tr>

        <tr>
        <td style="padding:5px;"></td><td>জিপিএ</td><td>'.bfn(number_format($fyft['gpa'],2)).'</td><td style="color:'.redmark($fyft['grade']).';">'.lg_bangla($fyft['grade']).'</td>

        <td>জিপিএ</td><td>'.bfn(number_format($fyf['gpa'],2)).'</td><td style="color:'.redmark($fyf['grade']).';">'.lg_bangla($fyf['grade']).'</td>

        <td>জিপিএ</td><td>'.bfn(number_format($pt['gpa'],2)).'</td><td style="color:'.redmark($fyf['grade']).';">'.lg_bangla($pt['grade']).'</td>
        
        <td colspan="4">জিপিএ </td>  <td> </td> <td> </td>
        </tr>




       
        
        
       


    </table><br>

   
   
    
    <table class="sign_table">
    <tr> <td></td><td></td><td>অতিরিক্ত বিষয়: '.subject_name_bangla($fourth_sub).'</td></tr>

    </table>
   <p style="page-break-before:always;">  </p>

';

//  <td>'.bfn($t['bangla1 total']).'</td><td>'.bfn($t['bangla2 total']).'</td><td>'.bfn($t['bangla1 total']+$t['bangla2 total']).'</td><td>'.bfn($t['bangla avg']).'</td><td>'.bfn(number_format($t['bangla gp'],2)).'</td><td style="color:'.redmark($t['bangla lg']).';">'.lg_bangla($t['bangla lg']).'</td>   (for test exam)

//<td>'.bfn($t[$subject1.'1 total']).'</td><td>'.bfn($t[$subject1.'2 total']).'</td><td>'.bfn($t[$subject1.'1 total']+$t[$subject1.'2 total']).'</td><td>'.bfn($t[$subject1.' avg']).'</td><td>'.bfn(number_format($t[$subject1.' gp'],2)).'</td><td style="color:'.redmark($t[$subject1.' lg']).';">'.lg_bangla($t[$subject1.' lg']).'</td>

//$mpdf->AddPage();
endwhile;

$data.='
</body>
</html>
';

$mpdf->WriteHTML($data);


//


//echo $data;

$mpdf->Output($group.'_'.$exam_name.'_gradesheet.pdf','I');

?>

