<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{
    public function getNotification()
    {
        $query = DB::select("SELECT * FROM UPSPEED_NEW WHERE FLAG_SEE = 0 ORDER BY CREATED ASC");
        $query_limit = DB::select("SELECT * FROM UPSPEED_NEW WHERE FLAG_SEE = 0 ORDER BY CREATED ASC LIMIT 5");
        $jumlah = count($query);

        $data = [
            'notification' => $query_limit,
            'jumlah_notif' => $jumlah
        ];

        return response($data);
    }

    public function showNotif()
    {
        $response['data'] = [];
        $query = DB::select("SELECT A.*,B.USERNAME FROM UPSPEED_NEW A LEFT JOIN USERS B ON A.USER_OPLANG = B.ID WHERE FLAG_SEE = 0 ORDER BY CREATED,STATUS_OPLANG ASC");
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
                $v->nomor_inet,
                $v->nomor_hp,
                $v->nama_pelanggan,
                $status,
                date('d/m/Y H:i',strtotime($v->created)),
                '
                <a href="'.url('oplang/edit/'.$v->id_upspeed).'" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Update</a>
                '
            ];
        }

        return response($response);
    }
}
