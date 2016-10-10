<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnssumberdana;
use App\Http\Requests\CreateJnssumberdanaRequest;
use App\Http\Requests\UpdateJnssumberdanaRequest;
use Illuminate\Http\Request;



class JnssumberdanaController extends Controller {

	/**
	 * Display a listing of jnssumberdana
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnssumberdana = Jnssumberdana::all();

		return view('admin.jnssumberdana.index', compact('jnssumberdana'));
	}

	/**
	 * Show the form for creating a new jnssumberdana
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnssumberdana.create');
	}

	/**
	 * Store a newly created jnssumberdana in storage.
	 *
     * @param CreateJnssumberdanaRequest|Request $request
	 */
	public function store(CreateJnssumberdanaRequest $request)
	{
	    
		Jnssumberdana::create($request->all());

		return redirect()->route('admin.jnssumberdana.index');
	}

	/**
	 * Show the form for editing the specified jnssumberdana.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnssumberdana = Jnssumberdana::find($id);
	    
	    
		return view('admin.jnssumberdana.edit', compact('jnssumberdana'));
	}

	/**
	 * Update the specified jnssumberdana in storage.
     * @param UpdateJnssumberdanaRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnssumberdanaRequest $request)
	{
		$jnssumberdana = Jnssumberdana::findOrFail($id);

        

		$jnssumberdana->update($request->all());

		return redirect()->route('admin.jnssumberdana.index');
	}

	/**
	 * Remove the specified jnssumberdana from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnssumberdana::destroy($id);

		return redirect()->route('admin.jnssumberdana.index');
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
            Jnssumberdana::destroy($toDelete);
        } else {
            Jnssumberdana::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnssumberdana.index');
    }

}
