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
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('kontainer.post') }}" class="form-horizontal" method="POST">
            @csrf
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Tracking Roda by Kontainer</h2>

                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kendaraan <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                <option value="">Select</option>
                                @forelse ($vehicle as $id => $nopol)
                                <option value="{{ $id }}">{{ $nopol }}</option>
                                @empty
                                <option value="#">Tidak Ada Data</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kontainer <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="kontainer" id="kontainer" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jarak <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="jarak" class="form-control" placeholder="eg.: 1000" required/>
                            <span class="help">Satuan /m</span>
                        </div>
                    </div>

                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span></button>
                            <button type="reset" class="btn btn-default"><span class="fa fa-refresh"></span></button>
                        </div>
                    </div>
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

                <h2 class="panel-title">Basic</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped mb-none" id="example1">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Jenis Tracking</th>
                            <th>NOPOL</th>
                            <th>Kontainer</th>
                            <th>Posisi</th>
                            <th>Jarak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($track as $t)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>Kontainer</td>
                                <td>{{ $t->kendaraan->nopol }}</td>
                                <td>{{ $t->kontainer }}</td>
                                <td>{{ $t->posisi1->nopol }}</td>
                                <td>{{ number_format($t->jarak) }} M</td>
                                <td>
                                    <form action="{{ route('kontainer.edit', $t->id) }}" method="POST">
                                        <a href="{{ route('showId', $t->id) }}" class="btn btn-info btn-xs"><span
                                            class="fa fa-eye"></span></a>
                                        <a href="{{ route('kontainer.edit', $t->id) }}" class="btn btn-warning btn-xs"><span
                                            class="fa fa-edit"></span></a>
                                        @csrf
                                        @method('DELETE')
                                       <button type="submit" class="btn btn-danger btn-xs"><span
                                        class="fa fa-trash-o"></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</div>

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
                    url: '{{ url('getKontainer') }}/'+vehicleId,
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        if(res) {
                            console.log(res);
                            $("#kontainer").empty();
                            $("#kontainer").append('<option value="">-- Choose Kontainer--</option>');
                            $.each(res, function(key, value) {
                                $("#kontainer").append('<option value="'+key+'">'+value+'</option');
                            });
                        } else {
                            $("#kontainer").empty();
                        }
                    }
                });
            }
        });
    // });
</script>
@endpush
