<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Faq;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;



class FaqController extends Controller {

	/**
	 * Display a listing of faq
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $faq = Faq::all();

		return view('admin.faq.index', compact('faq'));
	}

	/**
	 * Show the form for creating a new faq
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.faq.create');
	}

	/**
	 * Store a newly created faq in storage.
	 *
     * @param CreateFaqRequest|Request $request
	 */
	public function store(CreateFaqRequest $request)
	{
	    
		Faq::create($request->all());

		return redirect()->route('admin.faq.index');
	}

	/**
	 * Show the form for editing the specified faq.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$faq = Faq::find($id);
	    
	    
		return view('admin.faq.edit', compact('faq'));
	}

	/**
	 * Update the specified faq in storage.
     * @param UpdateFaqRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFaqRequest $request)
	{
		$faq = Faq::findOrFail($id);

        

		$faq->update($request->all());

		return redirect()->route('admin.faq.index');
	}

	/**
	 * Remove the specified faq from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Faq::destroy($id);

		return redirect()->route('admin.faq.index');
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
            Faq::destroy($toDelete);
        } else {
            Faq::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.faq.index');
    }

}
