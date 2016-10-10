<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use Session;

use App\Penyumbangindividu;
use App\Penerimaan;

use App\Http\Requests\CreatePenyumbangindividuRequest;
use App\Http\Requests\UpdatePenyumbangindividuRequest;
use Illuminate\Http\Request;



class PenyumbangindividuController extends Controller {

	/**
	 * Display a listing of penyumbangindividu
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penyumbangindividu = Penyumbangindividu::all();

		return view('admin.penyumbangindividu.index', compact('penyumbangindividu'));
	}

	/**
	 * Show the form for creating a new penyumbangindividu
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.penyumbangindividu.create');
	}

	/**
	 * Store a newly created penyumbangindividu in storage.
	 *
     * @param CreatePenyumbangindividuRequest|Request $request
	 */
	public function store(CreatePenyumbangindividuRequest $request)
	{
	    
		Penyumbangindividu::create($request->all());

		return redirect()->route('admin.penyumbangindividu.index');
	}

	/**
	 * Show the form for editing the specified penyumbangindividu.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penyumbangindividu = Penyumbangindividu::find($id);
	    
	    
		return view('admin.penyumbangindividu.edit', compact('penyumbangindividu'));
	}

	/**
	 * Update the specified penyumbangindividu in storage.
     * @param UpdatePenyumbangindividuRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenyumbangindividuRequest $request)
	{
		$penyumbangindividu = Penyumbangindividu::findOrFail($id);

        

		$penyumbangindividu->update($request->all());

		return redirect()->route('admin.penyumbangindividu.index');
	}

	/**
	 * Remove the specified penyumbangindividu from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
        $penerimaan = Penerimaan::where('jnssumberdana_id', '=', '3')->where('penyumbang_id', '=', $id)->get();
		if (!$penerimaan->isEmpty()){
				Session::flash('message', 'Penyumbang: '.Penyumbangindividu::find($id)->nama.'! tidak bisa dihapus karena masih ada penerimaan yang tercatat!'); 
				Session::flash('alert-class', 'alert-danger'); 
		} else {
				Penyumbangindividu::destroy($id);
				//Session::flash('message', ''.Penyumbangindividu::find($id)->nama.'!  dihapus'); 
				//Session::flash('alert-class', 'alert-danger'); 
		}
		return redirect()->route('admin.penyumbangindividu.index');
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
            Penyumbangindividu::destroy($toDelete);
        } else {
            Penyumbangindividu::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penyumbangindividu.index');
    }

}
