<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class MolaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Mola TV Subscribtion',
            'content' => 'mola.mola'
        ];

        return view('mola.layout.index',['data' => $data]);
    }

    public function mola_notif($param)
    {
        $data = [
            'title' => 'Mola TV Subscribtion',
            'content' => 'mola.mola_notif',
        ];

        return view('mola.layout.index',['data'=>$data]);
    }

    public function getMolaDapros(Request $r)
    {
        $no_hp = $r->input('no_hp');

        $query = DB::select("select * from mola_sub_master where no_hp = '$no_hp'");
        if($query){
            return response([
                'status' => 200,
                'data' => $query[0],
                'message' => 'Data ditemukan'
            ]);
        }else{
            return response([
                'status' => 500,
                'data' => [],
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }

    public function insert(Request $r)
    {
        $rules = [
            'no_hp' => 'required',
            'nd_internet' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'agree' => 'required'
        ];

        $message = [
            'email.required' => 'E-mail tidak boleh kosong!',
            'agree.required' => 'Anda belum menyetujui terms & conditon'
        ];

        $isValid = Validator::make($r->all(),$rules, $message);

        if($isValid->fails()){
            return redirect()->back()->withErrors($isValid->errors());
        }else{
            $data = [
                'id_master' => $r->input('id_master'),
                'email' => $r->input('email'),
                'no_hp' =>  $r->input('no_hp'),
                'nd_internet' => $r->input('nd_internet'),
                'nama' => $r->input('nama'),
                'no_hp_alt' => $r->input('no_hp_alt')
            ];

            $query = DB::table('mola_sub_agree')->insert($data);

            if($query){
                return redirect()->back()->with('success','Registrasi berhasil!');
            }else{
                return redirect()->back()->with('error','Terjadi kesalahan, registrasi gagal!');
            }
        }
    }

    public function listData()
    {
        $query = DB::select("
            select a.*, b.nama nama_user, b.username, c.* from mola_sub_agree a 
                left join users b on a.user_oplang = b.id
                left join areas c on a.cwitel = c.cwitel
        ");
        $response['data'] = [];
        foreach ($query as $i => $v) {
            if($v->status_oplang == 1){
                $status = '<span class="badge badge-success">SUKSES by '.$v->username.'</span>';
            }else if($v->status_oplang == 2){   
                $status = '<span class="badge badge-warning">ANOMALI by '.$v->username.'</span>';
            }else if($v->status_oplang == 3){
                $status = '<span class="badge badge-danger">GAGAL by '.$v->username.'</span>';
            }else{
                $status = '<span class="badge badge-danger"><i>No Status</i></span>';
            }
            $response['data'][] = [
                ++$i,
                $v->nd_internet,
                $v->no_hp,
                $v->nama,
                $status,
                date('d/m/Y H:i',strtotime($v->created)),
                '
                <a href="'.url('oplang/mola/edit/'.$v->id).'" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Update</a>
                '
            ];
        }

        return response($response);
    }

    public function view()
    {
        $data = [
            'title' => 'Mola Data List Subscription',
            'content' => 'oplang.oplang_mola_agree_view'
        ];

        return view('layout.index',['data'=> $data]);
    }

    public function edit($id)
    {
        $query = DB::select("select a.*, b.nama nama_user, c.* from mola_sub_agree a 
        left join users b on a.user_oplang = b.id
        left join areas c on a.cwitel = c.cwitel where a.id = $id ");

        $data = [
            'title' => 'Edit Mola Subscription',
            'data' => $query,
            'content' => 'oplang.oplang_mola_agree_edit'
        ];

        return view('layout.index',['data'=>$data]);
    }

    public function update(Request $r, $id)
    {
        $rules = [
            'status_oplang' => 'required',
        ];

        $isValid = Validator::make($r->all(),$rules);
        if($isValid->fails()){
            return redirect()->back()->withErrors($isValid->errors());
        }else{
            $data = [
                'status_oplang' => $r->input('status_oplang'),
                'keterangan_oplang' => $r->input('keterangan_oplang'),
                'created_oplang' => date('Y-m-d H:i:s'),
                'user_oplang' => session('id_user')
            ];

            $query = DB::table('mola_sub_agree')->where('id',$id)->update($data);
            
            if($query){
                return redirect()->back()->with('success','Update data berhasil!');
            }else{
                return redirect()->back()->with('error','Terjadi kesalahan, update data gagal!');
            }
        }
    }
}
