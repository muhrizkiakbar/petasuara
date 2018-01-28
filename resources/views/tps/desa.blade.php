@extends('layouts.app')

@push('style')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
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
                <!-- Atur Jadwal Kerja -->
                
                <!-- /.box -->

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Desa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/desa/edit" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Desa</label>
                                        <input type="text" hidden id="id" name="id" value="{{encrypt($desa->id)}}">
                                        <input id="namadesas" name="namadesas" value="{{$desa->namadesas}}" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control select2" id="kecamatan_id" name="kecamatan_id" value="{{$desa->kecamatan_id}}" style="width: 100%;">
                                            @foreach($kecamatans as $kecamatan)
                                                <option value="{{$kecamatan->id}}">{{$kecamatan->namakecamatan}}</option>
                                            @endforeach
                                        </select>
                                        {{csrf_field()}}
                                    </div>
                                    
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.col -->
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->


                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

                @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->

    <!-- Select2 -->
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- bootstrap time picker -->
    <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tablekabupaten').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datakabupaten')}}',
                columns: [
                    { data: 'namakabupaten', name: 'namakabupaten' },
                    {data:'action'}
                ]
            });
        });
    </script>

    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tablekecamatan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datakecamatan')}}',
                columns: [
                    { data: 'namakabupaten', name: 'namakabupaten' },
                    { data: 'namakecamatan', name: 'namakecamatan' },
                    {data:'action'}
                ]
            });
        });
    </script>
    
    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabledesa').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datadesa')}}',
                columns: [
                    { data: 'namakabupaten', name: 'namakabupaten' },
                    { data: 'namakecamatan', name: 'namakecamatan' },
                    { data: 'namadesas', name: 'namadesas' },
                    {data:'action'}
                ]
            });
        });
    </script>

<script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#tabletps').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('datatps')}}',
                columns: [
                    { data: 'namakabupaten', name: 'namakabupaten' },
                    { data: 'namakecamatan', name: 'namakecamatan' },
                    { data: 'namadesas', name: 'namadesas' },
                    { data: 'namatps', name: 'namatps' },
                    {data:'action'}
                ]
            });
        });
    </script>


    </body>
@endsection
