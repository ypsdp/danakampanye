<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePengeluaranRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'tanggal' => 'required', 
            'jnspengeluaran_id' => 'required', 
            'nilai' => 'numeric|required', 
            'unit' => 'integer',             
		];
	}
}
