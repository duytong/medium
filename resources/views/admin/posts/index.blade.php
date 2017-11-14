@extends('admin.layouts.app')
@section('title', 'Posts')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Posts</li>
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
                                <th>Title</th>
                                <th>Image</th>
                                <th>Author</th>
                                <th>Topic</th>
                                <th>View</th>
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
                ajax: "{{ route('posts.data') }}",
                columns: [
                    {data: 'title', name: 'posts.title'},
                    {data: 'image'},
                    {data: 'author', name: 'users.name'},
                    {data: 'topic', name: 'topics.name'},
                    {data: 'view'},
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

        // Confirm delete
        $(document).on('click', '.link-delete', function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            $('#confirm').modal().on('click', '.btn-delete', function () {
                window.location = href;
            });
        });
    </script>
@endsection