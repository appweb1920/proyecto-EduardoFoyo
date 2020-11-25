<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|max:255',
            'gender' => 'required|int|max:1',
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
            return response()->json("Las contraseñas tienen que ser iguales", 200);

        $user->password = bcrypt($request['password']);
        $user->description = "Agregar Descripcion";
        $user->user_photo = "img";
        $user->gender = ($request['gender'] == 0) ? 'm' : 'f';

        if ($user->save()) {
            return response()->json("Agregado", 200);
        }else{
            return response()->json("Error al entrar en tu cuenta, revisa tus credenciales", 200);
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
                        "user" => $user
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
}

