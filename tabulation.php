

<?php
include('conn.php');
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L','margin_top' => 40,'margin_bottom' => 30]);
//$mpdf = new \Mpdf\Mpdf(['','A4',40,'nikosh']);

$data='';
$data.='
<html>
<head>
  <style>
    body{
        font-family:kalpurush;
        
    }

   .result_table{
   
    border-collapse:collapse;
    text-align:center;
   
   }
   .result_table tr th,td{
    border:1px solid black;
    padding:2px;
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
    $bangla_name=array('অর্ধবার্ষিকী','২য় সাময়িক','বর্ষ সমাপনী','প্রাক নির্বাচনী','নির্বাচনী');
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

$exam_table_name=$exam_name.'_'.$group;
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

$header='';
$header='
<div style="text-align:center; font-size:20px;">বাড়বকুণ্ড হাইস্কুল এন্ড কলেজ</div>
<div style="text-align:center; font-size:16px;">বাড়বকুণ্ড, সীতাকুণ্ড, চট্টগ্রাম</div>
<div style="text-align:center; font-size:16px;">টেবুলেশন শিট</div>
<div> <span>শ্রেণী: '.$class.'</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>বিভাগ: '.$group_bangla.'</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span> শিক্ষাবর্ষ: '.bfn($year).'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>পরীক্ষা: '.exam_name_bangla($exam_name).'</span></div>
';

$mpdf->SetHTMLHeader($header);
include('conn.php');
$result_info = mysqli_query($conn, "SELECT $exam_table_name.*,$student_table.`student_name`,$student_table.`name_bangla`,$student_table.`year` FROM $exam_table_name INNER JOIN $student_table ON $exam_table_name.`Student ID`=$student_table.student_id WHERE `year`='$year'");

if($group=='science')
{
$data.='
<table class="result_table">
  <thead>
    <tr>
        <th rowspan="2">রোল</th><th rowspan="2">নাম</th><th colspan="3">বাংলা</th><th colspan="3">ইংরেজি</th><th colspan="3"> আইসিটি</th><th colspan="3">পদার্থবিজ্ঞান</th><th colspan="3">রসায়নবিজ্ঞান</th><th colspan="3">জীববিজ্ঞান</th><th colspan="3">উচ্চতর গণিত</th><th rowspan="2">৪র্থ বিষয়</th><th rowspan="2">জিপিএ<br>(৪র্থ বিষয় ছাড়া)</th><th rowspan="2">৪র্থ বিষয় হতে <br>প্রাপ্ত পয়েন্ট</th><th rowspan="2">জিপিএ</th><th rowspan="2">লেটার <br>গ্রেড</th>
    </tr>
    <tr>
        <td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td>
    </tr>
    </thead>

';

while($table_content = mysqli_fetch_array($result_info)):
    
$data.='
<tr>
    <td>'.bfn($table_content['Student ID']).'</td><td>'.$table_content['name_bangla'].'</td><td>'.bfn($table_content['bangla total final']).'</td><td>'.bfn(number_format($table_content['bangla gp'],2)).'</td><td>'.lg_bangla($table_content['bangla lg']).'</td><td>'.bfn($table_content['english total final']).'</td><td>'.bfn(number_format($table_content['english gp'],2)).'</td><td>'.lg_bangla($table_content['english lg']).'</td><td>'.bfn($table_content['ict total final']).'</td><td>'.bfn(number_format($table_content['ict gp'],2)).'</td><td>'.lg_bangla($table_content['ict lg']).'</td><td>'.bfn($table_content['physics total final']).'</td><td>'.bfn(number_format($table_content['physics gp'],2)).'</td><td>'.lg_bangla($table_content['physics lg']).'</td><td>'.bfn($table_content['chemistry total final']).'</td><td>'.bfn(number_format($table_content['chemistry gp'],2)).'</td><td>'.lg_bangla($table_content['chemistry lg']).'</td><td>'.bfn($table_content['biology total final']).'</td><td>'.bfn(number_format($table_content['biology gp'],2)).'</td><td>'.lg_bangla($table_content['biology lg']).'</td><td>'.bfn($table_content['math total final']).'</td><td>'.bfn(number_format($table_content['math gp'],2)).'</td><td>'.lg_bangla($table_content['math lg']).'</td><td>'.subject_name_bangla($table_content['fourth_sub']).'</td><td>'.bfn(number_format($table_content['gpa without 4th'],2)).'</td><td>'.bfn($table_content['point_from_4th']).'</td><td>'.bfn(number_format($table_content['gpa'],2)).'</td><td>'.lg_bangla($table_content['grade']).
'</td></tr>
' ;
endwhile;  

$data.='
</table>
';
}elseif($group=='business'){
    $data.='
    <table class="result_table">
      <thead>
        <tr>   
            <th rowspan="2">রোল</th><th rowspan="2">নাম</th><th colspan="3">বাংলা</th><th colspan="3">ইংরেজি</th><th colspan="3"> আইসিটি</th><th colspan="3">হিসাববিজ্ঞান</th><th colspan="3">ব্যবসায় সংগঠন ও ব্যবস্থাপনা</th><th colspan="3">উৎপাদন ব্যবস্থাপনা ও বিপণন</th><th colspan="3">অর্থনীতি</th><th rowspan="2">৪র্থ বিষয়</th><th rowspan="2">জিপিএ<br>(৪র্থ বিষয় ছাড়া)</th><th rowspan="2">৪র্থ বিষয় হতে <br>প্রাপ্ত পয়েন্ট</th><th rowspan="2">জিপিএ</th><th rowspan="2">লেটার <br>গ্রেড</th>
        </tr>
        <tr>
            <td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td>
        </tr>
        </thead>
    
    ';
    
    while($table_content = mysqli_fetch_array($result_info)):
        
    $data.='
    <tr>
        <td>'.bfn($table_content['Student ID']).'</td><td>'.$table_content['name_bangla'].'</td><td>'.bfn($table_content['bangla total final']).'</td><td>'.bfn(number_format($table_content['bangla gp'],2)).'</td><td>'.lg_bangla($table_content['bangla lg']).'</td><td>'.bfn($table_content['english total final']).'</td><td>'.bfn(number_format($table_content['english gp'],2)).'</td><td>'.lg_bangla($table_content['english lg']).'</td><td>'.bfn($table_content['ict total final']).'</td><td>'.bfn(number_format($table_content['ict gp'],2)).'</td><td>'.lg_bangla($table_content['ict lg']).'</td><td>'.bfn($table_content['accounting total final']).'</td><td>'.bfn(number_format($table_content['accounting gp'],2)).'</td><td>'.lg_bangla($table_content['accounting lg']).'</td><td>'.bfn($table_content['business_organization total final']).'</td><td>'.bfn(number_format($table_content['business_organization gp'],2)).'</td><td>'.lg_bangla($table_content['business_organization lg']).'</td><td>'.bfn($table_content['production_management total final']).'</td><td>'.bfn(number_format($table_content['production_management gp'],2)).'</td><td>'.lg_bangla($table_content['production_management lg']).'</td><td>'.bfn($table_content['economics total final']).'</td><td>'.bfn(number_format($table_content['economics gp'],2)).'</td><td>'.lg_bangla($table_content['economics lg']).'</td><td>'.subject_name_bangla($table_content['fourth_sub']).'</td><td>'.bfn(number_format($table_content['gpa without 4th'],2)).'</td><td>'.bfn($table_content['point_from_4th']).'</td><td>'.bfn(number_format($table_content['gpa'],2)).'</td><td>'.lg_bangla($table_content['grade']).
    '</td></tr>
    ' ;
    endwhile;  
    
    $data.='
    </table>
    ';
    

}else{
    $data.='
    <table class="result_table">
      <thead>
        <tr>   
            <th rowspan="2">রোল</th><th rowspan="2">নাম</th><th colspan="3">বাংলা</th><th colspan="3">ইংরেজি</th><th colspan="3"> আইসিটি</th><th colspan="3">পৌরনীতি</th><th colspan="3">যুক্তিবিদ্যা</th><th colspan="3">সমাজবিজ্ঞান</th><th colspan="3">ইসলামে ইতিহাস</th><th colspan="3">অর্থনীতি</th><th rowspan="2">৪র্থ বিষয়</th><th rowspan="2">জিপিএ<br>(৪র্থ বিষয় ছাড়া)</th><th rowspan="2">৪র্থ বিষয় হতে <br>প্রাপ্ত পয়েন্ট</th><th rowspan="2">জিপিএ</th><th rowspan="2">লেটার <br>গ্রেড</th>
        </tr>
        <tr>
            <td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td><td>নম্বর</td><td>গ্রেড <br> পয়েন্ট</td><td>লেটার <br> গ্রেড</td>
        </tr>
        </thead>
    
    ';
    
    while($table_content = mysqli_fetch_array($result_info)):
        
    $data.='
    <tr>
        <td>'.bfn($table_content['Student ID']).'</td><td>'.$table_content['name_bangla'].'</td><td>'.bfn($table_content['bangla total final']).'</td><td>'.bfn(number_format($table_content['bangla gp'],2)).'</td><td>'.lg_bangla($table_content['bangla lg']).'</td><td>'.bfn($table_content['english total final']).'</td><td>'.bfn(number_format($table_content['english gp'],2)).'</td><td>'.lg_bangla($table_content['english lg']).'</td><td>'.bfn($table_content['ict total final']).'</td><td>'.bfn(number_format($table_content['ict gp'],2)).'</td><td>'.lg_bangla($table_content['ict lg']).'</td><td>'.bfn($table_content['civics total final']).'</td><td>'.bfn(number_format($table_content['civics gp'],2)).'</td><td>'.lg_bangla($table_content['civics lg']).'</td><td>'.bfn($table_content['logic total final']).'</td><td>'.bfn(number_format($table_content['logic gp'],2)).'</td><td>'.lg_bangla($table_content['logic lg']).'</td><td>'.bfn($table_content['sociology total final']).'</td><td>'.bfn(number_format($table_content['sociology gp'],2)).'</td><td>'.lg_bangla($table_content['sociology lg']).'</td><td>'.bfn($table_content['islamic_history total final']).'</td><td>'.bfn(number_format($table_content['islamic_history gp'],2)).'</td><td>'.lg_bangla($table_content['islamic_history lg']).'</td><td>'.bfn($table_content['economics total final']).'</td><td>'.bfn(number_format($table_content['economics gp'],2)).'</td><td>'.lg_bangla($table_content['economics lg']).'</td><td>'.subject_name_bangla($table_content['fourth_sub']).'</td><td>'.bfn(number_format($table_content['gpa without 4th'],2)).'</td><td>'.bfn($table_content['point_from_4th']).'</td><td>'.bfn(number_format($table_content['gpa'],2)).'</td><td>'.lg_bangla($table_content['grade']).
    '</td></tr>
    ' ;
    endwhile;  
    
    $data.='
    </table>
    ';
    


}
//$mpdf->SetHTMLFooter($footer);

$data.='</body>
</html>
';

$mpdf->WriteHTML($data);


//


//echo $data;
$filename=$group.'_'.$exam_name.'_tabulation.pdf';

$mpdf->Output($filename,'I');

?>

