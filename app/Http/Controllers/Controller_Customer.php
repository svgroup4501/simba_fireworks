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

class Controller_Customer extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_add_customer()
    {
        $data = DB::table(TB_CUSTOMER)->orderBy(CUSTOMER_INR_ID, ASCENDING)->paginate(50);
        return View('view_add_customer')->with(compact('data'));
    }

    public function fun_store_customer(Requests\Request_Add_Customer $request)
    {
        $mobile = $request->Input(MOBILE) != "" ? $request->Input(MOBILE) : "";
        $return_value =  DB::table(TB_CUSTOMER)->insertGetId([
            CUSTOMER_NAME => $request->Input(CUSTOMER_NAME),
            CUSTOMER_ADDRESS => $request->Input(CUSTOMER_ADDRESS),
            MOBILE => $mobile,
            CUSTOMER_GST => $request->Input(CUSTOMER_GST),
        ]);

        if ($return_value != RECORD_NOT_INSERTED) {
            return Class_Database::return_FM_Success("Customer Inserted Successfully ", 'view_add_customer');
        } else {
            return Class_Database::return_FM_Error(" Error in Inserting Customer ", 'view_add_customer');
        }
    }

    public function fun_view_all_customer()
    {
        $array_collection  =  DB::table(TB_CUSTOMER)->select(CUSTOMER_INR_ID)->get();
        if (count($array_collection) != ZERO) {
            $data = DB::table(TB_CUSTOMER)->orderBy(CUSTOMER_INR_ID, ASCENDING)->paginate(50);
            return View('view_all_customer')->with(compact('data'));
        } else {
            Class_Database::return_FM_Warning(" No Records In Customer Table ", '/');
        }
    }

    public function fun_view_update_customer($customer_inr_id)
    {
        $customer_collection = DB::table(TB_CUSTOMER)->where(CUSTOMER_INR_ID, '=', $customer_inr_id)->get();
        return View('view_update_customer')->with(ARRAY_CUSTOMER, $customer_collection);
    }

    public static function fun_update_customer(Requests\Request_Update_Customer $request, $customer_inr_id)
    {
        $mobile = $request->Input(MOBILE) != "" ? $request->Input(MOBILE) : "";

        DB::table(TB_CUSTOMER)
            ->where(CUSTOMER_INR_ID, $customer_inr_id)
            ->update([
                CUSTOMER_NAME => $request->Input(CUSTOMER_NAME),
                CUSTOMER_ADDRESS => $request->Input(CUSTOMER_ADDRESS),
                MOBILE => $mobile,
                CUSTOMER_GST => $request->Input(CUSTOMER_GST),
            ]);
        DB::table(TB_PARTICULAR)
            ->where(CUSTOMER_INR_ID, $customer_inr_id)
            ->update([
                CUSTOMER_NAME => $request->Input(CUSTOMER_NAME),
            ]);
        DB::table(TB_ACCOUNT)
            ->where(CUSTOMER_INR_ID, $customer_inr_id)
            ->update([
                CUSTOMER_NAME => $request->Input(CUSTOMER_NAME),
            ]);

        return Class_Database::return_FM_Success("Customer Updated Successfully ", 'view_add_customer');
    }

    public function fun_delete_customer($customer_inr_id)
    {
        $return_value   =  DB::table(TB_CUSTOMER)
            ->where(CUSTOMER_INR_ID, $customer_inr_id)
            ->delete();

        if ($return_value == RECORD_DELETED) {
            return Class_Database::return_FM_Success("Customer Deleted Successfully ", 'view_add_customer');
        } else {
            return Class_Database::return_FM_Error("Customer Deleted Successfully ", 'view_add_customer');
        }
    }
}
