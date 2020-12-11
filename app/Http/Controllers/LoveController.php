<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserLove;
use App\Interest;

class LoveController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function layout(Request $request)
    {
        return view('layout');
    }

    public function showUsers(Request $request)
    {
        return view('user_list');
    }

    public function addInterestView(Request $request)
    {
        return view('add_interest');
    }

    public function modifyUser(Request $request,$id)
    {
        $user = UserLove::where('id', $id)->first();
        return view('user_profile')->with('user',$user);
    }

    public function editUserData(Request $request)
    {
        if ($request) {
            if($request['password'] === $request['confirm_password']){
                $user = UserLove::where("id",$request['id'])->firstOrFail();
                if ($user->password === $request['password']) {
                    $user->password = $user->password;
                }else{
                    $user->password = bcrypt($request['password']);
                }
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->description = $request['description'];
                $user->save();
                return redirect()->back();
            }else{
                return back()->withErrors("Las contraseñas no coinciden");
            }
        }
    }

    public function addInterest(Request $request)
    {
        $interest = new Interest();
        $interest->interest = $request['interest'];
        $interest->save();
        return redirect()->back();
    }
    
    public function deleteUser(Request $request,$id)
    {
        UserLove::where('id',$id)->firstOrFail()->delete();
        return view('user_list');
    }
}
