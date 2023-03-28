@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.user.title') }} </title>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ trans('cruds.user.title') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.user.title') }} {{ trans('global.list') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="">
                        @can('user_create')
                            <div style="margin-bottom: 10px;" class="row">
                                <div class="col-lg-12">
                                    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                                        {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                                    </a>
                                </div>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            {{-- <h6 class="mb-0 text-uppercase"> {{ trans('cruds.user.title') }} {{ trans('global.list') }}</h6> --}}
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">

                                        <td>
                                            {{ $user->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email_verified_at ?? '' }}
                                        </td>
                                        <td>
                                            @foreach ($user->roles as $key => $item)
                                                <span class="">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('user_show')
                                                <a class="btn btn-outline-primary px-1 radius-10 btn-sm"
                                                    href="{{ route('admin.users.show', $user->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('user_edit')
                                                <a class="btn btn-outline-info px-1 radius-10 btn-sm"
                                                    href="{{ route('admin.users.edit', $user->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('user_delete')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    id="user_delete" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit"
                                                        class="btn btn-outline-danger px-1 radius-10 btn-sm user_delete "
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
    <!--end page wrapper -->
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

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
        $('.user_delete').on('click', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal.fire({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    // buttons: true,
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
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




{{-- 
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script> --}}
