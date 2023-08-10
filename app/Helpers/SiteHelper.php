<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class SiteHelper
{
    public static $success_status = 200;
    public static $error_status = 500;
    public static $bad_request_status = 400;
    public static $unauthorized_status = 401;

    public static function settings()
    {
        $Settings = array();
        $Settings['PrimaryColor'] = '#B3904E';
        $Settings['AppName'] = 'Rental Management With Location';
        $Settings['Currency'] = 'USD';
        $Settings['Pagination'] = 15;
        return $Settings;
    }

    public static function SendBadRequestError($message)
    {
        $data = array(
            'status' => false,
            'message' => $message,
        );
        return $data;
    }

    public static function SendErrorMessage($message)
    {
        $data = array(
            'status' => false,
            'message' => $message,
        );
        return $data;
    }

    public static function SendSuccessMessage($message)
    {
        $data = array(
            'status' => true,
            'message' => $message,
        );
        return $data;
    }
}
