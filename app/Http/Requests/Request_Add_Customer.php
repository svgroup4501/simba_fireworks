<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_Customer extends Request
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

    public function rules()
    {
        return
            [
                CUSTOMER_NAME => 'required|max:50|unique:' . TB_CUSTOMER . ',' . CUSTOMER_NAME,
                CUSTOMER_ADDRESS => 'required',

            ];
    }

    public function messages()
    {
        return
            [
                CUSTOMER_NAME . '.required'  => 'Customer Name is Required.',
                CUSTOMER_NAME . '.max'       => 'Customer Name exceeds the maximum length.',
                CUSTOMER_NAME . '.unique'    => 'Customer Name already exists.',

                CUSTOMER_ADDRESS . '.required'  => 'Customer Address is Required.',
            ];
    }
}
