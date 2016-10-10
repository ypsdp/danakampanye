<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePenerimaanRequest extends Request {

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
            'nomor' => 'required', 
            'tanggal' => 'required', 
            'jnspenerimaan_id' => 'required', 
            'nilai' => 'numeric|required', 
            'unit' => 'integer', 
            'jnssumberdana_id' => 'required',
		];
	}
}
