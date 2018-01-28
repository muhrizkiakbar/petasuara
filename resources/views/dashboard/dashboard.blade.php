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
                                    <h3 class="box-title">Data Calon Pemilih</h3>
                                </div>
                                <div class="box-body">
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="tableaja" class="table">
                                            <thead>
                                            <tr>
                                                <th>Kota/Kabupaten</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan/Desa</th>
                                                <th>TPS</th>
                                                <th>Orang</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                ajax: '{{route('pemetaan')}}',
                columns: [
                    { data: 'namakabupaten', name: 'namakabupaten' },
                    { data: 'namakecamatan', name: 'namakecamatan' },
                    { data: 'namadesas', name: 'namadesas' },
                    { data: 'namatps', name: 'namatps' },
                    { data: 'jumlah', name: 'jumlah' }
                ]
            });
        });
    </script>

    </body>
@endsection
