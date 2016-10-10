<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LppdkController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function getIndex()
    {
		return view('admin.lppdk.index');
	}

}