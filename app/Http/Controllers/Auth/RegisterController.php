<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:VENDOR,USER'], // Add validation for the role
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(10),
        ]);

        if ($data['role'] == 'USER') {
            $role = Role::where('name', '=', 'Customer')->first();
        }else{
            $role = Role::where('name', '=', 'Vendor')->first();
        }
        $user->notify(new WelcomeEmailNotification());

        // try {
            // $email = $data['email'];
            // $data = [
            //     'name' => $data['name'],
            // ];
            // Mail::send('email.welcome', $data, function ($message) use ($email) {
            //     $message->to($email, env('MAIL_FROM_NAME'))->subject('Welcome How to sell');
            //     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            // });
        // } catch (\Exception $e) {
        //     dd($e);
        //     return response()->json($e->getMessage(), SiteHelper::$error_status);
        // }
        $user->assignRole($role->id);
        return  $user;
    }

    // Override the registered function to redirect without sending email verification
    protected function registered(Request $request, $user)
    {
        // Redirect to the dashboard after registration
        // return redirect($this->redirectPath());
    }
}
