<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    function login(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect(Route('login'))
            ->withErrors($validator)
            ->withInput();
        }else{
            // dd($request);
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return Redirect(Route('dashboard'));
            }else{
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.'
                ])->onlyInput('email');
            }
        }
    }

    function signup(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);
        // dd($request);
        if ($validator->fails()) {
            return Redirect(Route('signup'))
            ->withErrors($validator)
            ->withInput();
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if($user->save()){
                return Redirect(Route('login'))->with(['message'=>'Signed Up Successfully']);
            }else{
                return Redirect(Route('signup'))->with(['message'=>'Something Went Wrong']);
            }
        }
    }
    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect(Route('login'))->with(['message'=>'Signed Out Successfully']);

    }
}
