<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_Credit extends Request
{
    public function authorize()
    {
        return SUCCESS;
    }

    public function rules()
    {
        return
            [
                CUSTOMER_INR_ID     => 'required',
                CREDIT_AMOUNT       => 'required',
                CUSTOMER_NAME_MODAL  => 'required',
                DATE_PICKER_MODAL   => 'required',
            ];
    }

    public function messages()
    {
        return
            [
                CUSTOMER_INR_ID . '.required' => 'Customer Name is Required.',
                CREDIT_AMOUNT . '.required'   => 'Amount is Required.',
                COMPANY_NAME . '.required'    => 'Name is Required.',
                DATE_PICKER . '.required'     => 'Date is Required.',
            ];
    }
}
