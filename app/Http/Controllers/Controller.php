<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $categoryURL="https://azeruser.greenspoints.com/public/categoryImages/";
    protected $bannerURL="https://azeruser.greenspoints.com/public/bannerImages/";
    protected $licenceURL="https://azeruser.greenspoints.com/public/licenceImages/";
    protected $vehicleURL="https://azeruser.greenspoints.com/public/vehicleImages/";
    protected $drivervehicleURL="https://azeruser.greenspoints.com/public/driverVehicle/";
    protected $quotationURL="https://azeruser.greenspoints.com/public/quotationImages";
}
