@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Laporan</h3>


        </div>

        



    <div class="box col-md-6">


    <!-- /.box-header -->
        <div class="box-body">
            <h3>Laporan Produk Masuk</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Filter Tanggal:</label>
                        <input data-date-format='yyyy-mm' type="text" class="form-control" id="tanggal" name="tanggal">
                    </div>
                </div>
            </div>
            <table id="invoice" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Products</th>
                        <th>Supplier</th>
                        <th>QTY</th>
                        <th>Tanggal Pembelian</th>
                        <th>Export Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($invoice_data as $i)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $i->product->nama }}</td>
                            <td>{{ $i->supplier->nama }}</td>
                            <td>{{ $i->qty }}</td>
                            <td>{{ $i->tanggal }}</td>
                            <td>
                                <a href="{{ route('exportPDF.productMasuk', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Export PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

        <br>
        <div class="box-body">
            <h3>Laporan Produk Keluar</h3>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal">Filter Tanggal:</label>
                    <input data-date-format='yyyy-mm' type="text" class="form-control" id="tanggal2" name="tanggal" required>
                </div>
            </div>
            <table id="invoice2" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Products</th>
                    <th>Customer</th>
                    <th>QTY</th>
                    <th>Tanggal Pembelian</th>
                    <th>Export Invoice</th>
                </tr>
                </thead>
                @php
                    $no = 1; 
                @endphp
                @foreach($invoice_data2 as $i)
                    <tbody>
                        <td>{{ $no++ }}</td>
                        <td>{{ $i->product->nama }}</td>
                        <td>{{ $i->customer->nama }}</td>
                        <td>{{ $i->qty }}</td>
                        <td>{{ $i->tanggal }}</td>
                        <td>
                            <a href="{{ route('exportPDF.productKeluar', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Export PDF</a>
                        </td>
                    </tbody>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>


@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>


    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script>
        $(document).ready(function() {
        $('#tanggal').datepicker({
            autoclose: true,
            format: 'yyyy-mm',
            minViewMode: 'months'
        });

        $('#tanggal').change(function() {
            $('#invoice tbody').empty();
            var tanggal = $(this).val();
            $.ajax({
                url: "{{ route('laporan.getFilteredData') }}",
                type: "GET",
                data: { tanggal: tanggal },
                success: function(data) {
                   
                    $('#invoice tbody').html(data);
                }
            });
        });

        $('#tanggal2').datepicker({
            autoclose: true,
            format: 'yyyy-mm',
            minViewMode: 'months'
        });

        $('#tanggal2').change(function() {
            var tanggal = $(this).val();
            $.ajax({
                url: "{{ route('laporan.getFilteredData2') }}",
                type: "GET",
                data: { tanggal: tanggal },
                success: function(data) {
                    $('#invoice2 tbody').empty();
                    $('#invoice2 tbody').html(data);
                }
            });
        });
    });
        
    </script>

    
@endsection
