@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.role.title') }} </title>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ trans('cruds.role.title') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.role.title') }} {{ trans('global.show') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="">

                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            {{-- <h6 class="mb-0 text-uppercase"> {{ trans('cruds.role.title_singular') }} {{ trans('global.show') }}</h6> --}}
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-2">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.role.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $role->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.role.fields.title') }}
                                        </th>
                                        <td>
                                            {{ $role->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Permissions
                                        </th>
                                        <td>
                                            @foreach ($role->permissions as $id => $permissions)
                                                <span class="badge rounded-pill bg-primary">{{ $permissions->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
