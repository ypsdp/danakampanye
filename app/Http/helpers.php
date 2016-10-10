<?php
function str_spacecase($slug)
{

    return str_replace("_", " ", $slug);

}

function getappversion()
{
	return("v 0.1.0");
}

function tanggal($date)
{
	$arrBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", 
	                  "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);

	return( (int)$tgl . " " . $arrBulan[(int)$bulan-1] . " ". $tahun);
}

function umur($date)
{

	$d = new DateTime($date);
	$today   = new DateTime('today');
	$umur = $d->diff($today)->y;
	return $umur;
}

function hari($date)
{
	$arr_hari = array('Minggu', 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	$hari = $arr_hari[date('w', strtotime($date))];
	return $hari;
}

function toNum($data) {
    $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );
    $alpha_flip = array_flip($alphabet);
    $return_value = -1;
    $length = strlen($data);
    for ($i = 0; $i < $length; $i++) {
        $return_value +=
            ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
    }
    return $return_value;
}


function toAlpha($data){
    $alphabet =   array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    $alpha_flip = array_flip($alphabet);
        if($data <= 25){
          return $alphabet[$data];
        }
        elseif($data > 25){
          $dividend = ($data + 1);
          $alpha = '';
          $modulo;
          while ($dividend > 0){
            $modulo = ($dividend - 1) % 26;
            $alpha = $alphabet[$modulo] . $alpha;
            $dividend = floor((($dividend - $modulo) / 26));
          } 
          return $alpha;
        }

}

function array_to_html($data) {
    $report = "";

    if (count($data) > 0) {

        $report .= "<table class ='table table-striped table-hover table-responsive' width='100%'>";
        $report .= sprintf("<tr><td align='right'><b>%s</b></th></tr>", join("</td><td align='right'><b>", array_keys($data[0])));

        foreach ($data as $row) {

            $report .= "<tr>";

            foreach ($row as $column) {
                $report .= "<td align='right'>$column</td>";
            }
            $report .= "</tr>";
        }
        $report .= "</table>";
    } else {
        $report = "<div>Belum ada data</div><br>";
    }

    return $report;
}


