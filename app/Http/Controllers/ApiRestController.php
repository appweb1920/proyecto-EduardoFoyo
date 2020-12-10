<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

use Validator;
use App\UserLove;

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

    public function usersRecommended(Request $request)
    {
        $user = UserLove::where('user_token', $request['token'])->first();
        $users = DB::select('select * from user_love where gender != :gender and id != :id', ['gender'=>$user->gender,'id' => $user->id]);
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
        
        $path = $request->file('image')->store('images');
        $user->user_photo = $path;
        
        $user->save();

        return response()->json(array(
            "success" => true,
            "message" => "Actualizado"
        ), 200);

    }
}

