

<?php
include('conn.php');
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' => 50,'margin_bottom' => 5]);
//$mpdf = new \Mpdf\Mpdf(['','A4',40,'nikosh']);

$data='';
$data.='
<html>
<head>
  <style>
    body{
        font-family:kalpurush;
    }
   
   table{
    
    border-collapse:collapse;
    width:100%;
    text-align:center;
   }
   table tr th,td{
    border:1px solid black;
   }
   .doc_head{
    text-align:center;
    font-weight:bold;
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
    $english_name=array('bangla','english','ict','physics','chemistry','biology','math','accounting','production_management','business_organization','finance','economics','civics','logic','social_science','islamic_history');
    $bangla_name=array('বাংলা','ইংরেজি','তথ্য ও যোগাযোগ প্রযুক্তি','পদার্থবিজ্ঞান','রসায়নবিজ্ঞান','জীববিজ্ঞান','গনিত','হিসাববিজ্ঞান','উৎপাদন ব্যবস্থাপনা ও বিপণন','ব্যবসায় সংগঠন ও ব্যবস্থাপনা','ফাইনান্স ও ব্যাংকিং','অর্থনীতি','পৌরনীতি','যুক্তিবিদ্যা','সমাজবিজ্ঞান','ইসলামে ইতিহাস');
    return str_replace($english_name,$bangla_name,$subject_name);
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

$result = mysqli_query($conn,"SELECT $exam_mark_table.* ,$student_table.`year`,$student_table.`name_bangla` FROM $exam_mark_table INNER JOIN $student_table ON $exam_mark_table.`Student ID`=$student_table.student_id WHERE `year`='$year'");
$header='';
$header.='
<div class="doc_head">
<span style="font-size:25px;">বাড়বকুণ্ড হাই স্কুল এন্ড কলেজ</span><br>
<span style="font-size:15px;">চূড়ান্ত ফলাফল-২০২৫ খ্রি.<br>
'.exam_name_bangla($exam_name).' পরীক্ষা<br>
শ্রেণি: '.$class.'<br>
বিভাগ: '.$group_bangla.'</span>
</div>
';
$mpdf->SetHTMLHeader($header);

$data.='

<table>
    <tr>
        <th>ক্রম</th><th>রোল</th><th>শিক্ষার্থীর নাম</th><th>মোট প্রাপ্ত নম্বর<br>(৪র্থ বিষয় সহ)</th><th>জিপিএ<br>(৪র্থ বিষয়সহ)</th><th>গ্রেড</th><th>ক্লাসে মেধাস্থান</th><th>মন্তব্য</th>
    </tr>';
$data_row='';
$sl=0;
while($table_content = mysqli_fetch_array($result)):
    $student_id = $table_content['Student ID'];
   $sl=$sl+1;
   if($table_content['grade']=='F'){
    $grade= lg_bangla($table_content['grade']).bfn($table_content['pos_grade']);
   }else{
    $grade=lg_bangla($table_content['grade']);
   }
    $data_row.='
    <tr>
        <td>'.bfn($sl).'</td><td>'.bfn($table_content['Student ID']).'</td><td>'.$table_content['name_bangla'].'</td><td>'.bfn($table_content['number']).'</td><td>'.bfn(number_format($table_content['gpa'],2)).'</td><td>'.$grade.'</td><td>'.bfn($table_content['position']).' তম</td><td></td>
    </tr>

    
    ';
    
    
    




//$mpdf->AddPage();
endwhile;

$data.=$data_row.'
</table>
</body>
</html>
';

$mpdf->WriteHTML($data);


//


//echo $data;

$mpdf->Output($group.'_'.$exam_name.'_result.pdf','I');

?>

