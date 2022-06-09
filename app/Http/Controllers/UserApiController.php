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
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')->where('email',$email)->where('tb_karyawan.is_active',1)->first();
        if($data){ 
            if(Hash::check($password,$data->password)){
               return response()->json(['error' => false, 'user' => $data], 200);
            } 
            else{
                return response()->json([
                    'error' => true,
                    'message' => 'Password Salah'
                ]);
            }
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Akun Tidak Ditemukan'
            ]);
        }
    }

    public function me($idkaryawan)
    {
        $data = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')->where('id_karyawan',$idkaryawan)->where('tb_karyawan.is_active',1)->first();
        if($data){ 
            
            return response()->json(['error' => false, 'user' => $data], 200);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Akun Tidak Ditemukan'
            ], 401);
        }
    }
 
    // public function refreshToken()
    // {
    //     return response()->json([
    //         'error' => false,
    //         'token' => auth('api')->refresh(),
    //         'type' => 'bearer',
    //         // 'user' => auth('api')->user(),
    //         // 'authorisation' => [
    //         //     'token' => auth('api')->refresh(),
    //         //     'type' => 'bearer',
    //         // ]
    //     ]);
    // }

    public function update(Request $request, $idkaryawan)
    {
        //Validate data
        $data = $request->all();
        $validator = Validator::make($data, [
            'nik' => 'unique:tb_karyawan,nik,'.$idkaryawan.',id_karyawan',
            'nip' => 'unique:tb_karyawan,nip,'.$idkaryawan.',id_karyawan',
            'nohp' => 'unique:tb_karyawan,nohp,'.$idkaryawan.',id_karyawan'
        ],[
            'nik.unique' => 'NIK/KTP telah didaftarkan akun lain.',
            'nip.unique' => 'NIP telah didaftarkan akun lain.',
            'nohp.unique' => 'No. Hp telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->messages()], 200);
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
            'error' => false,
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
            return response()->json(['error' => true, 'message' => $validator->messages()], 200);
        }

        $user = User::find($idkaryawan);

        //Request is valid, update data
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        //Data updated, return success response
        return response()->json([
            'error' => false,
            'message' => 'Password updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    // public function logout()
    // {
    //     auth('api')->logout();


    //     return response()->json(['error' => false, 'message' => 'Successfully logged out']);
    // }
 
    // public function me()
    // {
    //     return response()->json(auth('api')->user());
    // }

    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'error' => false,
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth('api')->factory()->getTTL() * 60
    //     ]);
    // }
}
