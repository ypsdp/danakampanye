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
header("Content-Disposition: attachment;Filename=LPSDK-2-".$arr['JENIS_PENCALONAN'].".rtf");

$arr['nama_tim'] = 'Partai Politik/Gabungan Partai Politik';

if ($arr['jnspencalonan_id'] == 1){   
	$filename = "template/LPSDK2_TEMPLATE.rtf";
}else { 
   $filename = "template/LPSDK2_TEMPLATE_PERSEORANGAN.rtf";
}

echo fill_template($filename, $arr);
