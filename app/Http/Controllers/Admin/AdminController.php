<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use App\Mail\Websitemail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        return view('admin.dashboard',compact('user'));
    }

    public function login()
    {
        $user = auth()->user();
        return view('admin.login',compact('user'));
    }

    public function login_submit(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get the input data
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Attempt to authenticate the user
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials');
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logout successfull');

    }
    public function forget_password(){
        $user = auth()->user();
        return view('admin.forget-password','user');
    }
    public function forget_password_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $admin_data = Admin::where('email',$request->email)->first();
        if(!$admin_data){
            return redirect()->back()->with('error','Email not found');
        }
        $token = hash('sha256',time());
        $admin_data->token =$token;
        $admin_data->update();

        $reset_link =url('/admin/reset-password/'.$token.'/'.$request->email);
        $subject ="Reset Password";
        $message = "Please click on below link to reset your password<br><br>";
        $message = "<a href='".$reset_link."'>Click here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Reset Password link sent on your email');
    }

    //admin perform registration
    public function showRegisterDoctorForm()
    {
        $user = auth()->user();
        return view('admin.register-doctor',compact('user'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|in:1,2', // Ensure valid usertype selection
        ]);

        $usertype = $request->usertype;
        $role = '';

        if ($usertype == 1) {
            $role = 'doctor';
        } elseif ($usertype == 2) {
            $role = 'specialist';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $usertype,
            'role' => $role, // Assign role to the role field
        ]);

        if ($role) {
            $user->assignRole($role);
        }

        $redirectRoute = 'admin.register.doctor'; // Redirect route for both doctor and specialist registration

        return redirect()->route($redirectRoute)->with('success', 'User registered successfully.');
    }
}

