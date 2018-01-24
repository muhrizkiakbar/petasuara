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
                                <h3 class="box-title">Manajemen User</h3>
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
                                            <th>Username</th>
                                            <th>No. KTP</th>
                                            <th>Nama</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th>Lokasi</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
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
                                <h4 class="modal-title">Manajemen User</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                <form id="formuseradd" action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input id="username" name="username" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="password" name="password" class="form-control pull-right" type="password">
                                            </div>
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control select2" id="role_id" name="role_id" style="width: 100%;">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->namarole}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>No. KTP</label>
                                                <input id="noktpuser" name="noktpuser" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input id="namauser" name="namauser" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No. HP</label>
                                                <input id="nohpuser" name="nohpuser" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input id="alamatuser" name="alamatuser" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group" >
                                                <label>TPS</label>
                                                <select class="form-control select2" id="tps_id" name="tps_id" style="width: 100%;">
                                                    @foreach($tps as $tp)
                                                        <option value="{{$tp->id}}">{{$tp->namakabupaten}} - {{$tp->namakecamatan}} - {{$tp->namadesas}} - {{$tp->namatps}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="simpanadduser" class="btn btn-primary">Simpan</button>
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
                                <h4 class="modal-title">Edit User</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error alert-danger alert-dismissible">
                                </div>
                                <form id="formedituser" action="" method="post" role="form" enctype="multipart/form-data">
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input id="username2" name="username2" class="form-control pull-right" type="text">
                                            </div>
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control select2" id="role_id2" name="role_id2" style="width: 100%;">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->namarole}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>No. KTP</label>
                                                <input id="noktpuser2" name="noktpuser2" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input id="namauser2" name="namauser2" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>No. HP</label>
                                                <input id="nohpuser2" name="nohpuser2" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input id="alamatuser2" name="alamatuser2" class="form-control pull-right" type="text">
                                            </div>
                                            <div class="form-group" >
                                                <label>TPS</label>
                                                <select class="form-control select2" id="tps_id2" name="tps_id2" style="width: 100%;">
                                                    @foreach($tps as $tp)
                                                        <option value="{{$tp->id}}">{{$tp->namakabupaten}} - {{$tp->namakecamatan}} - {{$tp->namadesas}} - {{$tp->namatps}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="simpanedituser" class="btn btn-outline">Save changes</button>
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
                                <h4 class="modal-title">Hapus User</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formdeleteuser" action="" method="post" role="form" enctype="multipart/form-data">
                                    <h4>
                                        <i class="icon fa fa-ban"></i>
                                        Peringatan
                                    </h4>
                                    {{csrf_field()}}
                                    Yakin ingin menghapus user <span class="labelusername"></span>?
                                    <input id="deliduser" name="deliduser" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" id="simpandeluser" class="btn btn-outline">Simpan</button>
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
        <!-- /.content-wrapper -->

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
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tableaja').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datauser')}}',
                columns: [
                    { data: 'username', name: 'username' },
                    { data: 'noktpuser', name: 'noktpuser' },
                    { data: 'namauser', name: 'namauser' },
                    { data: 'nohpuser', name: 'nohpuser' },
                    { data: 'alamatuser', name: 'alamatuser' },
                    { data: 'lokasi', name: 'lokasi' },
                    { data: 'namarole', name: 'namarole' },
                    {data:'action'}
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','#modal_add2',function () {
            $('#username').val("");
            $('#username').removeAttr('disabled');
            $('#noktpuser').removeAttr('disabled');
            $('#namauser').val("");
            $('#nohpuser').val("");
            $('#alamatuser').val("");
            $('#tps_id').val("");
            $('#role_id').val("");
            $('#modal_add').modal("show");
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','.modal_edit',function () {
            $('#username2').val($(this).data('username'));
            $('#username2').attr('disabled','true');
            $('#namauser2').val($(this).data('namauser'));
            $('#nohpuser2').val($(this).data('nohpuser'));
            $('#noktpuser2').val($(this).data('noktpuser'));
            $('#alamatuser2').val($(this).data('alamatuser'));
            $('#role_id2').val($(this).data('role_id'));
            $('#tps_id2').val($(this).data('tps_id'));
            $('#iduser2').val($(this).data('id'));
            $('#modal_edit').modal("show");
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','.modal_delete',function () {
            $('#deliduser').val($(this).data('id'));
            $('.labelusername').text($(this).data('username'));
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','#simpanadduser',function (){
            $.ajax({
                type:'post',
                url:'{{route('adduser')}}',
                data: new FormData($('#formuseradd')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(response.errors.username);
                        $('.error').text(response.errors.email);
                        $('.error').text(response.errors.password);
                        $('.error').text(response.errors.name);
                        $('.error').text(response.errors.selectrole);
                        $('.error').text(response.errors.selectinstansi);
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
    {{--post edit--}}
    <script type="text/javascript">
        $(document).on('click','#simpanedituser',function (){
            $.ajax({
                type:'post',
                url:'{{route('edituser')}}',
                data: new FormData($('#formedituser')[0]),
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if((response.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(response.errors.name);
                        $('.error').text(response.errors.password);
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
    {{--post delete--}}
    <script type="text/javascript">
        $(document).on('click','#simpandeluser',function (){
            $.ajax({
                type:'post',
                url:'{{route('deleteuser')}}',
                data: new FormData($('#formdeleteuser')[0]),
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
