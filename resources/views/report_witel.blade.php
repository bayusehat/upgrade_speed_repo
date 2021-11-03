<style>
    .right{
        text-align: right;
    }
    #dsc{
        display: none;
    }
</style>
@php
    $tgl_report = isset($_GET['tgl_report']) ? $_GET['tgl_report'] : '';
@endphp
<h1 class="h3 mb-2 text-gray-800">REPORT WITEL</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dapros</h6>
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
            <div class="col-md-9">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Dari Tanggal</label>
                        <input type="text" class="form-control mb-2 datepicker" id="tgl_prev" name="tgl_prev" placeholder="dari Tanggal">
                    </div>
                    s./d.
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Sampai Tanggal</label>
                        <input type="text" class="form-control mb-2 datepicker" id="tgl_ke" name="tgl_ke" placeholder="ke Tanggal">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="loadData()"><i class="fa fa-search"></i> Reload</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <span class="text-danger" id="dsc">*posisi report diambil range 3 hari yang lalu dari sekarang</span>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>#</th>
                    <th>WITEL</th>
                    <th>DAPROS</th>
                    <th>AGREE</th>
                    <th>BELUM INPUT</th>
                    <th>SUKSES</th>
                    <th>ANOMALI</th>
                    <th>GAGAL</th>
                    <th>ACH</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                  <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <th class="right"></th>
                    <th class="right"></th>
                    <th class="right"></th>
                    <th class="right"></th>
                    <th class="right"></th>
                    <th class="right"></th>
                    <th class="right"></th>
                </tr>
              </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        loadData()
    });

    function loadData(){
        var tgl_now = $("#tgl_ke").val();
        var tgl_prev = $("#tgl_prev").val();
        var url_sukses = "{{ url('report/sukses') }}?tgl_ke="+tgl_now+"&tgl_prev="+tgl_prev;
        var url_anomali = "{{ url('report/anomali') }}?tgl_ke="+tgl_now+"&tgl_prev="+tgl_prev;

        if(tgl_now == ''){
            $("#dsc").show();
        }else{
            $("#dsc").hide();
        }

        $('#dataTable').DataTable({
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                var dapros = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                var agree = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                var belum_input = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                var sukses = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        var sks =  parseInt(a) + parseInt(b);
                        return sks;
                        // console.log(sks);
                        // return '<a href="'+url_sukses+'">'+sks+'</a>';
                    }, 0 );

                // var sukseshtml = api
                // .column( 5 )
                // .data()
                // .reduce( function (a, b) {
                //     var sks =  parseInt(a) + parseInt(b);
                //     // return sks;
                //     // console.log(sks);
                //     return '<a href="'+url_sukses+'">'+sks+'</a>';
                // },'0');
                    
                var anomali = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        // var hasil = intVal(a) + intVal(b);
                        return intVal(a) + intVal(b);
                        // console.log(hasil);
                        // return '<a href="{{ url("download?tipe=anomali&tgl_report='+tgl_report+'") }}">'+hasil+'</a>';
                    }, 0 );

                var gagal = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var ach_d = api
                    .column(8)
                    .data();

                var ach = agree / parseFloat(dapros) * 100;
                var sum_total_ach = ach.toFixed(2);
                
                $( api.column( 2 ).footer() ).html(numberFormat(dapros));
                $( api.column( 3 ).footer() ).html(numberFormat(agree));
                $( api.column( 4 ).footer() ).html(numberFormat(belum_input));
                $( api.column( 5 ).footer() ).html('<a href="'+url_sukses+'">'+sukses+'</a>');
                $( api.column( 6 ).footer() ).html('<a href="'+url_anomali+'">'+anomali+'</a>');
                $( api.column( 7 ).footer() ).html(numberFormat(gagal));
                $( api.column( 8 ).footer() ).html(sum_total_ach+'%');
            },
            asynchronous: true,
            processing: true, 
            destroy: true,
            ajax: {
                url: "{{ url('load_report') }}?tgl_ke="+tgl_now+"&tgl_prev="+tgl_prev,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET'
            },
            columns: [
                { name: 'id', searchable: false, orderable: true, className: 'text-center' },
                { name: 'witel'},
                { name: 'dapros', className: 'right'},
                { name: 'agree', className: 'right'},
                { name: 'belum_input', className: 'right'},
                { name: 'sukses', className: 'right'},
                { name: 'anomali', className: 'right'},
                { name: 'gagal', className: 'right'},
                { name: 'ach',className : 'right'}
            ],
            order: [[0, 'asc']],
            iDisplayInLength: 20,
            pageLength: 50,
        });
    }

    function numberFormat(nStr) {
            nStr += '';
            x = nStr.split(',');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
              x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
</script>