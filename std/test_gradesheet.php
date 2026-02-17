

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
        font-size:13px;
        
    }
    .gradesheet_table tr td{
        border:1px solid black;
        padding: 0px 5px;
    }
    .gradesheet_table{
        border-collapse:collapse;
        text-align:center;
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
        width:40%;

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

   td{
    padding: 0px 20px;
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
    $bangla_name=array('প্রথম সাময়িক','২য় সাময়িক','বর্ষ সমাপনী','প্রাক নির্বাচনী','নির্বাচনী');
    return str_replace($english_name,$bangla_name,$exam_name);
}

function subject_name_bangla($subject_name){
    $english_name=array('bangla','english','ict','physics','chemistry','biology','math','accounting','production_management','business_organization','finance','economics','civics','logic','sociology','islamic_history');
    $bangla_name=array('বাংলা','ইংরেজি','তথ্য ও যোগাযোগ প্রযুক্তি','পদার্থবিজ্ঞান','রসায়নবিজ্ঞান','জীববিজ্ঞান','গনিত','হিসাববিজ্ঞান','উৎপাদন ব্যবস্থাপনা ও বিপণন','ব্যবসায় সংগঠন ও ব্যবস্থাপনা','ফাইনান্স ও ব্যাংকিং','অর্থনীতি','পৌরনীতি','যুক্তিবিদ্যা','সমাজবিজ্ঞান','ইসলামে ইতিহাস');
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


$exam_name = $_GET['exam'];
$year = $_GET['year'];
$group = $_GET['group'];
$exam_mark_table=$exam_name.'_'.$group;
$student_table='student_info_'.$group;

if($exam_name=='1st_year_1st_term'||$exam_name=='1st_year_2nd_term'||$exam_name=='1st_year_final'){
    $class='একাদশ';
}else{
    $class='দ্বাদশ';
}

if($group=='science'){
    $group_bangla='বিজ্ঞান';
}
elseif($group=='business'){
    $group_bangla='ব্যবসায় শিক্ষা';
}else{
    $group_bangla='মানবিক';
}

$result = mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");

while($table_content = mysqli_fetch_array($result)):
    $student_id = $table_content['Student ID'];
    $grade=$table_content['grade'];
    $attendance=$table_content['attendance'];

    if($attendance==0){
        $total_att=0; $std_att=0; $absent=0; $percentage=0;
    
    }else{
        $total_att= intdiv($attendance,100);
    $std_att=$attendance%100;
    $absent=$total_att-$std_att;
    $percentage=($std_att*100)/$total_att;
    }
   
    $subject_table= mysqli_query($conn,"SELECT * FROM $student_table WHERE `student_id` ='$student_id'");
$subjects=mysqli_fetch_array($subject_table);
$student_name=$subjects['name_bangla'];
$subject1= $subjects['subject1'];
$subject2= $subjects['subject2'];
$subject3= $subjects['subject3'];
$fourth_sub= $subjects['fourth_sub'];


    
    
$data.='

<table class="upper_table">
             <tr>
                <td class="student_info" >
                <img src="inc/img/logo.jpg" alt="Girl in a jacket" width="100"><br><br>
                নাম:'.$student_name.'<br>
                শ্রেণি:'.$class.'<br>
                শাখা:'.$group_bangla.'<br>
                রোল: '.bfn($student_id).'<br>
                শিক্ষাবর্ষ: '.bfn($year).'<br>
                পরীক্ষা: '.exam_name_bangla($exam_name).'
                 </td>
              <td class="heading" >
                  <span style="font-size:26px;">বাড়বকুণ্ড হাই স্কুল এন্ড কলেজ </span><br>
                  <span style="font-size:15px;">অগ্রগতি বিষয়ক প্রতিবেদন-২০২৩ খ্রি.</span><br>
                  <span style="font-size:15px;">'.exam_name_bangla($exam_name).' পরীক্ষা</span><br><br><br><br><br><br><br><br><br><br><br><br>
              </td>
             
             <td class="right_table">
            <table class="gradesheet_table">
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
    <table class="result_table">
        <tr>
            <th>বিষয়</th><th style="padding: 0px 15px;">পত্র</th><th style="padding: 0px 15px;">পূর্ণ নম্বর</th><th style="padding: 0px 15px;">সৃজনশীল</th><th style="padding: 0px 15px;">বহু নির্বাচনী</th><th>ব্যবহারিক</th><th>মোট প্রাপ্ত নম্বর</th><th style="padding: 0px 5px;">প্রাপ্ত নম্বরের গড়</th><th>গ্রেড পয়েন্ট</th><th>লেটার গ্রেড</th><th>জিপিএ <br>অতি.বি.ছাড়া</th><th>জিপিএ</th><th>মন্তব্য</th>
        </tr>';
        
            $data.=' <tr>
        <td rowspan="2">বাংলা</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content['bangla1 crtv']).'</td><td>'.bfn($table_content['bangla1 mcq']).'</td><td></td><td>'.bfn($table_content['bangla1 total']).'</td><td rowspan="2">'.bfn($table_content['bangla avg']).'</td><td rowspan="2">'.bfn(number_format($table_content['bangla gp'],2)).'</td><td style="color:'.redmark($table_content['bangla lg']).';" rowspan="2">'.lg_bangla($table_content['bangla lg']).'</td><td rowspan="12">'.bfn(number_format($table_content['gpa without 4th'],2)).'</td><td rowspan="15">'.bfn(number_format($table_content['gpa'],2)).'</td><td rowspan="15"></td>
        </tr>';
        $data.=' <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content['bangla2']).'</td><td></td><td></td><td>'.bfn($table_content['bangla2 total']).'</td>
        </tr>';

        $data.='<tr>
        <td rowspan="2">ইংরেজি</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content['english1']).'</td><td></td><td></td><td>'.bfn($table_content['english1']).'</td><td rowspan="2">'.bfn($table_content['english avg']).'</td><td rowspan="2">'.bfn(number_format($table_content['english gp'],2)).'</td><td style="color:'.redmark($table_content['english lg']).';" rowspan="2">'.lg_bangla($table_content['english lg']).'</td>
        </tr>
        <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content['english2']).'</td><td></td><td></td><td>'.bfn($table_content['english2']).'</td>
        </tr>
        <tr>
        <td>তথ্য ও যোগাযোগ প্রযুক্তি</td><td></td><td>১০০</td><td>'.bfn($table_content['ict crtv']).'</td><td>'.bfn($table_content['ict mcq']).'</td><td>'.bfn($table_content['ict prac']).'</td><td>'.bfn($table_content['ict total']).'</td><td></td><td>'.bfn(number_format($table_content['ict gp'],2)).'</td><td style="color:'.redmark($table_content['ict lg']).';">'.lg_bangla($table_content['ict lg']).'</td>
        </tr>
        <tr>
        <td rowspan="2">'.subject_name_bangla($subject1).'</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject1.'1 crtv']).'</td><td>'.bfn($table_content[$subject1.'1 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject1.'1 prac']);}$data.='</td><td>'.bfn($table_content[$subject1.'1 total']).'</td><td rowspan="2">'.bfn($table_content[$subject1.' avg']).'</td><td rowspan="2">'.bfn(number_format($table_content[$subject1.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject1.' lg']).';" rowspan="2">'.lg_bangla($table_content[$subject1.' lg']).'</td>
        </tr>
        <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject1.'2 crtv']).'</td><td>'.bfn($table_content[$subject1.'2 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject1.'2 prac']);}$data.='</td><td>'.bfn($table_content[$subject1.'2 total']).'</td>
        </tr>
        <tr>
        <td rowspan="2">'.subject_name_bangla($subject2).'</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject2.'1 crtv']).'</td><td>'.bfn($table_content[$subject2.'1 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject2.'1 prac']);}$data.='</td><td>'.bfn($table_content[$subject2.'1 total']).'</td><td rowspan="2">'.bfn($table_content[$subject2.' avg']).'</td><td rowspan="2">'.bfn(number_format($table_content[$subject2.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject2.' lg']).';" rowspan="2">'.lg_bangla($table_content[$subject2.' lg']).'</td>
        </tr>
        <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject2.'2 crtv']).'</td><td>'.bfn($table_content[$subject2.'2 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject2.'2 prac']);}$data.='</td><td>'.bfn($table_content[$subject2.'2 total']).'</td>
        </tr>
        <tr>
        <td rowspan="2">'.subject_name_bangla($subject3).'</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject3.'1 crtv']).'</td><td>'.bfn($table_content[$subject3.'1 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject3.'1 prac']);}$data.='</td><td>'.bfn($table_content[$subject3.'1 total']).'</td><td rowspan="2">'.bfn($table_content[$subject3.' avg']).'</td><td rowspan="2">'.bfn(number_format($table_content[$subject3.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject3.' lg']).';" rowspan="2">'.lg_bangla($table_content[$subject3.' lg']).'</td>
        </tr>
        <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content[$subject3.'2 crtv']).'</td><td>'.bfn($table_content[$subject3.'2 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$subject3.'2 prac']);}$data.='</td><td>'.bfn($table_content[$subject3.'2 total']).'</td>
        </tr>
        <tr>
        <td colspan="9" style="text-align:left;">&nbsp;&nbsp;অতিরিক্ত বিষয়:</td>
        </tr>
        <tr>
        <td rowspan="2">'.subject_name_bangla($fourth_sub).'</td><td>১ম পত্র</td><td>১০০</td><td>'.bfn($table_content[$fourth_sub.'1 crtv']).'</td><td>'.bfn($table_content[$fourth_sub.'1 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$fourth_sub.'1 prac']);}$data.='</td><td>'.bfn($table_content[$fourth_sub.'1 total']).'</td><td rowspan="2">'.bfn($table_content[$fourth_sub.' avg']).'</td><td rowspan="2">'.bfn(number_format($table_content[$fourth_sub.' gp'],2)).'</td><td style="color:'.redmark($table_content[$fourth_sub.' lg']).';" rowspan="2">'.lg_bangla($table_content[$fourth_sub.' lg']).'</td><td rowspan="2">'.bfn($table_content['point_from_4th']).'</td>
        </tr>
        <tr>
        <td>২য় পত্র</td><td>১০০</td><td>'.bfn($table_content[$fourth_sub.'2 crtv']).'</td><td>'.bfn($table_content[$fourth_sub.'2 mcq']).'</td><td>';if($group=='science'){ $data.=bfn($table_content[$fourth_sub.'2 prac']);}$data.='</td><td>'.bfn($table_content[$fourth_sub.'2 total']).'</td>
        </tr>
        <tr>
        <td>মোট নম্বর:</td><td colspan="5"></td><td>'.bfn($table_content['number']).'</td><td colspan="4"></td>
        </tr>


    </table><br>

    <table class="lower_table">
       <tr>
            <td width="150">ক্লাসে মেধাস্থান</td><td width="150">'.bfn($table_content['position']).'তম</td><td>'.comment_on_grade($grade).'</td>
       </tr>

    </table>
    <div>মোট ক্লাস: '.bfn($total_att).'<br>
         মোট উপস্থিতি:'.bfn($std_att).' <br>
         মোট অনুপস্থিতি: '.bfn($absent).'<br>
         উপস্থিতির হার: '.bfn(round($percentage,1)).'% <br>
         আচরণ: ভালো</div><br><br>
    
    <table class="sign_table">
    <tr> <td>আহবায়ক</td><td>অভিভাবকের স্বাক্ষর</td><td>প্রধান শিক্ষক</td></tr>

    </table>
   <p style="page-break-before:always;">  </p>

';



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

