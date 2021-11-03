<div style="margin:10px">
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

@if (request()->segment(3) == 3)
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Terimakasih!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
</div>