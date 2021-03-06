<h1 class="h3 mb-2 text-gray-800">OPLANG</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Call</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <a href="{{ url('report/sukses') }}" class="btn btn-success float-right"><i class="fas fa-save"></i> Download Status Sukses</a>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>#</th>
                    <th>NOMOR INET</th>
                    <th>NOMOR HANDPHONE</th>
                    <th>NAMA PELANGGAN</th>
                    <th>STATUS</th>
                    <th>CREATED</th>
                    <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        loadData()
    });

    function loadData(){
        $('#dataTable').DataTable({
            asynchronous: true,
            processing: true, 
            destroy: true,
            ajax: {
                url: "{{ url('oplang/load') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET'
            },
            columns: [
                { name: 'id', searchable: false, orderable: true, className: 'text-center' },
                { name: 'nomor_inet' },
                { name: 'nomor_hp' },
                { name: 'nama_pelanggan' },
                { name: 'status_oplang' },
                { name: 'created' },
                { name: 'action', searchable: false, orderable: false, className: 'text-center' }
            ],
            order: [[4, 'desc']],
            iDisplayInLength: 10 
        });
    }
</script>