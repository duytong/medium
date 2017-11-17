@extends('administrator.layouts.app')
@section('title', 'Tags')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tags</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    @if (session('success'))
                        <div id="toast-container" class="toast-top-right">
                            <div class="toast toast-success" aria-live="polite">
                                <div class="toast-title">Success!</div>
                                <div class="toast-message">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif
                    <table id="datatable" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Assigned tag</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Get data via API datatables using ajax.
        $(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('tags.data') !!}',
                columns: [
                    {data: 'name', name: 'tags.name'},
                    {data: 'count', searchable: false},
                    {data: 'created_at'},
                    {data: 'actions'}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement('input');
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                    });
                }
            });
        });
    </script>
@endsection