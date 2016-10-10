<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnspenerimaan;
use App\Http\Requests\CreateJnspenerimaanRequest;
use App\Http\Requests\UpdateJnspenerimaanRequest;
use Illuminate\Http\Request;



class JnspenerimaanController extends Controller {

	/**
	 * Display a listing of jnspenerimaan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnspenerimaan = Jnspenerimaan::all();

		return view('admin.jnspenerimaan.index', compact('jnspenerimaan'));
	}

	/**
	 * Show the form for creating a new jnspenerimaan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnspenerimaan.create');
	}

	/**
	 * Store a newly created jnspenerimaan in storage.
	 *
     * @param CreateJnspenerimaanRequest|Request $request
	 */
	public function store(CreateJnspenerimaanRequest $request)
	{
	    
		Jnspenerimaan::create($request->all());

		return redirect()->route('admin.jnspenerimaan.index');
	}

	/**
	 * Show the form for editing the specified jnspenerimaan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnspenerimaan = Jnspenerimaan::find($id);
	    
	    
		return view('admin.jnspenerimaan.edit', compact('jnspenerimaan'));
	}

	/**
	 * Update the specified jnspenerimaan in storage.
     * @param UpdateJnspenerimaanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnspenerimaanRequest $request)
	{
		$jnspenerimaan = Jnspenerimaan::findOrFail($id);

        

		$jnspenerimaan->update($request->all());

		return redirect()->route('admin.jnspenerimaan.index');
	}

	/**
	 * Remove the specified jnspenerimaan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnspenerimaan::destroy($id);

		return redirect()->route('admin.jnspenerimaan.index');
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
            Jnspenerimaan::destroy($toDelete);
        } else {
            Jnspenerimaan::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnspenerimaan.index');
    }

}
