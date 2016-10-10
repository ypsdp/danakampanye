<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnspencalonan;
use App\Http\Requests\CreateJnspencalonanRequest;
use App\Http\Requests\UpdateJnspencalonanRequest;
use Illuminate\Http\Request;



class JnspencalonanController extends Controller {

	/**
	 * Display a listing of jenispencalonan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnspencalonan = Jnspencalonan::all();

		return view('admin.jnspencalonan.index', compact('jnspencalonan'));
	}

	/**
	 * Show the form for creating a new jenispencalonan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnspencalonan.create');
	}

	/**
	 * Store a newly created jenispencalonan in storage.
	 *
     * @param CreateJnspencalonanRequest|Request $request
	 */
	public function store(CreateJnspencalonanRequest $request)
	{
	    
		Jnspencalonan::create($request->all());

		return redirect()->route('admin.jnspencalonan.index');
	}

	/**
	 * Show the form for editing the specified jenispencalonan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnspencalonan = Jnspencalonan::find($id);
	    
	    
		return view('admin.jnspencalonan.edit', compact('jnspencalonan'));
	}

	/**
	 * Update the specified jenispencalonan in storage.
     * @param UpdateJnspencalonanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnspencalonanRequest $request)
	{
		$jnspencalonan = Jnspencalonan::findOrFail($id);

        

		$jnspencalonan->update($request->all());

		return redirect()->route('admin.jnspencalonan.index');
	}

	/**
	 * Remove the specified jenispencalonan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnspencalonan::destroy($id);

		return redirect()->route('admin.jnspencalonan.index');
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
            Jnspencalonan::destroy($toDelete);
        } else {
            Jnspencalonan::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnspencalonan.index');
    }

}
