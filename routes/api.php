<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;

Route::group(['middleware' => ['auth:sanctum']], function () {

});
