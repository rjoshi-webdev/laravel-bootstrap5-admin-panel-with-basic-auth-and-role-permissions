@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.permission.title') }} </title>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"> {{ trans('cruds.permission.title') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.permission.title') }} {{ trans('global.list') }}</li>
                        </ol>
                    </nav>
                </div>

                @can('permission_create')
                    <div class="ms-auto">
                        <div class="btn-group">
                            <a type="button" class="btn btn-primary"
                                href="{{ route('admin.permissions.create') }}">{{ trans('global.add') }}
                                {{ trans('cruds.permission.title_singular') }}</a>

                        </div>
                    </div>
                @endcan
            </div>
            <!--end breadcrumb-->

            {{-- <h6 class="mb-0 text-uppercase"> {{ trans('cruds.permission.title') }} {{ trans('global.list') }}</h6> --}}
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> {{ trans('cruds.permission.fields.id') }}</th>
                                    <th>{{ trans('cruds.permission.fields.title') }}</th>
                                    <th>Operations</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                    <tr data-entry-id="{{ $permission->id }}">

                                        <td> {{ $permission->id ?? '' }}</td>
                                        <td>{{ $permission->title ?? '' }}</td>
                                        <td>
                                            @can('permission_show')
                                                <a class="btn btn-outline-primary px-1 radius-10 btn-sm"
                                                    href="{{ route('admin.permissions.show', $permission->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('permission_edit')
                                                <a class="btn btn-outline-info px-1 radius-10 btn-sm"
                                                    href="{{ route('admin.permissions.edit', $permission->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('permission_delete')
                                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                    method="POST"                                                   
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-outline-danger px-1 radius-10 btn-sm permission_delete"
                                                        value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    @parent
    {{-- <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('permission_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.permissions.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Permission:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#user_table').DataTable({
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $('.permission_delete').on('click', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal.fire({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    dangerMode: true,
                    confirmButtonColor: '#d33',
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
