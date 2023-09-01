<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Helpers\SiteHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    
        $page = "setting";
        return view('admin/setting/index', compact('page'));
    }

    public function update(Request $request)
    {
    
        if ($request['email_template']) {
            // Update Email Template
            $emailTemplate = EmailTemplate::where('name', '=', 'email_template')->first();
            $emailTemplate->content = $request->input('email_template');
            $emailTemplate->save();
        }

        if ($request['STRIPE_PUBLIC_KEY'] && $request['STRIPE_SECRET_KEY']) {
            // Update Stripe Keys
            $stripeKey = $request['STRIPE_PUBLIC_KEY'];
            $stripeSecret = $request['STRIPE_SECRET_KEY'];
            
            // Update the STRIPE_SECRET and STRIPE_KEY in your settings table
            Setting::where('id', 1)->update(['STRIPE_PUBLIC_KEY' => $stripeKey , 'STRIPE_SECRET_KEY' => $stripeSecret]);
            
            // Get the current environment file path
            $envFilePath = App::environmentFilePath();
    
            if (File::exists($envFilePath)) {
                $currentEnvContents = File::get($envFilePath);
        
                // Replace or add the STRIPE_KEY and STRIPE_SECRET values
                $newEnvContents = preg_replace(
                    [
                        '/^STRIPE_KEY=.*/m',
                        '/^STRIPE_SECRET=.*/m'
                    ],
                    [
                        'STRIPE_KEY=' . $stripeKey,
                        'STRIPE_SECRET=' . $stripeSecret
                    ],
                    $currentEnvContents
                );
        
                // Write the updated contents back to the environment file
                File::put($envFilePath, $newEnvContents);
            }
        }

        return redirect()->back()->with('message', 'Settings updated successfully.');
    }

}