<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;
use App\Classes\Class_Database;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Codedge\Fpdf\Fpdf\Fpdf;
use Exception;
use str;
use Illuminate\Http\Request;

class Controller_Particular extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_add_particular()
    {
        $customer_inr_id = Input::get("customer_inr_id");
        if ($customer_inr_id) {
            if (DB::table(TB_CUSTOMER)->count() != ZERO) {
                $account_collection = DB::table(TB_ACCOUNT)
                    ->where(CUSTOMER_INR_ID, $customer_inr_id)
                    ->orderBy(CREADTED_AT, ASCENDING)->get();
                $product_collection = DB::table(TB_PRODUCT)
                    ->orderBy(PRODUCT_INR_ID, ASCENDING)->get();
                $company_collection = DB::table(TB_COMPANY)
                    ->orderBy(COMPANY_INR_ID, ASCENDING)->get();
                $corresponding_particular_collection = DB::table(TB_PARTICULAR)->where(CUSTOMER_INR_ID, $customer_inr_id)->orderBy(CREADTED_AT, ASCENDING)->get();
                $particular_collection  = array(
                    CUSTOMER_INR_ID    =>  $customer_inr_id,
                    ARRAY_ACCOUNT      =>  $account_collection,
                    ARRAY_PRODUCT      =>  $product_collection,
                    ARRAY_COMPANY      =>  $company_collection,
                    ARRAY_PARTICULAR   =>  $corresponding_particular_collection,
                );
                return View('view_add_particular')->with($particular_collection);
            } else {
                Class_Database::return_FM_Warning(" No Records In Customer Table ", '/');
            }
        }
    }

    public function fun_view_add_particular_with_parameter($customer_inr_id)
    {
        if ($customer_inr_id) {
            if (DB::table(TB_CUSTOMER)->count() != ZERO) {
                $account_collection = DB::table(TB_ACCOUNT)
                    ->where(CUSTOMER_INR_ID, $customer_inr_id)
                    ->orderBy(CREADTED_AT, ASCENDING)->get();
                $product_collection = DB::table(TB_PRODUCT)
                    ->orderBy(PRODUCT_INR_ID, ASCENDING)->get();
                $company_collection = DB::table(TB_COMPANY)
                    ->orderBy(COMPANY_INR_ID, ASCENDING)->get();
                $corresponding_particular_collection = DB::table(TB_PARTICULAR)->where(CUSTOMER_INR_ID, $customer_inr_id)->orderBy(CREADTED_AT, ASCENDING)->get();
                $particular_collection  = array(
                    CUSTOMER_INR_ID    =>  $customer_inr_id,
                    ARRAY_ACCOUNT      =>  $account_collection,
                    ARRAY_PRODUCT      =>  $product_collection,
                    ARRAY_COMPANY      =>  $company_collection,
                    ARRAY_PARTICULAR   =>  $corresponding_particular_collection,
                );
                return View('view_add_particular')->with($particular_collection);
            } else {
                Class_Database::return_FM_Warning(" No Records In Customer Table ", '/');
            }
        }
    }

    public function fun_store_particular()
    {
        $case_count                  = 0;
        $purchased_product_name      = Input::get("purchased_product_name");
        $purchased_product_quantity  = Input::get("purchased_product_quantity");
        $purchased_product_rate      = Input::get("purchased_product_rate");
        $purchased_product_pkt       = Input::get("purchased_product_pkt");
        $purchased_product_amount    = Input::get("purchased_product_amount");

        $bill_number                 = Input::get("bill_number");
        $customer_inr_id             = Input::get("customer_inr_id");
        $customer_name               = Input::get("customer_name");
        $company_inr_id              = Input::get("selected_company_inr_id");
        $discount_in_percentage      = Input::get("discount_in_percentage");
        $discount_in_amount          = Input::get("discount_amount");
        $tax_amount                  = Input::get("tax_amount");
        $packing_percentage          = Input::get("packing_percentage");
        $packing_amount              = Input::get("packing_amount");
        $particular_amount           = Input::get("particular_amount");
        $total_amount                = Input::get("total_amount");
        $transport_name              = Input::get("transport_name");
        $date_picker                = Input::get("date_picker");

        $company_name = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->value(COMPANY_NAME);

        $particular_inr_id = DB::table(TB_PARTICULAR)->insertGetId([
            BILL_NUMBER       => $bill_number,
            CUSTOMER_INR_ID   => $customer_inr_id,
            CUSTOMER_NAME     => $customer_name,
            COMPANY_INR_ID    => $company_inr_id,
            COMPANY_NAME      => $company_name,
            PARTICULAR_AMOUNT => number_format($particular_amount, 2, '.', ''),
            PARTICULAR_COUNT  => count($purchased_product_name),
            TAX_AMOUNT        => number_format($tax_amount, 2, '.', ''),
            PACKING_PERCENTAGE => $packing_percentage != "" ? $packing_percentage : '0',
            PACKING_AMOUNT    => $packing_amount != "" ? $packing_amount : '0',
            DISCOUNT_IN_PERCENTAGE    => $discount_in_percentage != "" ? $discount_in_percentage : '0',
            DISCOUNT_AMOUNT  => $discount_in_amount,
            TRANSPORT_NAME  => $transport_name,
            AMOUNT            => number_format($total_amount, 2, '.', ''),
            CREADTED_AT       => $date_picker,
            CASE_COUNT        => "0"
        ]);

        for ($iLoop = 0; $iLoop < count($purchased_product_name); $iLoop++) {
            $product_name     = $purchased_product_name[$iLoop];
            $purchased_quantity  = $purchased_product_quantity[$iLoop];
            $purchased_rate  = $purchased_product_rate[$iLoop];
            $purchased_pkt  = $purchased_product_pkt[$iLoop];
            $purchased_amount = $purchased_product_amount[$iLoop];
            $case_count = $purchased_quantity + $case_count;

            DB::table(TB_PARTICULAR_DETAIL)->insertGetId([
                PARTICULAR_INR_ID  => $particular_inr_id,
                PRODUCT_NAME       => $product_name,
                QUANTITY           => $purchased_quantity,
                RATE               => number_format($purchased_rate, 2, '.', ''),
                PKT                => $purchased_pkt,
                AMOUNT             => number_format($purchased_amount, 2, '.', ''),
            ]);
        }

        DB::table(TB_PARTICULAR)->where(PARTICULAR_INR_ID, $particular_inr_id)->update([CASE_COUNT => $case_count]);

        DB::table(TB_ACCOUNT)->insertGetId([
            PARTICULAR_INR_ID => $particular_inr_id,
            CUSTOMER_INR_ID   => $customer_inr_id,
            CUSTOMER_NAME     => $customer_name,
            COMPANY_INR_ID    => $company_inr_id,
            COMPANY_NAME      => $company_name,
            DEBIt_AMOUNT      => number_format($total_amount, 2, '.', ''),
            CREADTED_AT       => $date_picker,
        ]);

        return Class_Database::return_FM_Success_Route("Particular Inserted Successfully ", 'tag_view_add_particular_with_parameter', $customer_inr_id);
    }

    public function fun_update_particular()
    {
        $case_count                  = 0;
        $particular_inr_id           = Input::get("particular_inr_id");
        $purchased_product_name      = Input::get("purchased_product_name");
        $purchased_product_quantity  = Input::get("purchased_product_quantity");
        $purchased_product_rate      = Input::get("purchased_product_rate");
        $purchased_product_pkt       = Input::get("purchased_product_pkt");
        $purchased_product_amount    = Input::get("purchased_product_amount");

        $bill_number                 = Input::get("bill_number");
        $customer_inr_id             = Input::get("customer_inr_id");
        $customer_name               = Input::get("customer_name");
        $company_inr_id              = Input::get("selected_company_inr_id");
        $discount_in_percentage      = Input::get("discount_in_percentage");
        $discount_in_amount          = Input::get("discount_amount");
        $tax_amount                  = Input::get("tax_amount");
        $packing_percentage          = Input::get("packing_percentage");
        $packing_amount              = Input::get("packing_amount");
        $particular_amount           = Input::get("particular_amount");
        $total_amount                = Input::get("total_amount");
        $transport_name              = Input::get("transport_name");
        $date_picker                = Input::get("date_picker");

        $company_name = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->value(COMPANY_NAME);

        DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->update([

                BILL_NUMBER       => $bill_number,
                CUSTOMER_INR_ID   => $customer_inr_id,
                CUSTOMER_NAME     => $customer_name,
                COMPANY_INR_ID    => $company_inr_id,
                COMPANY_NAME      => $company_name,
                PARTICULAR_AMOUNT => number_format($particular_amount, 2, '.', ''),
                PARTICULAR_COUNT  => count($purchased_product_name),
                PACKING_PERCENTAGE => $packing_percentage != "" ? $packing_percentage : '0',
                TAX_AMOUNT        => number_format($tax_amount, 2, '.', ''),
                PACKING_AMOUNT    => $packing_amount != "" ? $packing_amount : '0',
                DISCOUNT_IN_PERCENTAGE    => $discount_in_percentage != "" ? $discount_in_percentage : '0',
                DISCOUNT_AMOUNT  => $discount_in_amount,
                TRANSPORT_NAME  => $transport_name,
                AMOUNT            => number_format($total_amount, 2, '.', ''),
                CREADTED_AT       => $date_picker,
            ]);


        DB::table(TB_PARTICULAR_DETAIL)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->delete();


        for ($iLoop = 0; $iLoop < count($purchased_product_name); $iLoop++) {
            $product_name     = $purchased_product_name[$iLoop];
            $purchased_quantity  = $purchased_product_quantity[$iLoop];
            $purchased_rate  = $purchased_product_rate[$iLoop];
            $purchased_pkt  = $purchased_product_pkt[$iLoop];
            $purchased_amount = $purchased_product_amount[$iLoop];
            $case_count = $purchased_quantity + $case_count;

            DB::table(TB_PARTICULAR_DETAIL)->insertGetId([
                PARTICULAR_INR_ID  => $particular_inr_id,
                PRODUCT_NAME       => $product_name,
                QUANTITY           => $purchased_quantity,
                RATE               => number_format($purchased_rate, 2, '.', ''),
                PKT                => $purchased_pkt,
                AMOUNT             => number_format($purchased_amount, 2, '.', ''),
            ]);
        }

        DB::table(TB_PARTICULAR)->where(PARTICULAR_INR_ID, $particular_inr_id)->update([CASE_COUNT => $case_count]);

        DB::table(TB_ACCOUNT)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->update([
                CUSTOMER_INR_ID   => $customer_inr_id,
                CUSTOMER_NAME     => $customer_name,
                COMPANY_INR_ID    => $company_inr_id,
                COMPANY_NAME      => $company_name,
                DEBIt_AMOUNT      => number_format($total_amount, 2, '.', ''),
                CREADTED_AT       => $date_picker,
            ]);

        return Class_Database::return_FM_Success_Route("Particular Updated Successfully ", 'tag_view_add_particular_with_parameter', $customer_inr_id);
    }

    public function fun_view_all_particular()
    {
        $array_collection  =  DB::table(TB_PARTICULAR)->select(PARTICULAR_INR_ID)->get();
        if (count($array_collection) != ZERO) {
            $data = DB::table(TB_PARTICULAR)->orderBy(PARTICULAR_INR_ID, DESCENDING)->paginate(50);
            return View('view_all_particular')->with(compact('data'));
        } else {
            Class_Database::return_FM_Warning(" No Records In Particular Table ", '/');
        }
    }

    public function fun_view_single_particular($particular_inr_id)
    {
        $particular_customer_collection   =  DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();
        $particular_product_collection   =  DB::table(TB_PARTICULAR_DETAIL)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();

        $particular_collection  = array(
            ARRAY_CUSTOMER    =>  $particular_customer_collection,
            ARRAY_PARTICULAR  =>  $particular_product_collection
        );
        return View('view_single_particular')->with($particular_collection);
    }

    public function fun_delete_particular($particular_inr_id)
    {
        $customer_inr_id = DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->value(CUSTOMER_INR_ID);
        DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->delete();
        DB::table(TB_PARTICULAR_DETAIL)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->delete();
        DB::table(TB_ACCOUNT)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->delete();
        return Class_Database::return_FM_Success_Route("Particular Deleted Successfully ", 'tag_view_add_particular_with_parameter', $customer_inr_id);
    }

    public function fun_view_update_particular($particular_inr_id)
    {
        $particular_customer_collection   =  DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();
        $particular_product_collection   =  DB::table(TB_PARTICULAR_DETAIL)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();

        $company_collection = DB::table(TB_COMPANY)
            ->orderBy(COMPANY_INR_ID, ASCENDING)->get();

        $product_collection = DB::table(TB_PRODUCT)
            ->orderBy(PRODUCT_INR_ID, ASCENDING)->get();

        $particular_collection  = array(
            ARRAY_CUSTOMER     =>  $particular_customer_collection,
            ARRAY_PARTICULAR   =>  $particular_product_collection,
            ARRAY_PRODUCT      =>  $product_collection,
            ARRAY_COMPANY      =>  $company_collection,
        );
        return View('view_update_particular')->with($particular_collection);
    }

    public function fun_upload_receipt(Request $request)
    {
        try {
            $this->validate($request, [
                'receipt' => 'required',
                'bill_number' => 'required',
            ]);

            $bill_number = Input::get("bill_number");
            $customer_inr_id = Input::get("customer_inr_id");
            $particular_inr_id = Input::get("particular_inr_id");


            if ($request->hasFile('receipt')) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $fileToBeUpload = $request->file('receipt');
                $extension = $fileToBeUpload->getClientOriginalExtension();
                $fileNameToBeUsed = $bill_number . '.' . $extension;
                $isFileHaveCorrectExtension = in_array($extension, $allowedfileExtension);
                if ($isFileHaveCorrectExtension) {
                    $image_resize = Image::make($fileToBeUpload->getRealPath());
                    $image_resize->resize(350, 350);
                    $filePath = storage_path() . "/app/receipt/" . $fileNameToBeUsed;
                    $image_resize->save($filePath);

                    //$fileToBeUpload->storeAs('receipt', $fileNameToBeUsed);
                    DB::table(TB_PARTICULAR)->where(PARTICULAR_INR_ID, $particular_inr_id)->update([BILL_NAME => $fileNameToBeUsed]);
                    return Class_Database::return_FM_Success_Route("Receipt Uploaded Successfully", 'tag_view_add_particular_with_parameter', $customer_inr_id);
                } else {
                    return Class_Database::return_FM_Error_Route("Sorry Only Upload png,jpg,jpeg", 'tag_view_add_particular_with_parameter', $customer_inr_id);
                }
            }
        } catch (\Exception $e) {
            return Class_Database::return_FM_Error_Route($e->getMessage(), 'tag_view_add_particular_with_parameter', $customer_inr_id);
        }
    }
}
