<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_Purchase extends Request {

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
                CUSTOMER_NAME    => 'required',
                CUSTOMER_ADDRESS => 'required',
             ];
    }

    public function messages()
    {
        return
            [
                CUSTOMER_NAME.'.required'  => 'Customer Name is Required.',
                CUSTOMER_ADDRESS.'.required'  => 'Customer Address is Required.',
            ];
    }

}
