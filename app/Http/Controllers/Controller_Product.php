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


class Controller_Product extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function fun_view_add_product()
    {
        $data = DB::table(TB_PRODUCT)->orderBy(PRODUCT_INR_ID, ASCENDING)->paginate(50);
        return View('view_add_product')->with(compact('data'));
    }

    public function fun_store_product(Requests\Request_Add_Product $request)
    {
        $return_value =  DB::table(TB_PRODUCT)->insertGetId([
            PRODUCT_NAME => $request->Input(PRODUCT_NAME),
        ]);

        if ($return_value != RECORD_NOT_INSERTED) {
            return Class_Database::return_FM_Success("Particular Inserted Successfully ", 'view_add_product');
        } else {
            return Class_Database::return_FM_Error(" Error in Inserting Particular ", 'view_add_product');
        }
    }

    public static function fun_update_product()
    {
        $product_name  = Input::get(PRODUCT_NAME_MODAL);
        $product_inr_id  = Input::get(PRODUCT_INR_ID_MODAL);
        DB::table(TB_PRODUCT)
            ->where(PRODUCT_INR_ID, $product_inr_id)
            ->update([
                PRODUCT_NAME => $product_name,
            ]);
        return Class_Database::return_FM_Success("Particular Updated Successfully ", 'view_add_product');
    }

    public function fun_delete_product($product_inr_id)
    {
        $return_value   =  DB::table(TB_PRODUCT)
            ->where(PRODUCT_INR_ID, $product_inr_id)
            ->delete();

        if ($return_value == RECORD_DELETED) {
            return Class_Database::return_FM_Success("Particular Deleted Successfully ", 'view_add_product');
        } else {
            return Class_Database::return_FM_Error("Error in Deleting Particular ", 'view_add_product');
        }
    }
}
