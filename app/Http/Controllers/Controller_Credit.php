<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Classes\Class_Database;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\IOFactory;
use PDF;


class Controller_Credit extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_add_credit()
    {
        $array_collection  =  DB::table(TB_CUSTOMER)->select(CUSTOMER_INR_ID)->get();
        if (count($array_collection) != ZERO) {
            $customer_collection = DB::table(TB_CUSTOMER)->orderBy(CUSTOMER_INR_ID, ASCENDING)->get();
            return View('view_add_credit')->with(ARRAY_CUSTOMER, $customer_collection);
        } else {
            Class_Database::return_FM_Warning(" No Records In Customer Table ", '/');
        }
    }

    public function fun_store_credit(Requests\Request_Add_Credit $request)
    {
        $customer_inr_id = $request->Input(CUSTOMER_INR_ID);
        $customer_name = $request->Input(CUSTOMER_NAME_MODAL);
        $amount = $request->Input(CREDIT_AMOUNT);
        $date_picker = $request->Input(DATE_PICKER_MODAL);

        $company_inr_id = $request->Input("selected_modal_company_inr_id");
        $company_name = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->value(COMPANY_NAME);

        $return_value = DB::table(TB_ACCOUNT)->insertGetId([
            CUSTOMER_INR_ID   => $customer_inr_id,
            CUSTOMER_NAME     => $customer_name,
            COMPANY_INR_ID    => $company_inr_id,
            COMPANY_NAME      => $company_name,
            CREDIT_AMOUNT     => number_format($amount, 2, '.', ''),
            CREADTED_AT       => $date_picker,
        ]);

        if ($return_value != RECORD_NOT_INSERTED) {
            return Class_Database::return_FM_Success_Route("Credit Inserted Successfully", 'tag_view_add_particular_with_parameter', $customer_inr_id);
        } else {
            return Class_Database::return_FM_Success_Route("Error in Inserting Credit", 'tag_view_add_particular_with_parameter', $customer_inr_id);
        }
    }

    public function fun_delete_credit($credit_inr_id)
    {
        $customer_inr_id = DB::table(TB_ACCOUNT)
            ->where(ACCOUNT_INR_ID, $credit_inr_id)
            ->value(CUSTOMER_INR_ID);

        $return_value   =  DB::table(TB_ACCOUNT)
            ->where(ACCOUNT_INR_ID, $credit_inr_id)
            ->delete();

        return Class_Database::return_FM_Success_Route("Credit Deleted Successfully ", 'tag_view_add_particular_with_parameter', $customer_inr_id);
    }
}
