<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use Session;
use App\Penerimaan;

use App\Penyumbangswasta;
use App\Http\Requests\CreatePenyumbangswastaRequest;
use App\Http\Requests\UpdatePenyumbangswastaRequest;
use Illuminate\Http\Request;



class PenyumbangswastaController extends Controller {

	/**
	 * Display a listing of penyumbangswasta
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penyumbangswasta = Penyumbangswasta::all();

		return view('admin.penyumbangswasta.index', compact('penyumbangswasta'));
	}

	/**
	 * Show the form for creating a new penyumbangswasta
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.penyumbangswasta.create');
	}

	/**
	 * Store a newly created penyumbangswasta in storage.
	 *
     * @param CreatePenyumbangswastaRequest|Request $request
	 */
	public function store(CreatePenyumbangswastaRequest $request)
	{
	    
		Penyumbangswasta::create($request->all());

		return redirect()->route('admin.penyumbangswasta.index');
	}

	/**
	 * Show the form for editing the specified penyumbangswasta.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penyumbangswasta = Penyumbangswasta::find($id);
	    
	    
		return view('admin.penyumbangswasta.edit', compact('penyumbangswasta'));
	}

	/**
	 * Update the specified penyumbangswasta in storage.
     * @param UpdatePenyumbangswastaRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenyumbangswastaRequest $request)
	{
		$penyumbangswasta = Penyumbangswasta::findOrFail($id);

        

		$penyumbangswasta->update($request->all());

		return redirect()->route('admin.penyumbangswasta.index');
	}

	/**
	 * Remove the specified penyumbangswasta from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
        $penerimaan = Penerimaan::where('jnssumberdana_id', '=', '5')->where('penyumbang_id', '=', $id)->get();
		if (!$penerimaan->isEmpty()){
				Session::flash('message', 'Penyumbang: '.Penyumbangswasta::find($id)->nama.'! tidak bisa dihapus karena masih ada penerimaan yang tercatat!'); 
				Session::flash('alert-class', 'alert-danger'); 
		} else {
				Penyumbangswasta::destroy($id);
				//Session::flash('message', ''.Penyumbangindividu::find($id)->nama.'!  dihapus'); 
				//Session::flash('alert-class', 'alert-danger'); 
		}
				

		return redirect()->route('admin.penyumbangswasta.index');
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
            Penyumbangswasta::destroy($toDelete);
        } else {
            Penyumbangswasta::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penyumbangswasta.index');
    }

}
