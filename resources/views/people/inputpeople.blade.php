@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush
@section('body')
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Main content -->
                <section class="content">
    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Pemilih</h3>
                                </div>
                                <div class="box-body">
                                    <button type="button" id="modal_add2" class="btn btn-primary" data-toggle="modal" data-target="#modal_add">
                                        Tambah
                                    </button>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="tableaja" class="table">
                                            <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. KTP</th>
                                                <th>No. Hp</th>
                                                <th>Pilih</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="modal fade" id="modal_add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Input Data Pemilih</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error alert-danger alert-dismissible">
                                    </div>
                                    <form id="formpeopleadd" action="" method="post" role="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{csrf_field()}}
                                                <!-- input nama -->
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama ...">
                                                </div>
                        
                                                <!--  input alamat  -->
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."></textarea>
                                                </div>
                        
                                                <!-- input nomor ktp -->
                                                <div class="form-group">
                                                    <label>No.KTP</label>
                                                    <input type="text" id="noktp" name="noktp" class="form-control" placeholder="No.KTP ...">
                                                </div>
                        
                                                <!-- input nomor hp -->
                                                <div class="form-group">
                                                    <label>Nomor Telepon</label>
                                                    <input type="text" id="nohp" name="nohp" class="form-control" placeholder="Nomor Telepon ...">
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                    <button type="button" id="simpanaddpeople" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
    
                    <div class="modal modal-warning fade" id="modal_edit">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Data Pemilih</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error alert-danger alert-dismissible">
                                    </div>
                                    <form id="formeditpeople" action="" method="post" role="form" enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-12">
                                                {{csrf_field()}}
                                                <!-- input nama -->
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" id="namaedit" name="namaedit" class="form-control" placeholder="Nama ...">
                                                </div>
                        
                                                <!--  input alamat  -->
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" id="alamatedit" name="alamatedit" rows="3" placeholder="Alamat ..."></textarea>
                                                </div>
                        
                                                <!-- input nomor ktp -->
                                                <div class="form-group">
                                                    <label>No.KTP</label>
                                                    <input type="text" id="noktpedit" name="noktpedit" class="form-control" placeholder="No.KTP ...">
                                                </div>
                        
                                                <!-- input nomor hp -->
                                                <div class="form-group">
                                                    <label>Nomor Telepon</label>
                                                    <input type="text" id="nohpedit" name="nohpedit" class="form-control" placeholder="Nomor Telepon ...">
                                                </div>
                                                <input id="idpeople" name="idpeople" type="hidden">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                                    <button type="button" id="simpaneditpeople" class="btn btn-outline">Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
    
                    <div class="modal modal-danger fade" id="modal_delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Hapus Data Pemilih</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="formdeletepeople" action="" method="post" role="form" enctype="multipart/form-data">
                                        <h4>
                                            <i class="icon fa fa-ban"></i>
                                            Peringatan
                                        </h4>
                                        {{csrf_field()}}
                                        Yakin ingin menghapus <span class="labelpeoplenama"></span>?
                                        <input id="delidpeople" name="delidpeople" type="hidden">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                                    <button type="button" id="simpandelpeople" class="btn btn-outline">Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </section>
                <!-- /.content -->
            </div>

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    
    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>

    {{--  Load Data Table --}}
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tableaja').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datapeople')}}',
                columns: [
                    { data: 'nama', name: 'nama' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'noktp', name: 'noktp' },
                    { data: 'nohp', name: 'nohp' },
                    {data:'action'}
                ]
            });
        });
    </script>


    {{-- Load Edit Data  --}}
    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#namaedit').val($(this).data('nama'));
            $('#noktpedit').val($(this).data('noktp'));
            $('#alamatedit').val($(this).data('alamat'));
            $('#nohpedit').val($(this).data('nohp'));
            $('#idpeople').val($(this).data('id'));
            $('#modal_edit').modal("show");
        });
    </script>

    {{--  Load Delete Data  --}}
    <script type="text/javascript">
        $(document).on('click','.modal_delete',function () {
            $('#delidpeople').val($(this).data('id'));
            $('.labelpeoplenama').text($(this).data('nama'));
        });
    </script>

    {{--  Submit New Data  --}}
    <script type="text/javascript">
        $(document).on('click','#simpanaddpeople',function (){
            $.ajax({
                type:'post',
                url:'{{route('addpeople')}}',
                data: new FormData($('#formpeopleadd')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(response.errors.nama);
                        $('.error').text(response.errors.alamat);
                        $('.error').text(response.errors.noktp);
                        $('.error').text(response.errors.nohp);
                    }
                    else
                    {
                        $('.error').addClass('hidden');
                        $('#modal_add').modal('hide');
                        oTable.ajax.reload();
                    }
                },
            });
        });
    </script>

    {{--  Submit Edit  --}}
    <script type="text/javascript">
        $(document).on('click','#simpaneditpeople',function (){
            $.ajax({
                type:'post',
                url:'{{route('editpeople')}}',
                data: new FormData($('#formeditpeople')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(response.errors.nama);
                        $('.error').text(response.errors.alamat);
                        $('.error').text(response.errors.noktp);
                        $('.error').text(response.errors.nohp);
                    }
                    else
                    {
                        $('.error').addClass('hidden');
                        $('#modal_edit').modal('hide');
                        oTable.ajax.reload();
                    }
                },
            });
        });
    </script>

    {{--Submit Delete--}}
    <script type="text/javascript">
        $(document).on('click','#simpandelpeople',function (){
            $.ajax({
                type:'post',
                url:'{{route('deletepeople')}}',
                data: new FormData($('#formdeletepeople')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    $('.error').addClass('hidden');
                    $('#modal_delete').modal('hide');
                    oTable.ajax.reload();
                },
            });
        });
    </script>
    </body>
@endsection
