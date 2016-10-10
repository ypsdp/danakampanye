<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------

include ("../app/Http/helpers.php");
include("db.php");

header("Content-type: application/vnd.ms-word");
header("Content-type: application/rtf");
header("Content-Disposition: attachment;Filename=LPPDK-1-".$arr['JENIS_PENCALONAN'].".rtf");



$arr['nama_tim'] = 'Partai Politik/Gabungan Partai Politik';

if ($arr['jnspencalonan_id'] == 1){   
	$file_name = "template/LPPDK1_PARPOL_TEMPLATE.rtf";
}else { 
   $file_name = "template/LPPDK1_PERSEORANGAN_TEMPLATE.rtf";
}

echo fill_template($file_name, $arr);

