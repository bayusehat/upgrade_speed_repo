<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Hash;
use Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $isValid = Validator::make($request->all(),$rules);

        if($isValid->fails()){
            return redirect()->back()->withErrors($isValid->errors());
        }else{
            $username = $request->input('username');
            $password = $request->input('password');

            $check = DB::select("SELECT A.*,B.AREA,C.PROFILE FROM USERS A 
                                LEFT JOIN AREAS B ON A.CWITEL = B.CWITEL 
                                LEFT JOIN PROFILES C ON A.PROFILE_ID = C.ID
                                WHERE USERNAME = '$username'");

            if($check){
                // if($check[0]->deleted_at == null){
                    if(Hash::check($request->input('password'), $check[0]->password)){
                        $session = [
                            'id_user'  => $check[0]->id,
                            'username' => $check[0]->username,
                            'token'    => Str::random(60),
                            'profil'   => $check[0]->profile,
                            'witel'    => $check[0]->area
                        ];
                        session($session);
                        if(request()->segment(1) == 'addon_indihome'){
                            return redirect('mola/agree');
                        }
                        
                        if(session('profil') == 'OPLANG'){
                            return redirect('/oplang');
                        }else if(session('profil') == 'OBC'){
                            return redirect('/obc');
                        }else{
                            return redirect('/oplang');
                        }
                    }else{
                        return redirect()->back()->with('error','Password yang anda masukkan salah!');
                    }
                // }else{
                //     return redirect()->back()->with('error','User tidak aktif!');
                // }
            }else{
                return redirect()->back()->with('error','User tidak ditemukan');
            }
        }
    }

    public function doLogout()
    {
        session()->flush();
        session()->forget('token');
        session()->save();
        return redirect('/login');
    }

    public function create_admin()
    {
        $data = [
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'cwitel' => 1005,
            'profile_id' => 1,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insert = DB::table('users')->insert($data);
        
        if($insert){
            echo 'Sukses';
        }else{
            echo 'Gagal';
        }
    }
}
