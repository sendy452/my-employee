<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);


        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'User Not Found'], 401);
        }


        return $this->respondWithToken($token);
    }
 
    public function update(Request $request, $idkaryawan)
    {
        //Validate data
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama' => 'string',
            'nik' => 'numeric',
            'nip' => 'string',
            'nohp' => 'numeric',
            'tlahir' => 'string',
            'tgllahir' => 'date',
            'alamat' => 'string',
            'negara' => 'string',
            'jekel' => 'string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 200);
        }

        $user = User::find($idkaryawan);

        //Request is valid, update data
        $user->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nohp' => $request->nohp,
            'tlahir' => $request->tlahir,
            'tgllahir' => $request->tgllahir,
            'alamat' => $request->alamat,
            'negara' => $request->negara,
            'jekel' => $request->jekel
        ]);

        //Data updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function changePassword(Request $request, $idkaryawan)
    {
        //Validate data
        $data = $request->all();
        $validator = Validator::make($data, [
            'password' => 'string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 200);
        }

        $user = User::find($idkaryawan);

        //Request is valid, update data
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        //Data updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        auth('api')->logout();


        return response()->json(['message' => 'Successfully logged out']);
    }
 
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
