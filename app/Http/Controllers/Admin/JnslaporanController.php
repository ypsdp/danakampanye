<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnslaporan;
use App\Http\Requests\CreateJnslaporanRequest;
use App\Http\Requests\UpdateJnslaporanRequest;
use Illuminate\Http\Request;



class JnslaporanController extends Controller {

	/**
	 * Display a listing of jnslaporan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnslaporan = Jnslaporan::all();

		return view('admin.jnslaporan.index', compact('jnslaporan'));
	}

	/**
	 * Show the form for creating a new jnslaporan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnslaporan.create');
	}

	/**
	 * Store a newly created jnslaporan in storage.
	 *
     * @param CreateJnslaporanRequest|Request $request
	 */
	public function store(CreateJnslaporanRequest $request)
	{
	    
		Jnslaporan::create($request->all());

		return redirect()->route('admin.jnslaporan.index');
	}

	/**
	 * Show the form for editing the specified jnslaporan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnslaporan = Jnslaporan::find($id);
	    
	    
		return view('admin.jnslaporan.edit', compact('jnslaporan'));
	}

	/**
	 * Update the specified jnslaporan in storage.
     * @param UpdateJnslaporanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnslaporanRequest $request)
	{
		$jnslaporan = Jnslaporan::findOrFail($id);

        

		$jnslaporan->update($request->all());

		return redirect()->route('admin.jnslaporan.index');
	}

	/**
	 * Remove the specified jnslaporan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnslaporan::destroy($id);

		return redirect()->route('admin.jnslaporan.index');
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
            Jnslaporan::destroy($toDelete);
        } else {
            Jnslaporan::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnslaporan.index');
    }

}
