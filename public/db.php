<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

ini_set('memory_limit','512M');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Asia/Jakarta');

$alphabet = range('A', 'Z');

function fill_template($template, $arr) {
	$handle = fopen($template, "r");
	$hasilbaca = fread($handle, filesize($template));
	fclose($handle);
	
	foreach ($arr as $var => $val) {
		$hasilbaca = str_replace("<<$var>>", $val, $hasilbaca);
	}	
	return $hasilbaca;
}

function protect_sheet($sheet, $password) {
	$sheet->getProtection()->setSheet(true);
	$sheet->getProtection()->setSort(true);
	$sheet->getProtection()->setInsertRows(true);
	$sheet->getProtection()->setFormatCells(true);
	$sheet->getProtection()->setPassword($password);
}



class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../dana.db');
    }
}

$db = new MyDB();

$result = $db->query('SELECT * FROM datapaslon');
$data = $result->fetchArray();
$arr = $data;
$arr['tempat'] = $data['kedudukan'];
$arr['jenis_pencalonan'] = ($data['jnspencalonan_id'] == '1' ? 'PARTAI POLITIK' : 'PERSEORANGAN' );
$arr['jenis_pilkada'] = ($data['jnspemilihan_id'] == '1' ? 'GUBERNUR' : ($data['jnspemilihan_id'] == '2' ? 'BUPATI' : 'WALIKOTA') );
$arr['tingkat'] = ($data['jnspemilihan_id'] == '1' ? 'PROVINSI' : ($data['jnspemilihan_id'] == '2' ? 'KABUPATEN' : 'KOTA') );

if ( $data['jnspemilihan_id'] == 1) {
	$arr['nama_daerah'] = "PROVINSI " . $data['provinsi'];
} else {
	$arr['nama_daerah'] =  $data['kabupaten_kota'] . " - PROVINSI " . $data['provinsi'];
}

$result = $db->query('SELECT jabatan FROM jnspemilihan a JOIN datapaslon b where a.id = b.jnspemilihan_id ');
$data = $result->fetchArray();
$arr['jenis_pemilihan'] = $data['jabatan'];
$arr['JENIS_PEMILIHAN'] = strtoupper($data['jabatan']);
$arr['jenis_pemilihan_full'] = strtoupper($data['jabatan'] ." dan wakil " . $data['jabatan']);

$result = $db->query('SELECT * FROM penyumbangpaslon WHERE id = 1');
$data = $result->fetchArray();
$arr['nama_kepala'] = $data['nama'];
$arr['alamat_kepala'] = $data['alamat'];
$arr['nik_kepala'] = $data['nik'];
$arr['npwp_kepala'] = $data['npwp'];

$result = $db->query('SELECT * FROM penyumbangpaslon WHERE id = 2');
$data = $result->fetchArray();
$arr['nama_wakil'] = $data['nama'];
$arr['alamat_wakil'] = $data['alamat'];
$arr['nik_wakil'] = $data['nik'];
$arr['npwp_wakil'] = $data['npwp'];

$arr['pasangan_calon'] = $arr['nama_kepala'] . " - ". $arr['nama_wakil'];


$result = $db->query('SELECT * FROM v_periode');
$data = $result->fetchArray();
$arr = array_merge($arr, $data);
$arr['periode_ladk'] = tanggal($data['ladk_mulai']) ." s/d ". tanggal($data['ladk_selesai']);
$arr['periode_lpsdk'] = tanggal($data['lpsdk_mulai']) ." s/d ". tanggal($data['lpsdk_selesai']);
$arr['periode_lppdk'] = tanggal($data['lppdk_mulai']) ." s/d ". tanggal($data['lppdk_selesai']);
$arr['ladk_mulai'] = tanggal($data['ladk_mulai']);
$arr['ladk_selesai'] = tanggal($data['ladk_selesai']);
$arr['lpsdk_mulai'] = tanggal($data['lpsdk_mulai']);
$arr['lpsdk_selesai'] = tanggal($data['lpsdk_selesai']);
$arr['lppdk_mulai'] = tanggal($data['lppdk_mulai']);
$arr['lppdk_selesai'] = tanggal($data['lppdk_selesai']);
$arr['tanggal'] =  tanggal(date("Y-m-d"));
$arr['ttd'] = $arr['tempat'] . ", ". $arr['tanggal'];


if ($arr['jnspencalonan_id'] == 1){   
	$arr['jenis_pencalonan'] = 'parpol';
}else { 
	$arr['jenis_pencalonan'] = 'perseorangan';
}
$arr['JENIS_PENCALONAN'] = strtoupper($arr['jenis_pencalonan']);
 



