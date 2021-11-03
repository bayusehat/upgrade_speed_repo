<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ReportExport implements FromCollection,WithHeadings
{
    protected $tipe;
    protected $tanggal;

    public function __construct($tipe,$tanggal)
    {
        $this->tipe = $tipe;
        $this->tanggal = $tanggal;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->tanggal == null){
            $tanggal = "AND A.CREATED::TEXT LIKE '%$tgl%'";
        }else{
            $tanggal = "1=1";
        }

        $query = DB::select("
            SELECT A.NOMOR_HP,A.NOMOR_INET, A.NAMA_PELANGGAN, A.CUR_SPEED, F.ABONEMEN, A.UP_TO_SPEED, D.PENAWARAN, D.PRICE PAKET_TARIF,D.PRICE + COALESCE(G.PRICE,0) -  F.ABONEMEN PEN_HARGA, G.ADDON, CONCAT('AOSF;SPXTH01;',A.NAMA_PELANGGAN,';',A.NOMOR_HP,';',A.UP_TO_SPEED,';selisih ',D.PRICE,D.PRICE + COALESCE(G.PRICE,0) -  F.ABONEMEN) KCONTACT_NEW, C.AREA
            FROM UPSPEED_NEW A 
                LEFT JOIN USERS B ON A.USER_OPLANG = B.ID 
                LEFT JOIN AREAS C ON A.CWITEL = C.CWITEL
                LEFT JOIN UPSPEED_MASTER F ON A.NOMOR_INET = F.ND_INTERNET
                LEFT JOIN OFFERS D ON F.OFFER_ID = D.ID
                LEFT JOIN SPEEDS E ON D.SPEED_ID = E.ID
                LEFT JOIN ADDONS G ON F.ADDON_ID = G.ID
            WHERE STATUS_OPLANG = 2 $tanggal
            GROUP BY A.NOMOR_HP,A.NOMOR_INET, A.NAMA_PELANGGAN, A.CUR_SPEED, F.ABONEMEN, A.UP_TO_SPEED, D.PENAWARAN, PAKET_TARIF, PEN_HARGA, G.ADDON, KCONTACT_NEW,C.AREA
        ");

        return collect($query);
    }

    public function headings(): array
    {
        return [
            'NOMOR HP',
            'NOMOR INTERNET',
            'NAMA PELANGGAN',
            'CURRENT SPEED',
            'HARGA CURRENT SPEED',
            'UP TO SPEED',
            'NAMA PAKET',
            'HARGA PAKET UP',
            'PENAMBAHAN HARGA',
            'ADDON',
            'KSCONTACT',
            'WITEL'
        ];
    }
}
