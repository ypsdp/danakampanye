<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use Session;
use App\Penerimaan;

use App\Penyumbangkelompok;
use App\Http\Requests\CreatePenyumbangkelompokRequest;
use App\Http\Requests\UpdatePenyumbangkelompokRequest;
use Illuminate\Http\Request;



class PenyumbangkelompokController extends Controller {

	/**
	 * Display a listing of penyumbangkelompok
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penyumbangkelompok = Penyumbangkelompok::all();

		return view('admin.penyumbangkelompok.index', compact('penyumbangkelompok'));
	}

	/**
	 * Show the form for creating a new penyumbangkelompok
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.penyumbangkelompok.create');
	}

	/**
	 * Store a newly created penyumbangkelompok in storage.
	 *
     * @param CreatePenyumbangkelompokRequest|Request $request
	 */
	public function store(CreatePenyumbangkelompokRequest $request)
	{
	    
		Penyumbangkelompok::create($request->all());

		return redirect()->route('admin.penyumbangkelompok.index');
	}

	/**
	 * Show the form for editing the specified penyumbangkelompok.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penyumbangkelompok = Penyumbangkelompok::find($id);
	    
	    
		return view('admin.penyumbangkelompok.edit', compact('penyumbangkelompok'));
	}

	/**
	 * Update the specified penyumbangkelompok in storage.
     * @param UpdatePenyumbangkelompokRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenyumbangkelompokRequest $request)
	{
		$penyumbangkelompok = Penyumbangkelompok::findOrFail($id);

        

		$penyumbangkelompok->update($request->all());

		return redirect()->route('admin.penyumbangkelompok.index');
	}

	/**
	 * Remove the specified penyumbangkelompok from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
        $penerimaan = Penerimaan::where('jnssumberdana_id', '=', '4')->where('penyumbang_id', '=', $id)->get();
		if (!$penerimaan->isEmpty()){
				Session::flash('message', 'Penyumbang: '.Penyumbangkelompok::find($id)->nama.'! tidak bisa dihapus karena masih ada penerimaan yang tercatat!'); 
				Session::flash('alert-class', 'alert-danger'); 
		} else {
				Penyumbangkelompok::destroy($id);
				//Session::flash('message', ''.Penyumbangindividu::find($id)->nama.'!  dihapus'); 
				//Session::flash('alert-class', 'alert-danger'); 
		}
		
		

		return redirect()->route('admin.penyumbangkelompok.index');
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
            Penyumbangkelompok::destroy($toDelete);
        } else {
            Penyumbangkelompok::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penyumbangkelompok.index');
    }

}
