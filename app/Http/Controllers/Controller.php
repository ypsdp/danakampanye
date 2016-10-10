<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileUploadTrait;
}


//TITIP GLOBAL VARIABEL 

use DB;
	$datapaslon = DB::table('datapaslon')->select('*')->get();
	$datapaslon = json_decode(json_encode($datapaslon), True);
	$dataperiode = DB::table('v_periode')->select('*')->get();
	$dataperiode = json_decode(json_encode($dataperiode), True);
	$_ENV['paslon'] = $data = array_merge($dataperiode[0], $datapaslon[0]);
 
	$penerimaan = DB::table('v_penerimaan_lppdk_2')->select('kategori','penyumbang','kali','total')->get();
	$_ENV['penerimaan'] = json_decode(json_encode($penerimaan), True);

	$total_penerimaan = 0;
	foreach ($_ENV['penerimaan'] as $key => $val) {
		$_ENV['penerimaan'][$key]['total'] = number_format($val['total'],0,",",".");
		$total_penerimaan = $total_penerimaan + $val['total'];
   }
	$_ENV['total_penerimaan'] = number_format($total_penerimaan,0,",",".");

	$pengeluaran = DB::table('v_pengeluaran_lppdk_grp')->select('jenis_pengeluaran','kali','total')->get();
	$_ENV['pengeluaran'] = json_decode(json_encode($pengeluaran), True);

	$total_pengeluaran = 0;
	foreach ($_ENV['pengeluaran'] as $key => $val) {
		$_ENV['pengeluaran'][$key]['total'] = number_format($val['total'],0,",","."); 
		$total_pengeluaran = $total_pengeluaran + $val['total'];
		//$_ENV['pengeluaran'][$key]['Kategori'] = $_ENV['pengeluaran'][$key]['jenis_pengeluaran'];
		//unset($_ENV['pengeluaran'][$key]['jenis_pengeluaran']);
    }




	$_ENV['total_pengeluaran'] = number_format($total_pengeluaran,0,",",".");