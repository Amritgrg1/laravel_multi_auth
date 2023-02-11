<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Websitemail;
use Hash;
use Auth;


class WebsiteController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    
    public function dashboard_user()
    {
        return view('dashboard_user');
    }
    
    public function dashboard_admin()
    {
        return view('dashboard_admin');
    }

    public function settings()
    {
        return view('settings');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');

    }

    public function login_submit(Request $req)
    {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password,
            'status' => 'Active',
        ];

        if(Auth::attempt($credentials))
        {
            if(Auth::guard('web')->user()->role == 0){

                return redirect()->route('dashboard_admin');
            }else{
                return redirect()->route('dashboard_user');
                
            }

        }
        else{
            return redirect()->route('login');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function register_submit(Request $req)
    {
        $token = hash('sha256', time());
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->status = 'Pending';
        $user->token = $token;
        $user->role = 2;

        $user->save();

        $verification_link = url('register/verify/'.$token.'/'.$req->email);
        $subject = 'registration confirmation';
        $message = 'Please click on this link:<br><a href="'.$verification_link.'">Click here</a>';

        \Mail::to($req->email)->send(new Websitemail($subject,$message));

        echo 'email is sent';

    }

    public function register_verify($token,$email)
    {
        $user = User::where('token',$token)->where('email',$email)->first();
        if(!$user)
        {
            return redirect()->route('login');

        }

        $user->status = 'Active';
        $user->token = '';
        $user->update();
        echo 'Registration verification is successful';
    }

    public function forget_password()
    {
        return view('forget_password');
    }

    public function forget_password_submit(Request $req)
    {
        $token = hash('sha256', time());
        $user = User::where('email',$req->email)->first();
        if(!$user)
        {
            dd('user not found');
        }

        echo 'check you email...';

        $user->token = $token;
        $user->update();

        $reset_link = url('reset-password/'.$token.'/'.$req->email);
        $subject = 'Reset Password';
        $message = 'Please Click on the following link:<br> <a href="'.$reset_link.'">Click here</a>';
        \Mail::to($req->email)->send(new Websitemail($subject,$message));
    }

    public function reset_password($token, $email)
    {
        $user = User::where('token',$token)->where('email',$email)->first();
        if(!$user)
        {
           return redirect()->route('login');
        }

        return view('reset_password', compact('token', 'email'));

        
    }

    public function reset_password_submit(Request $req)
    {
        $user = User::where('token',$req->token)->where('email',$req->email)->first();

        $user->token = '';
        $user->password = Hash::make($req->new_password);
        $user->update();

        echo 'password is reset';
    }

}

