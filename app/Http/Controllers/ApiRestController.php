<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

use Validator;
use App\UserLove;
use App\Like;
use App\Interest;
use App\UserInterest;
use App\MatchUsers;

class ApiRestController extends Controller
{
    public function createLoveUser(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
            'confirmPassword' => 'required|string|max:255',
            'gender' => 'required|string|max:1',
        ])->validate();

        $user = new UserLove();
        $user->user_token = implode('-', [
                            "love",
                            uniqid(''),
                            bin2hex(random_bytes(4)),
                            bin2hex(random_bytes(2)),
                            bin2hex(chr((ord(random_bytes(1)) & 0x0F) | 0x40)) . bin2hex(random_bytes(1)),
                            bin2hex(chr((ord(random_bytes(1)) & 0x3F) | 0x80)) . bin2hex(random_bytes(1)),
                            bin2hex(random_bytes(6))
                        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request['password'] !== $request['confirmPassword'])
            return response()->json(array(
                        "message" =>"Las contraseñas tienen que ser iguales",
                    ), 200);

        $user->password = bcrypt($request['password']);
        $user->description = "Agregar Descripcion";
        $user->user_photo = "img";
        $user->id_interest = 0;
        $user->gender = $request['gender'];

        if ($user->save()) {
            return response()->json(array(
                        "message" => "Agregado",
                    ), 200);
        }else{
            return response()->json(array(
                        "message" =>"Error al entrar en tu cuenta, revisa tus credenciales",
                    ), 200);
        }
    }

    public function loginLoveUser(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ])->validate();

        $user = UserLove::where('email', $request['email'])->first();
        if ($user) {
            if (Hash::check($request['password'], $user->password)) {
                return response()->json(
                    array(
                        "success" => true,
                        "message" => "Login",
                        "user_token" => $user->user_token
                    ), 200);
            }
            return response()->json(
                array(
                    "success" => false,
                    "message" => "Tu contraseña es Incorrecta"
                ), 200);
        }
        return response()->json(
            array(
                "success" => false,
                "message" => "Tu email no existe en nuestro registro"
            ), 200);
    }

    public function listUsers(Request $request)
    {
        return Datatables::of(UserLove::all())->toJson();
    }

    public function getUserMatches(Request $request)
    {
        $user = UserLove::where('user_token', $request['token'])->first();
        $matches =  MatchUsers::where('user_love_first', $user->id)->orWhere('user_love_second', $user->id)->get();
        return response()->json(array(
                    "success" => true,
                    "matches" => $matches
                ), 200);
    }

    public function usersRecommended(Request $request)
    {
        $user = UserLove::where('user_token', $request['token'])->first();
        $users = [];
        if ($user->id_interest == 0) {
            $users = DB::select('select * from user_love where gender != :gender and id != :id', ['gender'=>$user->gender,'id' => $user->id]);
        }else{
            $user_interest = UserInterest::where("user_love_id",$user->id)->firstOrFail();
            $interest = Interest::where("id",$user_interest->interest_id)->firstOrFail();
            $users = DB::select('select * from user_love where gender != :gender and id != :id and id_interest == :interest', ['gender'=>$user->gender,'id' => $user->id, "interest",$user->id_interest]);
        }
        return response()->json(array(
                    "success" => true,
                    "users" => $users
                ), 200);
    }

    public function getUser(Request $request)
    {
        $user = UserLove::where('user_token', $request['token'])->first();
        return response()->json(array(
                    "success" => true,
                    "user" => $user
                ), 200);
    }

    public function editUserData(Request $request)
    {
        $user = UserLove::where("id",$request['id'])->firstOrFail();
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->description = $request['description'];
        $user->gender = $request['gender'];
        
        //$path = $request->file('image')->store('images');

        if ($request->hasFile('image')){
            $file = $request->file("image");
            $nombrearchivo  = $file->getClientOriginalName();
            $file->move(public_path("img/usuarios/"),$nombrearchivo);
           // $user->user_photo= "img/usuarios/".$nombrearchivo;
            $user->user_photo = $nombrearchivo;
        }else{
            $user->user_photo= "img/productos/default.jpg";
        }
        
        $user->save();

        return response()->json(array(
            "success" => true,
            "message" => "Actualizado"
        ), 200);

    }

    public function like(Request $request)
    {
        $user_love_like = UserLove::where('user_token', $request['token'])->first();
        $user_love_liked = UserLove::where('id', $request['id_liked'])->first();

        if ( Like::where("user_love_like",$user_love_liked->id)->where('user_love_liked',$user_love_like->id)->first() === null) {
            $like = new Like();
            $like->user_love_like = $user_love_like->id;
            $like->user_love_liked = $user_love_liked->id;
            $like->save();
        }else{
            $matchUsers = new MatchUsers();
            $matchUsers->user_love_first = $user_love_like->id;
            $matchUsers->user_love_second = $user_love_liked->id;
            $matchUsers->save();
        }
        return response()->json(array(
            "success" => true,
            "message" => "Hiciste Match"
        ), 200);

    }

    public function relateUserInterests(Request $request)
    {
        $user = UserLove::where('user_token', $request['token'])->first();
        $user->id_interest = $request['id_interest'];
        $user->save();

        return response()->json(array(
            "success" => true,
        ), 200);
    }

    public function getInterest(Request $request)
    {
        $interest = Interest::all();

        return response()->json(array(
            "success" => true,
            "interests" => $interest
        ), 200);
    }
}

