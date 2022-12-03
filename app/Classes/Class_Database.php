<?php

namespace App\Classes;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Schema;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;


class Class_Database
{

    //*************************************** Flash Message ************************************************//

    public static function return_FM_Success( $message , $route_name )
    {
        Flash::success( $message )->important();
        return Redirect::to( $route_name )->send();
    }

    public static function return_FM_Success_Route( $message , $tag_route_name , $parameter )
    {
        Flash::success( $message )->important();
        return Redirect::route( $tag_route_name , $parameter  );
    }

    public static function return_FM_Success_Route_Two_Parameter( $message , $tag_route_name , $return_paramater_response )
    {
        Flash::success( $message )->important();
        return Redirect::route( $tag_route_name , $return_paramater_response );
    }

    public static function return_FM_Error( $message , $route_name )
    {
        Flash::error( $message )->important();
        return Redirect::to( $route_name )->send();
    }

    public static function return_FM_Error_Route( $message , $tag_route_name , $parameter )
    {
        Flash::error( $message )->important();
        return Redirect::route( $tag_route_name , $parameter  );
    }

    public static function return_FM_Error_Route_Two_Parameter( $message , $tag_route_name , $return_paramater_response )
    {
        Flash::error( $message )->important();
        return Redirect::route( $tag_route_name , $return_paramater_response );
    }
    public static function return_FM_Warning( $message , $route_name )
    {
        Flash::error( $message )->important();
        return Redirect::to( $route_name )->send();
    }

    public static function return_FM_Warning_Route( $message , $tag_route_name , $parameter )
    {
        Flash::error( $message )->important();
        return Redirect::route( $tag_route_name , $parameter );
    }
}
