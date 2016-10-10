<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016 
//-----------------------------------------------------

include ("../app/Http/helpers.php");
include("db.php");
$password = "kpu123";
/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

if ($arr['jnspencalonan_id'] == 1){   
	$inputFileName = "template/LPSDK_TEMPLATE.xls";
}else { 
	$inputFileName = "template/LPSDK_TEMPLATE_PERSEORANGAN.xls";
}

//$objReader = PHPExcel_IOFactory::createReader($fileType);
//$objPHPExcel = $objReader->load($fileName);

	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);

//$objPHPExcel = PHPExcel_IOFactory::load($filename);

$objPHPExcel->getProperties()->setCreator("DaKam")
                                                         ->setLastModifiedBy("Da kam")
                                                         ->setTitle("Dana Kampanye")
                                                         ->setSubject("")
                                                         ->setDescription("")
                                                         ->setKeywords("")
                                                         ->setCategory("");
$objPHPExcel->getSheetByName('DATA')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);



//echo "<pre>"; var_dump ($arr);
$activeSheet = $objPHPExcel->getSheetByName('DATA');
protect_sheet($activeSheet, $password);

$activeSheet ->setCellValue('B2', $arr['jenis_pilkada'])
            ->setCellValue('B3', $arr['nama_daerah'])
            ->setCellValue('B4', $arr['jenis_pencalonan'])
            ->setCellValue('B5', 'PERIODE: ' . $arr['periode_lpsdk'])
            ->setCellValue('B6', $arr['tanggal_lpsdk'])
            ->setCellValue('B8', strtoupper($arr['nama_kepala']))
            ->setCellValue('B9', $arr['nik_kepala']) 
            ->setCellValue('B10', $arr['npwp_kepala'])
            ->setCellValue('B11', $arr['alamat_kepala'])
            ->setCellValue('B12', strtoupper($arr['nama_wakil']))
            ->setCellValue('B13', $arr['nik_wakil'])
            ->setCellValue('B14', $arr['npwp_wakil'])
            ->setCellValue('B15', $arr['alamat_wakil'])
            ->setCellValue('B18', $arr['tanggal_reksus'])
            ->setCellValue('B19', $arr['bank_reksus'])
            ->setCellValue('B20', $arr['no_reksus'])
            ->setCellValue('D2', $arr['ttd'])
            ->setCellValue('D3', $arr['tingkat'])
            ->setCellValue('D4', $arr['ketua_tim'])
            ->setCellValue('D5', $arr['bendahara_tim'])
            ->setCellValue('D6', $arr['partai_pengusung'])
            
            ->setCellValue('D8', strtoupper($arr['nama_kepala']) . " - " . strtoupper($arr['nama_wakil']))
            ->setCellValue('D9', $arr['npwp_kepala'] . " dan " . $arr['npwp_wakil'])
            
            ->setCellValue('B23', $arr['sum_Pasangan Calon'])
            ->setCellValue('B24', $arr['sum_Partai Politik'])
            ->setCellValue('B25', $arr['sum_Perseorangan'])
            ->setCellValue('B26', $arr['sum_Kelompok'])
            ->setCellValue('B27', $arr['sum_Badan Hukum Swasta'])
            ->setCellValue('B28', 0);
//-------------------------------------------------------
$objPHPExcel->setActiveSheetIndex(0);
$activeSheet = $objPHPExcel->getActiveSheet();
if($arr['jnspencalonan_id'] == 2) {
	$activeSheet->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
}

//protect_sheet($activeSheet, $password);

$row = 13;

