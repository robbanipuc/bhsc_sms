<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$data='';
$i=0;


$data.='<p>this is a text</p><br><p>this is a text</p><br>';
echo $data;

$mpdf->WriteHTML($data);
$mpdf->AddPage();
$data1='<p>this is a text in second page</p><br><p>this is a text</p><br>';
echo $data1;

$mpdf->WriteHTML($data1);

$mpdf->Output('myfile.pdf','D');