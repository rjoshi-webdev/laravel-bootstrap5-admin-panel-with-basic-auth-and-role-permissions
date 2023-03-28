@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.role.title') }} </title>
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
                <div class="breadcrumb-title pe-3">{{ trans('cruds.role.title') }} </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.role.title') }} {{ trans('global.list') }} </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                    @can('role_create')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="{{ route('admin.roles.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                                </a>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
            <!--end breadcrumb-->


            {{-- <h6 class="mb-0 text-uppercase">{{ trans('cruds.role.title') }}   {{ trans('global.list') }} </h6> --}}
            <hr />
            <div class="card">
                <div class="card-body mb-2">
                    <div class="table-responsive">
                        <table id="role_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('cruds.role.fields.id') }}</th>
                                    <th>{{ trans('cruds.role.fields.title') }}</th>
                                    <th>{{ trans('cruds.role.fields.permissions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($roles as $key => $role)
                                <tr data-entry-id="{{ $role->id }}">

                                    <td>
                                        {{ $role->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $role->title ?? '' }}
                                    </td>
                                    <td>
                                        @foreach ($role->permissions as $key => $item)
                                            <span class="badge bg-primary">{{ $item->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('role_show')
                                            <a class="btn btn-outline-primary px-1 radius-10 btn-sm"
                                                href="{{ route('admin.roles.show', $role->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan

                                        @can('role_edit')
                                            <a class="btn btn-outline-info px-1 radius-10 btn-sm"
                                                href="{{ route('admin.roles.edit', $role->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('role_delete')
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit"
                                                    class="btn btn-outline-danger px-1 radius-10 btn-sm role_delete"
                                                    value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan

                                    </td>

                                </tr>
                                @endforeach
                                </tr>

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

    @parent
    {{-- <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('role_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.roles.massDestroy') }}",
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
            $('.datatable-Role:not(.ajaxTable)').DataTable({
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
            var table = $('#role_table').DataTable({
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $('.role_delete').on('click', function(event) {
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