$result = $db->query('SELECT * FROM v_penerimaan_lpsdk');

	    $i = 0; 
	    $total =0;
         while($res = $result->fetchArray(SQLITE3_ASSOC)){ 
             $row_id = $row + $i;
			 $activeSheet->insertNewRowBefore(($row_id),1);    

			  foreach ($alphabet as $values) {
				  $style = $objPHPExcel->getActiveSheet()->getStyle($values. ($row_id+1));
				  $objPHPExcel->getActiveSheet()->duplicateStyle($style,$values.$row_id);
			  }		
			 $activeSheet->getRowDimension($row_id)->setRowHeight(-1);
             $activeSheet->setCellValue('A'. ($row_id), $i + 1);
             $activeSheet->setCellValue('B'. ($row_id), tanggal($res['tanggal']));
             $activeSheet->setCellValue('C'. ($row_id), $res['nilai']);
             $activeSheet->setCellValue('D'. ($row_id), $res['unit']);
			 $total = $total + $res['nilai'];
			 
			  if ( $res['jnspenerimaan_id'] == 8) {
				  $activeSheet->setCellValue('G'. ($row_id), "V");} 
			  elseif ( $res['jnspenerimaan_id'] == 6 || $res['jnspenerimaan_id'] == 7 ) { 
			      $activeSheet->setCellValue('F'. ($row_id), "V"); }
			  else {
			  	  $activeSheet->setCellValue('E'. ($row_id), "V"); 
			  }

             $activeSheet->setCellValue('H'. ($row_id), $res['nama']);
             $activeSheet->setCellValue('I'. ($row_id), $res['no_rek_penyumbang']);
             $activeSheet->setCellValue('J'. ($row_id), $res['no_rek_penerima']);             
             $activeSheet->setCellValue('K'. ($row_id), $res['nomor']);
             $activeSheet->setCellValue('L'. ($row_id), $res['uraian']);             
             $i++; 
              //number_format($res['nilai'],0,",","."))
          }
             $activeSheet->setCellValue('C'. ($row_id+1), $total);



//-------------------------------------------------------
$objPHPExcel->setActiveSheetIndex(1);
$activeSheet = $objPHPExcel->getActiveSheet();
//protect_sheet($activeSheet, $password);

if($arr['jnspencalonan_id'] == 2) {
	$activeSheet->setTitle("LPSDK1-PERSEORANGAN");
}

$row = 16;

$styleArray = array(
    'font'  => array(
        'size'  => 7,
        'name'  => 'Arial Narrow'
    ));

$style2Array = array(
    'font'  => array(
        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'size'  => 10,
        'name'  => 'Arial Narrow'
    ));

$style3Array = array(
    'font'  => array(
        'bold'  => true,
        'size'  => 11,
    ));
    	
