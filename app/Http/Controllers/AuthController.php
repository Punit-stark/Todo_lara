<?php

namespace App\Http\Controllers;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   //facades, service container

class AuthController extends Controller
{
    public function showRegisterform(){
        return view('auth.register');    
    }   

    public function register(Request $request){
     try {
           $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        Auth::login($user);   //
        return redirect('/login');

     } catch (\Throwable $e) {
        dd($e->getMessage());
     }
   
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $creds=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($creds)){  
            //take array and check creds with hash to db
            $request->session()->regenerate();   //regenrate new session for security
            return to_route('dashboard');   //intended if authenticate then redirect dashbord else in login by intended
        }
    }

    public function logout(Request $request){
        Auth::logout();          //logout user
        $request->session()->invalidate();  //destroy session
        $request->session()->regenerateToken();   //regenerate csrf for security

        return to_route('login');
    }
}

// view('auth.login') - Returns the view file
// redirect()->route('login') - Redirects to the login route
// redirect()->back() - Goes back to previous page (good for form errors)
// redirect('/login') - Direct redirect to /login URL
// redirect()->intended('/dashboard') - Redirect to intended page or fallback