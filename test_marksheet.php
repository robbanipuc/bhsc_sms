

<?php
include('conn.php');
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' => 70,'margin_bottom' => 60]);
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
        font-size:10px;
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
        font-size:12px;
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
   
    width:100%;
    border:none;
   }
   .lower_table tr td{
    border:none;
    
   }
   .grade_table{
    border-collapse:collapse;
    text-align:center;
   }
   .grade_table tr td{
    border:1px solid black;
    padding:5px;
    font-size:12px;
   }
   

  </style>
</head>
<body>
';
$i=0;
$A_plus=0; $A=0; $A_min=0; $B=0; $C=0; $D=0; $F=0;
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
$subject = $_GET['subject'];
$exam_mark_table=$exam_name.'_'.$group;
$student_table='student_info_'.$group;
$part=$_GET['part'];

if($part=='1'){
    $potro='১ম পত্র';

}else{
    $potro='২য় পত্র';
}

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

$header='';
$header.='
<table class="upper_table">
             <tr>
                <td class="student_info">
                
                বিষয়: '.subject_name_bangla($subject).' '.$potro.'<br>
                শ্রেণি: '.$class.'<br>
                বিভাগ: '.$group_bangla.'<br>
                শিক্ষাবর্ষ: '.bfn($year).'<br>
                বিষয় কোড: 
                 </td>
              <td class="heading" >
                  <span style="font-size:26px;">বাড়বকুণ্ড হাই স্কুল এন্ড কলেজ </span><br>
                  <span style="font-size:15px;">সীতাকুণ্ড, চট্টগ্রাম।</span><br>
                  <span style="font-size:15px;">'.exam_name_bangla($exam_name).' পরীক্ষা-২০২৫</span><br>
                  <span style="font-size:26px;"><u>নম্বরপত্র</u></span><br><br><br><br><br><br><br>
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

';
$mpdf->SetHTMLHeader($header);
$data.='

    <table class="result_table">
    <thead>
        <tr>
            <th>রোল</th><th>সৃজনশীল</th><th>বহুনির্বাচনী</th><th>ব্যবহারিক</th><th>মোট প্রাপ্ত নম্বর</th><th>জিপি</th><th>লেটার গ্রেড</th><th>মন্তব্য</th>
        </tr>
    </thead>
        '
        ;


$result = mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");

while($table_content = mysqli_fetch_array($result)):
    $student_id = $table_content['Student ID'];
    $grade=$table_content['grade'];
    $lg=$table_content[$subject.' lg'];
   
    
if($subject=='english'){
    $data.='
        <tr>
        <td>'.bfn($student_id).'</td><td>'.bfn($table_content[$subject.$part]).'</td><td></td><td></td><td>'.bfn($table_content[$subject.$part]).'</td><td>'.bfn(number_format($table_content[$subject.$part.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject.$part.' lg']).';">'.lg_bangla($table_content[$subject.$part.' lg']).'</td><td> </td>
        </tr>
';
}elseif($subject=='physics'||$subject=='chemistry'||$subject=='math'||$subject=='biology'||$subject=='ict'){
    $data.='
        <tr>
        <td>'.bfn($student_id).'</td><td>'.bfn($table_content[$subject.$part.' crtv']).'</td><td>'.bfn($table_content[$subject.$part.' mcq']).'</td><td>'.bfn($table_content[$subject.$part.' prac']).'</td><td>'.bfn($table_content[$subject.$part.' total']).'</td><td>'.bfn(number_format($table_content[$subject.$part.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject.$part.' lg']).';">'.lg_bangla($table_content[$subject.$part.' lg']).'</td><td> </td>
        </tr>
'; 
}else{
    if($subject=='bangla'&&$part=='2'){
        $data.='
        <tr>
        <td>'.bfn($student_id).'</td><td>'.bfn($table_content[$subject.$part]).'</td><td></td><td></td><td>'.bfn($table_content[$subject.$part]).'</td><td>'.bfn(number_format($table_content[$subject.$part.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject.$part.' lg']).';">'.lg_bangla($table_content[$subject.$part.' lg']).'</td><td> </td>
        </tr>
'; 

    }else{
        $data.='
        <tr>
        <td>'.bfn($student_id).'</td><td>'.bfn($table_content[$subject.$part.' crtv']).'</td><td>'.bfn($table_content[$subject.$part.' mcq']).'</td><td></td><td>'.bfn($table_content[$subject.$part.' total']).'</td><td>'.bfn(number_format($table_content[$subject.$part.' gp'],2)).'</td><td style="color:'.redmark($table_content[$subject.$part.' lg']).';">'.lg_bangla($table_content[$subject.$part.' lg']).'</td><td> </td>
        </tr>
'; 
    }
}

/* $data.='
        <tr>
        <td>'.bfn($student_id).'</td><td>'.bfn($table_content[$subject.' crtv']).'</td><td>'.bfn($table_content[$subject.' mcq']).'</td><td>'.bfn($prac).'</td><td>'.bfn($table_content[$subject.' total']).'</td><td>'.bfn($table_content[$subject.' total90']).'</td><td>'.bfn($table_content[$subject.' ct']).'</td><td>'.bfn($table_content[$subject.' total final']).'</td><td>'.bfn(number_format($table_content[$subject.' gp'],2)).'</td><td>'.lg_bangla($table_content[$subject.' lg']).'</td><td> </td>
        </tr>
'; */
if($lg=='A+'){
    $A_plus+=1;
}else{
    if($lg=='A'){
        $A+=1;
    }else{
        if($lg=='A-'){
            $A_min+=1;
        }else{
            if($lg=='B'){
                $B+=1;
            }else{
                if($lg=='C'){
                    $C+=1;
                }else{
                    if($lg=='D'){
                        $D+=1;
                    }else{
                        $F+=1;
                    }
                }
            }
        }
    }
}


//$mpdf->AddPage();
endwhile;
$total_students=$A_plus+$A+$A_min+$B+$C+$D+$F;
$students_passed=$total_students-$F;

$data.='
</table>';


$footer='';
$footer.='
<br>
<table class="lower_table">
<tr>
<td>
পরীক্ষার্থীর সংখ্যা: '.bfn($total_students).' <br>
মোট উত্তীর্ণ পরীক্ষর্থীর সংখ্যা: '.bfn($students_passed).' <br><br><br><br><br><br><br>
পরীক্ষকের স্বাক্ষর ও তারিখ
</td>

<td>
 <table class="grade_table">
  <tr>
   <td>এ+</td>
   <td>'.bfn($A_plus).'</td>
  </tr>
  <tr>
   <td>এ</td>
   <td>'.bfn($A).'</td>
  </tr>
  <tr>
   <td>এ-</td>
   <td>'.bfn($A_min).'</td>
  </tr>
  <tr>
   <td>বি</td>
   <td>'.bfn($B).'</td>
  </tr>
  <tr>
   <td>সি</td>
   <td>'.bfn($C).'</td>
  </tr>
  <tr>
   <td>ডি</td>
   <td>'.bfn($D).'</td>
  </tr>
  <tr>
   <td>এফ</td>
   <td>'.bfn($F).'</td>
  </tr>

 </table>
</td>
<td style="text-align:right">
<br><br><br><br><br><br><br><br>
প্রধান শিক্ষকের স্বাক্ষর ও তারিখ
</td>

</tr>

</table>
';

$mpdf->SetHTMLFooter($footer);

$data.='</body>
</html>
';

$mpdf->WriteHTML($data);


//


//echo $data;
$filename=$subject.'_'.$group.'_'.$exam_name.'_marksheet.pdf';

$mpdf->Output($filename,'I');

?>

