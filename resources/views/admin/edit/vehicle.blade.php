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
        <form action="{{ route('vehicle.update', $vehicle->id) }}" class="form-horizontal" method="POST">
            @csrf
            @method('PUT')
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Edit</h2>

                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="jenis_id" id="jenis_id" class="form-control">
                                @forelse ($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                                @empty
                                <option value="#">Tidak Ada Data</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="eg.: John Doe" value="{{ $vehicle->name }}" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">NOPOL <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nopol" class="form-control" placeholder="eg.: John Doe" value="{{ $vehicle->nopol }}" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah Roda <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" name="jml_roda" class="form-control" placeholder="eg.: John Doe" value="{{ $vehicle->jml_roda }}" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="btn-group-vertical">
                                <button class="btn btn-success float-right" type="button" id="add"><span class="fa fa-plus"></span></button>
                                <button class="btn btn-danger float-right" type="button" id="remove"><span class="fa fa-minus"></span></button>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            @foreach ($roda as $r)
                            <div class="input-group mb-md">
                                <div class="col-sm-4">
                                    <select name="kontainer[0]" id="kontainer" class="form-control">
                                        <option value="">Posisi Kontainer</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="no_seri[0]" placeholder="No Seri" value="{{ $r->no_seri }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="posisi[0]" placeholder="Ex: Depan Kiri" value="{{ $r->posisi }}">
                                </div>

                            </div>
                            <div id="extra-data"></div>
                            @endforeach
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

</div>
@endsection

@push('js')
<!-- Specific Page Vendor -->
<script src="{{ asset('octopus/vendor/select2/select2.js') }}"></script>
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
    $(document).ready(function() {
        var id = 0;
        $('#add').click(function() {
            id++;
            $('#extra-data').append(`
            <div class="input-group mb-md" id="data`+id+`">
            <div class="col-sm-4" >
                <select name="kontainer[`+id+`]" id="kontainer" class="form-control">
                    <option value="">Posisi Kontainer</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="no_seri[`+id+`]" placeholder="No Seri">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="posisi[`+id+`]" placeholder="Ex: Depan Kiri">
            </div>

            </div>
            `)
        })
        $('#remove').click(function() {
            $('#data' + id).remove();
            id--;
        })
    })
</script>
@endpush
