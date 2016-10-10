<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------
$path = $_FILES['file']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

    if ( $ext == "dat"  ) {

	    if ( 0 < $_FILES['file']['error'] || substr($path, 0, 3) != "DK_"  ) {
	        echo 'Gagal!, format nama file yang diterima adalah "DK_*.dat"' ;// . $_FILES['file']['error'] ;
	    }
	    else {
	        move_uploaded_file($_FILES['file']['tmp_name'], '../../dana.db');
	        echo 'Restore Success!';
	    }
    } else {	        
    	echo "Gagal!, Ekstensi $ext, bukan *.dat";
    }

?>