  <div class="site-section" id="formsect" name="formsect">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <img src="{{ asset('assets/images/bannermola.jpg') }}" style="margin-bottom:20px;width:100%" > 

          <p>Nikmati 51 pertandingan UEFA EURO 2020 yang akan tayang mulai 11 Juni 2021 - 12 Juli 2021 hanya di MOLA melalui IndiHome TV.</p>
          <p>Selain itu, terdapat juga pertandingan bola bergengsi lainnya mulai dari EPL, Bundesliga dan laga dari Timnas Indonesia serta masih banyak lagi.</p>
          <p>Aneka film Hollywood unggulan, mulai dari film festival hingga box office dan series di MOLA juga siap menemani Anda dan keluarga.</p>
          <br>
          <i><p>Syarat dan Ketentuan Berlangganan:</p></i>
          <div style="margin-left:20px">
            1.	Add-on MOLA berlaku untuk pelanggan IndiHome.<br>
            2.	Biaya berlangganan add-on MOLA Rp50.000/bulan. Masa aktif layanan berlaku selama 30 hari sejak diaktifkan.<br>
            3.	Dengan berlangganan MOLA, Anda dapat langsung menikmati EURO 2020 di samping konten MOLA lainnya.<br>
            4.	Untuk pembayaran add-on MOLA akan masuk ke dalam tagihan IndiHome pelanggan setiap bulan.<br>
            5.	Add-on ini berlaku untuk penggunaan di rumah. Untuk keperluan komersial atau event silakan menghubungi pihak MOLA melalui email support@molalivearena.com.<br>
            6.	Harga belum termasuk PPN 10%.<br>
          </div>
          <br>
          <form method="post" action="{{ url('mola/insert') }}">

            @csrf

            <p>Untuk berlangganan, silakan mengisi form berikut ini:</p>
            <div class="p-3 p-lg-5 border" id="form-contain">
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
                <div class="form-group row">

                    <div class="col-md-12">

                        <label for="no_hp" class="text-black">Nomor Handphone yang Menerima WA / SMS <span class="text-danger">*</span></label>

                        <div class="form-inline">

                            <input type="phone" class="form-control col-md-11" id="no_hp" name="no_hp" placeholder="Nomor HP yang Menerima WA / SMS" required>

                            <button type="button" class="btn btn-primary btn-md col-md-1" onclick="getNumber()" style="color: #fff;">CARI</button>

                            @error('no_hp') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-12">

                        <label for="nomor_inet">Nomor Internet <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="nd_internet" id="nd_internet" placeholder="Nomor Internet" readonly>

                        @error('nomor_inet') <span class="text-danger">{{ $message }}</span>@enderror

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-12">

                        <label for="nama">Nama <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pelanggan" readonly>

                        @error('nama') <span class="text-danger">{{ $message }}</span>@enderror

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-12">

                        <label for="email">E-mail <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">

                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-12">

                        <label for="no_hp_alt">Nomor HP Alternatif (Optional)</label>

                        <input type="text" class="form-control" name="no_hp_alt" id="no_hp_alt" placeholder="Nomor HP alternatif">

                        @error('no_hp_alt') <span class="text-danger">{{ $message }}</span>@enderror

                    </div>

                </div>

                <div class="form-check">

                    <input type="hidden" name="id_master" id="id_master">
                    <input type="hidden" name="cwitel" id="cwitel">
                    <input type="checkbox" name="agree" id="disclaimer">
                    <label class="form-check-label" for="disclaimer"><a style="padding:0;text-decoration: underline;color:#0016b1" href="#" data-toggle="modal" data-target="#myModal">Saya menyetujui Disclaimer</a></label>
                    <br>

                    @error('agree') <span class="text-danger">{{ $message }}</span>@enderror

                </div>

                <!-- Modal -->

                <div id="myModal" class="modal fade" role="dialog">

                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content" style="padding:30px">

                        <div class="modal-header">

                        <h4 class="modal-title">Persetujuan</h4>

                        {{--  <button type="button" class="close" data-dismiss="modal">&times;</button>  --}}

                        </div>

                        <div class="modal-body" style="text-align: justify;">
                            <div id="modalContent">
                                <p>Apakah anda setuju untuk menambah layanan Mola TV? </p>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xl-6">
                                        <button type="button" name="yes" class="btn btn-success btn-block" onclick="actionbutton(1)">ya, setuju</button>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xl-6">
                                        <button type="button" name="yes" class="btn btn-warning btn-block" onclick="actionbutton(2)">Tidak</button>
                                    </div>
                                </div>  
                            </div>
                        </div>

                        {{--  <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>  --}}

                    </div>

                    </div>

                </div>

              </br>

              <p>*Penawaran ini hanya untuk pelanggan terbatas<br>

                 *Anda akan dikonfirmasi via telepon untuk penggantian STB IndiHome TV di rumah Anda</p>

              <div class="form-group row">

                <div class="col-lg-12">

                  <input type="submit" class="btn btn-primary btn-lg btn-block" id="submit" name="submit" style="color: #fff;" value="DAFTAR">

                </div>

              </div>

            </div>

          </form>

        </div>

        

      </div>

    </div>

  </div>

<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<link href="{{ asset('backend/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('backend/loading.css') }}" rel="stylesheet">
<script src="{{ asset('backend/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/jquery.loading.js') }}"></script>
<script type="text/javascript">
    

    function getNumber(){
        $.ajax({
            url : "{{ url('mola/get') }}",
            dataType : 'JSON',
            method : 'GET',
            data : {
                'no_hp' : $("#no_hp").val()
            },
            beforeSend:function(){
                $('body').loading();
            },
            complete:function(){
                $('body').loading('stop');
            },
            success:function(res){
                if(res.status == 200){
                    $("#nd_internet").val(res.data.nd_internet)
                    $("#nama").val(res.data.nama)
                    $("#id_master").val(res.data.id)
                    $("#cwitel").val(res.data.cwitel)
                }else{
                    alert(res.message);
                }
            }
        })
    }

    function actionbutton(param){
        if(param == 1){
            $("#myModal").modal('hide')
            $("#no_hp").focus();
        }else{
            window.location.href = "{{ url('/mola/notif/3') }}";
        }
    }
    
</script>