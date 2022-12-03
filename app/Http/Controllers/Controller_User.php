<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use App\Classes\Class_Database;
use DB;
use Illuminate\Support\Facades\Input;


class Controller_User extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_add_user()
    {
        return View( 'view_add_user' );
    }

    public function fun_store_user(Requests\Request_Add_User $request)
    {
        $return_value  =  DB::table( TB_USER )->insertGetId
        ( [
            USERNAME => $request->Input( USERNAME ),
            EMAIL => $request->Input( USERNAME ),
            PASSWORD => bcrypt($request->Input( PASSWORD )),
        ] );

        if( $return_value != RECORD_NOT_INSERTED )
        {
            return Class_Database::return_FM_Success( "User Inserted Successfully " , 'view_add_user' );
        }
        else
        {
            return Class_Database::return_FM_Error( " Error in Inserting User " , 'view_add_user' );
        }
    }

    public function fun_view_all_user()
    {
        $array_collection  =  DB::table( TB_USER )->select( USER_INR_ID ) -> get();
        if( count( $array_collection ) != ZERO )
        {
            $user_collection = DB::table( TB_USER )->orderBy( USER_INR_ID, ASCENDING )->get();
            return View( 'view_all_user' )->with( ARRAY_USER , $user_collection );
        }
        else
        {
            Class_Database::return_FM_Warning( " No Records In User Table " , '/' );
        }
    }

    public static function fun_update_user( $user_inr_id )
    {
        $password           = Input::get(PASSWORD );

        if( $password == "")
        {
            return Class_Database::return_FM_Success( "Password field is empty " , 'view_all_user' );
        }

        DB::table( TB_USER )
            ->where( USER_INR_ID , $user_inr_id )
            -> update
            ([
                PASSWORD => bcrypt($password),
            ] );
        return Class_Database::return_FM_Success( "User Updated Successfully " , 'view_all_user' );
    }

    public function fun_delete_user( $user_inr_id )
    {
        $return_value   =  DB::table( TB_USER )
            ->where( USER_INR_ID , $user_inr_id )
            ->delete();

        if( $return_value == RECORD_DELETED )
        {
            return Class_Database::return_FM_Success( "User Deleted Successfully " , 'view_all_user' );
        }
        else
        {
            return Class_Database::return_FM_Error( " Error in Deleting User " , 'view_all_user' );
        }
    }
}
