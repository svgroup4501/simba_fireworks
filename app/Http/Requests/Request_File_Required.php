<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_File_Required extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return SUCCESS;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
    public function rules()
    {
        return
            [
                UPLOAD  => 'required',
            ];
    }

    public function messages()
    {
        return
            [
                UPLOAD => ' Upload File is Required'
            ];
    }

}
