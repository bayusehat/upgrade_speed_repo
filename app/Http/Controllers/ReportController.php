<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Exports\ReportExport;
// use Maatwebsite\Excel\Facades\Excel;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Report Witel',
            'content' => 'report_witel'
        ];

        return view('layout.index',['data' => $data]);
    }
    public function getReport(Request $request)
    {
        $tgl_now = !empty($request->input('tgl_ke')) ? date('Y-m-d 23:59:59',strtotime($request->input('tgl_ke'))) : date('Y-m-d 23:59:59');
        $tgl_prev = !empty($request->input('tgl_prev')) ? date('Y-m-d 00:00:00',strtotime($request->input('tgl_prev'))) : date('Y-m-d 00:00:00',strtotime("-3 days"));
        
        $response['data'] = [];
        $query = DB::select("
        SELECT A.AREA,
            COALESCE(SUKSES,0) SUKSES, COALESCE(ANOMALI,0) ANOMALI, COALESCE(GAGAL,0) GAGAL, COALESCE(BELUM_INPUT,0) BELUM_INPUT,
            COALESCE(DAPROS,0) DAPROS
            FROM(    
            SELECT CWITEL, AREA
            FROM AREAS
            ) A
            LEFT JOIN 
            ( 
                SELECT Y.CWITEL,
                SUM(CASE WHEN Y.STATUS_OPLANG = 1 THEN 1 ELSE 0 END) SUKSES,
                SUM(CASE WHEN Y.STATUS_OPLANG = 2 THEN 1 ELSE 0 END) ANOMALI,
                SUM(CASE WHEN Y.STATUS_OPLANG = 3 THEN 1 ELSE 0 END) GAGAL,
                SUM(CASE WHEN Y.STATUS_OPLANG = 0 THEN 1 ELSE 0 END) BELUM_INPUT,
                COUNT(*) DAPROS 
                FROM UPSPEED_NEW Y 
                WHERE Y.CREATED BETWEEN '$tgl_prev' AND '$tgl_now'
                GROUP BY Y.CWITEL
            ) B ON A.CWITEL = B.CWITEL
            WHERE AREA NOT IN ('REGIONAL 5','TAM MALANG')
            ORDER BY AREA
        ");

        foreach ($query as $i => $v) {

            $agree = $v->belum_input + $v->sukses + $v->anomali + $v->gagal;
            $dec_dapros = floatval($v->dapros);
            $ach = $dec_dapros > 0 ? number_format($agree / $dec_dapros * 100,2) : 0;

            $response['data'][] = [
                ++$i,
                $v->area, 
                number_format($v->dapros),
                number_format($agree),
                number_format($v->belum_input),
                number_format($v->sukses),
                number_format($v->anomali),
                number_format($v->gagal),
                $ach.'%'
            ];
        }

        return response($response);
    }
    
    public function downloadReport(Request $request)
    {
        $tipe = $request->input('tipe');
        $tgl = $request->input('tgl_report');

        $columns = Schema::getColumnListing('upspeed_new');
        return Excel::download(new ReportExport($tipe,$tgl), $tipe.'-'.date('YmdHis').'.xlsx');
    }
    
    public function get_sukses_report(Request $request)
    {
        $tgl_now = !empty($request->input('tgl_ke')) ? date('Y-m-d 23:59:59',strtotime($request->input('tgl_ke'))) : date('Y-m-d 23:59:59');
        $tgl_prev = !empty($request->input('tgl_prev')) ? date('Y-m-d 00:00:00',strtotime($request->input('tgl_prev'))) : date('Y-m-d 00:00:00',strtotime("-3 days"));
        
        $query = DB::select("select * from upspeed_new where status_oplang = 1 and created between '$tgl_prev' and '$tgl_now'");
        $nama = 'Report Sukses '.$tgl_prev.' - '.$tgl_now.'.xlsx';
        fastexcel($query)->export(public_path('assets/'.$nama));
        
        $pathToFile = public_path('assets/'.$nama);
        $tempImage = tempnam(sys_get_temp_dir(), $nama);
        
        if(!@copy($pathToFile, $tempImage)){
            return redirect()->back()->with('error','Terjadi kesalahan, download gagal! file tidak ditemukan');
        }else{
            return response()->download($tempImage,  $nama);
        }
    }
    
    public function get_anomali_report(Request $request)
    {
        $tgl_now = !empty($request->input('tgl_ke')) ? date('Y-m-d 23:59:59',strtotime($request->input('tgl_ke'))) : date('Y-m-d 23:59:59');
        $tgl_prev = !empty($request->input('tgl_prev')) ? date('Y-m-d 00:00:00',strtotime($request->input('tgl_prev'))) : date('Y-m-d 00:00:00',strtotime("-3 days"));
        
        $query = DB::select("select * from upspeed_new where status_oplang = 2 and created between '$tgl_prev' and '$tgl_now'");
        $nama = 'Report Anomali '.$tgl_prev.' - '.$tgl_now.'.xlsx';
        fastexcel($query)->export(public_path('assets/'.$nama));
        
        $pathToFile = public_path('assets/'.$nama);
        $tempImage = tempnam(sys_get_temp_dir(), $nama);
        
        if(!@copy($pathToFile, $tempImage)){
            return redirect()->back()->with('error','Terjadi kesalahan, download gagal! file tidak ditemukan');
        }else{
            return response()->download($tempImage,  $nama);
        }
    }
}
