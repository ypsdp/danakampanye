<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use Session;

use App\Penyumbangpartai;
use App\Penerimaan;

use App\Http\Requests\CreatePenyumbangpartaiRequest;
use App\Http\Requests\UpdatePenyumbangpartaiRequest;
use Illuminate\Http\Request;



class PenyumbangpartaiController extends Controller {

	/**
	 * Display a listing of penyumbangpartai
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penyumbangpartai = Penyumbangpartai::all();
	    if ($_ENV['paslon']['jnspencalonan_id'] == 1) {
		return view('admin.penyumbangpartai.index', compact('penyumbangpartai'));
		} else {
	    	return view('admin.dashboard');
		}

	}

	/**
	 * Show the form for creating a new penyumbangpartai
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    if ($_ENV['paslon']['jnspencalonan_id'] == 1) {
	    	return view('admin.penyumbangpartai.create'); 
		} else {
	    	return view('admin.dashboard');
		}
	}

	/**
	 * Store a newly created penyumbangpartai in storage.
	 *
     * @param CreatePenyumbangpartaiRequest|Request $request
	 */
	public function store(CreatePenyumbangpartaiRequest $request)
	{
	    
		Penyumbangpartai::create($request->all());

		return redirect()->route('admin.penyumbangpartai.index');
	}

	/**
	 * Show the form for editing the specified penyumbangpartai.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penyumbangpartai = Penyumbangpartai::find($id);
	    
	    
		return view('admin.penyumbangpartai.edit', compact('penyumbangpartai'));
	}

	/**
	 * Update the specified penyumbangpartai in storage.
     * @param UpdatePenyumbangpartaiRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenyumbangpartaiRequest $request)
	{
		$penyumbangpartai = Penyumbangpartai::findOrFail($id);

        

		$penyumbangpartai->update($request->all());

		return redirect()->route('admin.penyumbangpartai.index');
	}

	/**
	 * Remove the specified penyumbangpartai from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		
        $penerimaan = Penerimaan::where('jnssumberdana_id', '=', '2')->where('penyumbang_id', '=', $id)->get();
		if (!$penerimaan->isEmpty()){
				Session::flash('message', 'Penyumbang: '.Penyumbangpartai::find($id)->nama.'! tidak bisa dihapus karena masih ada penerimaan yang tercatat!'); 
				Session::flash('alert-class', 'alert-danger'); 
		} else {
				Penyumbangpartai::destroy($id);
				//Session::flash('message', ''.Penyumbangindividu::find($id)->nama.'!  dihapus'); 
				//Session::flash('alert-class', 'alert-danger'); 
		}
		
		

		return redirect()->route('admin.penyumbangpartai.index');
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
            Penyumbangpartai::destroy($toDelete);
        } else {
            Penyumbangpartai::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penyumbangpartai.index');
    }

}
