<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------
if ($_GET['type']=="empty") {
	$file = '../../dana-empty.db';
	$output_name = 'DK_kosong.dat';
} else {
	$file = '../../dana.db';
	$output_name = 'DK_'.date("Ymd_his").'.dat';
}

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$output_name.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}