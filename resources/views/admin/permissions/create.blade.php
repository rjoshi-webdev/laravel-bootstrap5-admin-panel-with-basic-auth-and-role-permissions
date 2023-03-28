@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.permission.title') }} {{ trans('global.create') }}</title>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ trans('cruds.permission.title') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ trans('cruds.permission.title_singular') }} {{ trans('global.create') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn">
                        <a class="btn btn-primary" href="{{route('admin.permissions.index')}}">
                            {{ trans('global.back_to_list') }}
                        </a>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    {{-- <h6 class="mb-0 text-uppercase">{{ trans('global.create') }} </h6> --}}
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 border rounded">

                                <form class="row g-3 needs-validation" novalidate
                                    action="{{ route('admin.permissions.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title"
                                            class="form-label">{{ trans('cruds.permission.fields.title') }}*</label>

                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ old('title', isset($permission) ? $permission->title : '') }}"
                                            required>
                                        @if ($errors->has('title'))
                                            <p class="help-block text-danger">
                                                {{ $errors->first('title') }}
                                            </p>
                                        @endif
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit"
                                            value="{{ trans('global.save') }}">{{ trans('global.save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        <script>
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        </script>
    @endsection
