<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateJnspengeluaranRequest extends Request {

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
            'jenis_pengeluaran' => 'required|unique:jnspengeluaran,jenis_pengeluaran,'.$this->jnspengeluaran, 
            'kategori_pengeluaran' => 'required', 
            
		];
	}
}
