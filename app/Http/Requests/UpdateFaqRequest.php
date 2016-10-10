<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateFaqRequest extends Request {

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
            'kategori' => 'required', 
            'pertanyaan' => 'required', 
            'jawaban' => 'required', 
            
		];
	}
}
