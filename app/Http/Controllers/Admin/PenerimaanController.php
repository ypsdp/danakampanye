<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Penerimaan;
use App\Http\Requests\CreatePenerimaanRequest;
use App\Http\Requests\UpdatePenerimaanRequest;
use Illuminate\Http\Request;

use App\Jnspenerimaan;
use App\Jnssumberdana;

use App\Penyumbangindividu;
use App\Penyumbangkelompok;
use App\Penyumbangpartai;
use App\Penyumbangpaslon;
use App\Penyumbangswasta;


class PenerimaanController extends Controller {

	/**
	 * Display a listing of penerimaandana
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penerimaan = Penerimaan::with("jnspenerimaan")->with("jnssumberdana")->get();
        
		return view('admin.penerimaan.index', compact('penerimaan'));
	}

	/**
	 * Show the form for creating a new penerimaan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{	
	    $jnspenerimaan = Jnspenerimaan::get()->lists("kategori", "id")->prepend('Please select', '');
        $jnssumberdana = Jnssumberdana::lists("sumber_dana", "id")->prepend('Please select', '');
        
	    $lstindividu = Penyumbangindividu::lists("nama", "id");
	    $lstkelompok = Penyumbangkelompok::lists("nama", "id");
	    $lstswasta = Penyumbangswasta::lists("nama", "id");
	    $lstpartai = Penyumbangpartai::lists("nama", "id");
	    $lstpaslon = Penyumbangpaslon::lists("nama", "id");

	    return view('admin.penerimaan.create', compact("jnspenerimaan", "jnssumberdana","lstindividu","lstswasta","lstkelompok","lstpartai","lstpaslon"));
	}

	/**
	 * Store a newly created penerimaan in storage.
	 *
     * @param CreatePenerimaanRequest|Request $request
	 */
	public function store(CreatePenerimaanRequest $request)
	{
	    
        $values = $request->all();
        $values['penyumbang_id'] = $values["penyumbang_".$values['jnssumberdana_id']];
		//$penerimaan->update($request->all());
		//Penerimaan::create($request->all());
		Penerimaan::create($values);
	    

		return redirect()->route('admin.penerimaan.index');
	}

	/**
	 * Show the form for editing the specified penerimaan.
	 *
	 * @param  int  $id
 ->    * @ \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penerimaan = Penerimaan::find($id);
	    $jnspenerimaan = Jnspenerimaan::get()->lists("kategori", "id")->prepend('Please select', '');
        $jnssumberdana = Jnssumberdana::lists("sumber_dana", "id")->prepend('Please select', '');
	    $lstindividu = Penyumbangindividu::lists("nama", "id");
	    $lstkelompok = Penyumbangkelompok::lists("nama", "id");
	    $lstswasta = Penyumbangswasta::lists("nama", "id");
	    $lstpartai = Penyumbangpartai::lists("nama", "id");
	    $lstpaslon = Penyumbangpaslon::lists("nama", "id");

		return view('admin.penerimaan.edit', compact('penerimaan', "jnspenerimaan", "jnssumberdana","lstindividu","lstswasta","lstkelompok","lstpartai","lstpaslon"));
	}

	/**
	 * Update the specified penerimaan in storage.
     * @param UpdatePenerimaanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenerimaanRequest $request)
	{
		$penerimaan = Penerimaan::findOrFail($id);
        $values = $request->all();
        $values['penyumbang_id'] = $values["penyumbang_".$values['jnssumberdana_id']];
		//$penerimaan->update($request->all());
		$penerimaan->update($values);

		return redirect()->route('admin.penerimaan.index');
	}

	/**
	 * Remove the specified penerimaan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Penerimaan::destroy($id);

		return redirect()->route('admin.penerimaan.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Penerimaan::destroy($toDelete);
        } else {
            Penerimaan::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penerimaan.index');
    }

}
