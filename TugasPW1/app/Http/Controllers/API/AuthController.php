<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'password'  => 'required'
        ]);

        $validate['password'] = bcrypt($request->password);

        $user = User::create($validate);
        if($user) {
            $data['Success'] = true;
            $data['Message'] = "User Berhasil Terdaftar";
            $data['Data'] = $user;
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED);
        }else {
            $data['Success'] = false;
            $data['Message'] = "User Gagal Terdaftar";
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {   
        if(auth('web')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            //ambil data user yang sedang login kalo sudah dikonfirmasi 
            $user = auth('web')->user();
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            $data['name'] = $user->name;
            return response()->json($data, 201);
        } else {
            $data['Success'] = false;
            $data['Message'] = "Anda penipu, kepada siapa anda bekerja?";
            $data['Data'] = 244;
            return response()->json($data, 401);
        }
    }
}
