@extends('layouts.master')
@section('title', 'Vehicle Category')
@push('css')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('octopus/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('octopus/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endpush

@section('nav-header')
<h2>Vehicle Category</h2>

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
        <form action="{{ route('vehicleCat.store') }}" class="form-horizontal" method="POST">
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
                        <label class="col-sm-3 control-label">Jenis <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" placeholder="eg.: John Doe" required/>
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

    <div class="col-md-12">
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
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($vehicle as $v)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $v->name }}</td>
                            <td>
                                <form action="{{ route('vehicleCat.destroy', $v->id) }}" method="POST">
                                    <a href="{{ route('vehicleCat.edit', $v->id) }}" class="btn btn-warning btn-sm"><span
                                        class="fa fa-edit"></span></a>
                                    @csrf
                                    @method('DELETE')
                                   <button type="submit" class="btn btn-danger btn-sm"><span
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
@endpush
