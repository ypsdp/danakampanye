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
header("Content-Disposition: attachment;Filename=LADK-4-".$arr['JENIS_PENCALONAN'].".rtf");


echo fill_template("template/LADK4_TEMPLATE.rtf", $arr);
?>
