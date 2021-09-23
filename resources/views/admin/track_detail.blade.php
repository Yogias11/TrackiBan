@extends('layouts.master')
@section('title', 'Vehicle')
@push('css')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('octopus/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('octopus/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endpush

@section('nav-header')
<h2>Vehicle</h2>

<div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
        <li>
            <a href="index.html">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li><span>Vehicle</span></li>
    </ol>

    <a class="sidebar-right-toggle"></a>
</div>

@endsection

@section('content')
@foreach ($track as $h)
<div class="row">

    <div class="col-md-6">
        <form action="" class="form-horizontal" method="POST">
            @csrf
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Tracking Roda by Roda</h2>

                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="jarak" class="form-control" placeholder="eg.: 1000" value="{{ $h->kendaraan->name }}" readonly required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nopol <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="jarak" class="form-control" placeholder="eg.: 1000" value="{{ $h->kendaraan->nopol }}" readonly required/>
                        </div>
                    </div>
                </div>

                <footer class="panel-footer">

                </footer>
            </section>
        </form>
    </div>

    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title">Detail History</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped mb-none" id="example1">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Roda <br>
                                (Posisi - No Seri)</th>
                            <th>Kontainer</th>
                            <th>Posisi</th>
                            <th>Jarak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($his as $h)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->ban->posisi }} - {{ $h->ban->no_seri }}</td>
                                <td>{{ $h->kontainer }}</td>
                                <td>{{ $h->posisi }}</td>
                                <td>{{ number_format($h->jarak) }} M</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</div>
@endforeach
@endsection

@push('js')
<!-- Specific Page Vendor -->
<script src="{{ asset('octopus/vendor/select2/select2.js') }}"></script>
{{-- <script src="{{ asset('octopus/vendor/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('octopus/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('octopus/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('octopus/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

<script src="{{ asset('octopus/javascripts/tables/examples.datatables.default.js') }}"></script>
<script src="{{ asset('octopus/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
<script src="{{ asset('octopus/javascripts/tables/examples.datatables.tabletools.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>
<script>
    // $(document).ready(function() {
        $('#vehicle_id').change(function() {
            var vehicleId = $(this).val();
            if(vehicleId) {
                $.ajax({
                    url: '{{ url('getRoda') }}/'+vehicleId,
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        if(res) {
                            console.log(res);
                            $("#roda_id").empty();
                            $("#roda_id").append('<option value="">-- Choose Roda--</option>');
                            $.each(res, function(key, value) {
                                $("#roda_id").append('<option value="'+key+'">'+value+'</option');
                            });
                        } else {
                            $("#roda_id").empty();
                        }
                    }
                });
            }
        });
    // });
</script>
@endpush
