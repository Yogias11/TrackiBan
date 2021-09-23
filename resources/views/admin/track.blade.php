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
        <form action="{{ route('track.store') }}" class="form-horizontal" method="POST">
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
                        <label class="col-sm-3 control-label">Roda <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="roda_id" id="roda_id" class="form-control">

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

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kontainer <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="kontainer" class="form-control" placeholder="eg.: John Doe" required/>
                            <span class="help">Kontainer</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Posisi <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="posisi" class="form-control" placeholder="eg.: John Doe" required/>
                            <span class="help">Posisi Roda</span>
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
                            <th>Roda <br>
                                (Posisi - No Seri)</th>
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
                                <td>
                                    @if ($t->jenis == 0)
                                        <p>Roda</p>
                                    @else
                                        <p>Kontainer</p>
                                    @endif
                                </td>
                                <td>{{ $t->kendaraan->nopol }}</td>
                                <td>{{ $t->ban->posisi }} - {{ $t->ban->no_seri }}</td>
                                <td>{{ $t->kontainer }}</td>
                                <td>{{ $t->posisi }}</td>
                                <td>{{ number_format($t->jarak) }} M</td>
                                <td>
                                    <form action="{{ route('track.destroy', $t->id) }}" method="POST">
                                        <a href="{{ route('showId', $t->id) }}" class="btn btn-info btn-xs"><span
                                            class="fa fa-eye"></span></a>
                                        <a href="{{ route('track.edit', $t->id) }}" class="btn btn-warning btn-xs"><span
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

{{-- <div class="row">
    <div class="col-md-6">
        <form action="{{ route('vehicle.store') }}" class="form-horizontal" method="POST">
            @csrf
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Tambah</h2>

                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kendaraan <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="vehicle_id" id="vehicle_id">
                                @forelse ($vehicle as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                                @empty
                                <option value="#">Tidak Ada Data</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="jenis" id="jenis">
                                <option value="">-- Choose --</option>
                                <option value="0">Roda</option>
                                <option value="1">Kontainer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="eg.: John Doe" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">NOPOL <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nopol" class="form-control" placeholder="eg.: John Doe" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah Roda <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" name="jml_roda" class="form-control" placeholder="eg.: John Doe" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table" id="dynamicAddRemove">

                                <td><input type="text" name="no_seri[0][subject]" placeholder="Enter subject" class="form-control" /></td>
                                <td><input type="text" name="no_seri[0][subject]" placeholder="Enter subject" class="form-control" /></td>
                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary"><span class="fa fa-plus"></span></button></td>

                        </table>

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
</div> --}}
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
