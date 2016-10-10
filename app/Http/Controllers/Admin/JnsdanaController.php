<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnsdana;
use App\Http\Requests\CreateJnsdanaRequest;
use App\Http\Requests\UpdateJnsdanaRequest;
use Illuminate\Http\Request;



class JnsdanaController extends Controller {

	/**
	 * Display a listing of jnsdana
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnsdana = Jnsdana::all();

		return view('admin.jnsdana.index', compact('jnsdana'));
	}

	/**
	 * Show the form for creating a new jnsdana
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnsdana.create');
	}

	/**
	 * Store a newly created jnsdana in storage.
	 *
     * @param CreateJnsdanaRequest|Request $request
	 */
	public function store(CreateJnsdanaRequest $request)
	{
	    
		Jnsdana::create($request->all());

		return redirect()->route('admin.jnsdana.index');
	}

	/**
	 * Show the form for editing the specified jnsdana.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnsdana = Jnsdana::find($id);
	    
	    
		return view('admin.jnsdana.edit', compact('jnsdana'));
	}

	/**
	 * Update the specified jnsdana in storage.
     * @param UpdateJnsdanaRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnsdanaRequest $request)
	{
		$jnsdana = Jnsdana::findOrFail($id);

        

		$jnsdana->update($request->all());

		return redirect()->route('admin.jnsdana.index');
	}

	/**
	 * Remove the specified jnsdana from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnsdana::destroy($id);

		return redirect()->route('admin.jnsdana.index');
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
            Jnsdana::destroy($toDelete);
        } else {
            Jnsdana::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnsdana.index');
    }

}
