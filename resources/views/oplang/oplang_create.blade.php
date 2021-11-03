<style>
    .border-bottom{
        border: none;
        border-bottom : 1px solid grey;
        padding: 0;
    }
</style>
@php
    $witel = $data[0]->area;
    switch ($witel) {
        case 'DENPASAR':
            $kode = 'SPXAM81';
            break;
        case 'JEMBER':
            $kode = 'SPAAA80';
            break;
        case 'KEDIRI':
            $kode = 'SPRON74';
            break;
        case 'MALANG':
            $kode = 'SPDER82';
            break;
        case 'PASURUAN':
            $kode = 'SPABG96';
            break;
        case 'MADIUN':
            $kode = 'SPPLD08';
            break;
        case 'SURABAYA UTARA':
            $kode = 'SPXRC01';
            break;
        case 'SURABAYA SELATAN':
            $kode = 'SPKRI05';
            break;
        case 'SIDOARJO':
            $kode = 'SPMLN30';
            break;
        case 'MADURA':
            $kode = 'SPROS26';
            break;
        case 'NTT':
            $kode = 'SPMMD83';
            break;
        case 'SINGARAJA':
            $kode = 'SPDEK97';
            break;
        case 'NTB':
            $kode = 'SPIKA17';
            break;
        default:
            $kode = '';
            break;
    }
@endphp
<h1 class="h3 mb-2 text-gray-800">Update Data WO Oplang</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <a href="{{ url('oplang') }}" class="btn btn-danger btn-sm float-right"><i class="fas fa-arrow-left"></i> Kembali ke Data Oplang</a>
            </div>
        </div>
        <hr>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ url('oplang/update/'.$data[0]->id_upspeed) }}" method="post">
            @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                DATA WO
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nd_pots"><strong>NO HP / KONTAK :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->nomor_hp }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>ND INTERNET :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->nomor_inet }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>NAMA PELANGGAN :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->nama_pelanggan }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>CURRENT SPEED :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->cur_speed }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>HARGA PAKET CURRENT:</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ number_format($data[0]->abonemen) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>UP TO SPEED :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->up_to_speed }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>NAMA PAKET :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->nama_paket }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>HARGA PAKET UP:</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ number_format($data[0]->paket_tarif) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>PENAMBAHAN HARGA :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ number_format($data[0]->pen_harga) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>ADDON :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->addon }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>KCONTACT :</strong></label>
                                    <textarea name="kcontact" id="kcontact" cols="30" rows="10" class="form-control" disabled>AOSF;{{$kode ?? ''}};DGTL;{{ $data[0]->nama_pelanggan.';'.$data[0]->nomor_hp.';'.$data[0]->up_to_speed.';selisih '.$data[0]->pen_harga }}
                                    @php
                                        \DB::table('upspeed_new')->where('id_upspeed',$data[0]->id_upspeed)->update([
                                            'kcontact' => 'AOSF;'.$kode.';DGTL;'.$data[0]->nama_pelanggan.';'.$data[0]->nomor_hp.';'.$data[0]->up_to_speed.';selisih '.$data[0]->pen_harga
                                        ]);
                                    @endphp
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nd_pots"><strong>WITEL :</strong></label>
                                    <input type="text" class="form-control form-control-sm border-bottom" value="{{ $data[0]->area }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="nd_pots">STATUS OPLANG</label>
                        <select name="status_oplang" id="status_oplang" class="select2 form-control">
                            <option value="">Pilih Status Oplang</option>
                            <option value="1" <?php if($data[0]->status_oplang == 1){echo 'selected';}else{echo '';}?>>SUKSES</option>
                            <option value="2" <?php if($data[0]->status_oplang == 2){echo 'selected';}else{echo '';}?>>ANOMALI</option>
                            <option value="3" <?php if($data[0]->status_oplang == 3){echo 'selected';}else{echo '';}?>>GAGAL</option>
                        </select>
                        @error('status_oplang') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan_mc">KETERANGAN OPLANG</label>
                        <textarea name="keterangan_oplang" id="keterangan_oplang" class="form-control" cols="30" rows="10">{{ $data[0]->keterangan_oplang }}</textarea>
                        @error('keterangan_oplang') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
                </div>
            </div> --}}
        </form>
    </div>
</div>
          