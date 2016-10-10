<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateSaldoRequest extends Request {

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
            'jenis_laporan' => 'required', 
            'kas_reksus' => 'numeric|required', 
            'kas_bendahara' => 'numeric|required', 
            'kendaraan' => 'numeric|required', 
            'peralatan' => 'numeric|required', 
            'lainnya' => 'numeric|required', 
            'tagihan' => 'numeric|required', 
            'utang' => 'numeric|required', 
            
		];
	}
}
