<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------

include ("../app/Http/helpers.php");

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
$kedudukan = $data['kedudukan'];

$result = $db->query('SELECT jabatan FROM jnspemilihan a JOIN datapaslon b where a.id = b.jnspemilihan_id ');
$data = $result->fetchArray();
$jenis_pemilihan = strtoupper($data['jabatan'] ." dan wakil " . $data['jabatan']);

$result = $db->query('SELECT * FROM penyumbangpaslon WHERE id = 1');
$data = $result->fetchArray();
$namacakada = $data['nama'];

$result = $db->query('SELECT * FROM penyumbangpaslon WHERE id = 2');
$data = $result->fetchArray();
$namacawakada = $data['nama'];

$pasangan_calon = $namacakada . " - ". $namacawakada;

$result_penerimaan = $db->query('SELECT * FROM penerimaan WHERE id = '. $_GET['id']);
$data_penerimaan = $result_penerimaan->fetchArray();
$jumlah_sumbangan = $data_penerimaan['nilai'];
$id_penyumbang = $data_penerimaan['penyumbang_id'];
$asal_perolehan = $data_penerimaan['uraian'];
$nomor = $data_penerimaan['nomor'];

$arr_hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
$hari = $arr_hari[date('w')];;
$tanggal = tanggal(date("Y-m-d"));

switch ($data_penerimaan['jnssumberdana_id']) {
    case "1":
		$jenis_sumbangan = "PASANGAN CALON";
		$template = "template/tt_paslon.rtf";
		$table_name ="penyumbangpaslon";
        break;
    case "2":
		$jenis_sumbangan = "PARTAI POLITIK";
		$template = "template/tt_partai.rtf";
		$table_name ="penyumbangpartai";
        break;
    case "3":
		$jenis_sumbangan = "PIHAK LAIN PERSEORANGAN";
		$template = "template/sp_perseorangan.rtf";
		$table_name ="penyumbangindividu";
        break;
    case "4":
		$jenis_sumbangan = "PIHAK LAIN KELOMPOK";
		$template = "template/sp_kelompok.rtf";
		$table_name ="penyumbangkelompok";
        break;
    default:
		$jenis_sumbangan = "PIHAK LAIN BADAN HUKUM SWASTA";
		$template = "template/sp_swasta.rtf";
		$table_name ="penyumbangswasta";
}

$result_penyumbang = $db->query("SELECT * FROM $table_name WHERE id = $id_penyumbang");
$data_penyumbang = $result_penyumbang->fetchArray();
$handle = fopen($template, "r+");
$hasilbaca = fread($handle, filesize($template));
fclose($handle);

$hasilbaca = str_replace('<<pasangan_calon>>', $pasangan_calon, $hasilbaca);
$hasilbaca = str_replace('<<jenis_pemilihan>>', $jenis_pemilihan, $hasilbaca);
$hasilbaca = str_replace('<<nomor>>', $nomor, $hasilbaca);
$hasilbaca = str_replace('<<hari>>', $hari, $hasilbaca);
$hasilbaca = str_replace('<<jumlah_sumbangan>>', "Rp. " . number_format($jumlah_sumbangan,0,",",".") , $hasilbaca);
$hasilbaca = str_replace('<<asal_perolehan>>', $asal_perolehan, $hasilbaca);
$hasilbaca = str_replace('<<tempat>>', $kedudukan, $hasilbaca);
$hasilbaca = str_replace('<<tanggal>>', $tanggal, $hasilbaca);

foreach ($data_penyumbang as $var => $val) {
	$hasilbaca = str_replace("<<$var>>", $val, $hasilbaca);
}	

if ($data_penerimaan['jnssumberdana_id'] == 1) {
} elseif ($data_penerimaan['jnssumberdana_id'] == 2) { 
} elseif ($data_penerimaan['jnssumberdana_id'] == 3) { 
	$d = new DateTime($data_penyumbang['tgl_lahir']);
	$today   = new DateTime('today');
	$umur = $d->diff($today)->y .' tahun';
	$ttl = trim($data_penyumbang['tempat_lahir']).", ".$d->format('d') . ' '. $arr_bulan[$d->format("n")-1] . ' '. $d->format("Y");
	$hasilbaca = str_replace('<<ttl>>', $ttl, $hasilbaca);
	$hasilbaca = str_replace('<<umur>>', $umur, $hasilbaca);
} elseif ($data_penerimaan['jnssumberdana_id'] == 4) { 
} elseif ($data_penerimaan['jnssumberdana_id'] == 5) { 
}

//header("Content-type: application/vnd.ms-word");
header("Content-type: application/rtf");
header("Content-Disposition: attachment;Filename=surat_peryataan.rtf");
 
echo $hasilbaca;
?>