$result = $db->query('SELECT * FROM v_penerimaan_lpsdk_1');

	    $i = 0; 
		$j = 0; 

         while($res = $result->fetchArray(SQLITE3_ASSOC)){ 
             $row_id = $row + $i;
			 $activeSheet->insertNewRowBefore(($row_id),3);    

			  foreach ($alphabet as $values) {
				  $style = $activeSheet->getStyle($values. ($row_id+1));
				  $activeSheet->duplicateStyle($style,$values.$row_id);
			  }	
			 $activeSheet->getRowDimension($row_id-1)->setRowHeight(-1);
			 $activeSheet->getRowDimension($row_id+1)->setRowHeight(-1);
             $activeSheet->setCellValue('A'. ($row_id), ($i/3) + 1);
             $activeSheet->setCellValue('F'. ($row_id), $res['t_uang']);
             $activeSheet->setCellValue('G'. ($row_id), $res['t_barang']);			  
             $activeSheet->setCellValue('I'. ($row_id), $res['t_jasa']);			  
             $activeSheet->setCellValue('K'. ($row_id), $res['total']);			 
             
             if ($res['jnssumberdana_id'] != 1 and $res['jnssumberdana_id'] != 2 ) {
             $activeSheet->setCellValue('E'. ($row_id), $res['nama']);
             	$activeSheet->setCellValue('D'. ($row_id), 'Nama:');
	             $activeSheet->setCellValue('D'. ($row_id+1), "Alamat:\nTelepon:\nIdentitas: \nNPWP:");
	             $activeSheet->setCellValue('E'. ($row_id+1), $res['alamat'] ."\n" . $res['telepon']."\n" . $res['identitas']."\n" . $res['npwp']);
             } else {
             	$activeSheet->setCellValue('D'. ($row_id), $res['nama']);
             	$activeSheet->mergeCells('D'. $row_id .':'.'E'. $row_id);
             }
	         $activeSheet->setCellValue('F'. ($row_id+1), $res['g_uang']);
	         $activeSheet->setCellValue('G'. ($row_id+1), $res['g_barang']);			  
	         $activeSheet->setCellValue('I'. ($row_id+1), $res['g_jasa']);
	             
             $activeSheet->getStyle('F'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('G'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('I'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('K'. $row_id)->applyFromArray($style2Array);

             $activeSheet->getStyle('F'. ($row_id+1))->applyFromArray($styleArray);
             $activeSheet->getStyle('G'. ($row_id+1))->applyFromArray($styleArray);
             $activeSheet->getStyle('I'. ($row_id+1))->applyFromArray($styleArray);
             
             $activeSheet->getStyle('B'. ($row_id-1))->applyFromArray($style3Array);
             			
             if ($res['kategori'] != $old_kategori) {             			 
	             $j++;
		         $activeSheet->setCellValue('B'. ($row_id-1), ($alphabet[$j-1] . ". " . $res['kategori']) );
             	 $activeSheet->mergeCells('B'. ($row_id-1) .':'.'L'. ($row_id-1));
			 	 $activeSheet->getRowDimension($row_id-1)->setRowHeight(-1);
				 $old_kategori =$res['kategori'];
             }
             $i = $i+3; 
         }

			$row_id = $row_id +3;
			 $activeSheet->insertNewRowBefore(($row_id),3);    

			  foreach ($alphabet as $values) {
				  $style = $activeSheet->getStyle($values. ($row_id+1));
				  $activeSheet->duplicateStyle($style,$values.$row_id);
			  }	
              //number_format($res['nilai'],0,",","."))

$result = $db->query('SELECT sum(total) as t_total, sum(t_uang) as tt_uang, sum(t_barang) as tt_barang, sum(t_jasa) as tt_jasa FROM v_penerimaan_lpsdk_1');
$data = $result->fetchArray();

             $activeSheet->setCellValue('E'. ($row_id), 'Total');
             $activeSheet->setCellValue('F'. ($row_id), $data['tt_uang']);
             $activeSheet->setCellValue('G'. ($row_id), $data['tt_barang']);			  
             $activeSheet->setCellValue('I'. ($row_id), $data['tt_jasa']);			  
             $activeSheet->setCellValue('K'. ($row_id), $data['t_total']);			 
             $activeSheet->getStyle('F'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('G'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('I'. $row_id)->applyFromArray($style2Array);
             $activeSheet->getStyle('K'. $row_id)->applyFromArray($style2Array);
             
// Redirect output to a client▒~@~Ys web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="LPSDK-'.$arr['JENIS_PENCALONAN'].'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0



$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword('kpu123');

$type = 'Excel2007'; //'Excel2007'
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
$objWriter->save('php://output');


/*

//Pasangan Calon
//Partai Politik dan/atau Gabungan Partai Politik
//Sumbangan Pihak Lain Perseorangan
//Sumbangan Pihak Lain Kelompok
//Sumbangan Pihak Lain Badan Hukum Swasta		

 "Nama Penyumbang");
 "Alamat Penyumbang");
 "No. Telp Penyumbang");
 "No. Identitas Penyumbang");
"No. NPWP Penyumbang");

             $activeSheet->setCellValue('B'. ($row_id), $alphabet[$i/6] . '.');
			$activeSheet->setCellValue('C'.($row_id), "Nama Kelompok");
			$activeSheet->setCellValue('C'.($row_id+1), "Alamat Kelompok");
			$activeSheet->setCellValue('C'.($row_id+2), "No. Telp Kelompok");
			$activeSheet->setCellValue('C'.($row_id+3), "No. Identitas pimpinan kelompok");
			$activeSheet->setCellValue('C'.($row_id+4),"No. NPWP pimpinan Kelompok");

             $activeSheet->setCellValue('B'. ($row_id), $alphabet[$i/6] . '.');
			$activeSheet->setCellValue('C'.($row_id), "Nama Badan Hukum Swasta");
			$activeSheet->setCellValue('C'.($row_id+1), "Alamat Badan Hukum Swasta");
			$activeSheet->setCellValue('C'.($row_id+2), "No. Telp Badan Hukum Swasta");
			$activeSheet->setCellValue('C'.($row_id+3), "No. Identitas Badan Hukum Swasta");
			$activeSheet->setCellValue('C'.($row_id+4),"No. NPWP Badan Hukum Swasta");
*/

