<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;

use App\Datapaslon;
use App\Http\Requests\CreateDatapaslonRequest;
use App\Http\Requests\UpdateDatapaslonRequest;
use Illuminate\Http\Request;

use App\Jnspemilihan;
use App\Jnspencalonan;

class DatapaslonController extends Controller {

	/**
	 * Display a listing of datapaslon
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $datapaslon = Datapaslon::with("jnspemilihan")->get();
        $datapaslon = Datapaslon::with("jnspencalonan")->get();
		$periode = DB::table('v_periode')->select('*')->get();

//   var_dump(compact('datapaslon', 'periode'));

		return view('admin.datapaslon.index', compact('datapaslon', 'periode'));
	}

	/**
	 * Show the form for creating a new datapaslon
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $jnspemilihan = Jnspemilihan::lists("keterangan", "id")->prepend('Silahkan pilih', '');
            $jnspencalonan = Jnspencalonan::lists("jenis_pencalonan", "id")->prepend('Silahkan pilih', '');

	    
	    return view('admin.datapaslon.create', compact("jnspemilihan", "jnspencalonan"));
	}

	/**
	 * Store a newly created datapaslon in storage.
	 *
     * @param CreateDatapaslonRequest|Request $request
	 */
	public function store(CreateDatapaslonRequest $request)
	{
	    
		Datapaslon::create($request->all());

		return redirect()->route('admin.datapaslon.index');
	}

	/**
	 * Show the form for editing the specified datapaslon.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$datapaslon = Datapaslon::find($id);
	    $jnspemilihan = Jnspemilihan::lists("keterangan", "id")->prepend('Silahkan pilih', '');
             $jnspencalonan = Jnspencalonan::lists("jenis_pencalonan", "id")->prepend('Silahkan pilih', '');

		return view('admin.datapaslon.edit', compact('datapaslon', "jnspemilihan", "jnspencalonan"));
	}

	/**
	 * Update the specified datapaslon in storage.
     * @param UpdateDatapaslonRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDatapaslonRequest $request)
	{
		$datapaslon = Datapaslon::findOrFail($id);

        

		$datapaslon->update($request->all());

		return redirect()->route('admin.datapaslon.index');
	}

	/**
	 * Remove the specified datapaslon from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Datapaslon::destroy($id);

		return redirect()->route('admin.datapaslon.index');
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
            Datapaslon::destroy($toDelete);
        } else {
            Datapaslon::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.datapaslon.index');
    }

}
