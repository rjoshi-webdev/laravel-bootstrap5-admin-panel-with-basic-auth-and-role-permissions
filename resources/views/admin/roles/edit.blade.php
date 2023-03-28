@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.role.title') }} </title>
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
                <div class="breadcrumb-title pe-3">{{ trans('cruds.role.title') }} </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ trans('cruds.role.title_singular') }} {{ trans('global.edit') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn">
                        <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    {{-- <h6 class="mb-0 text-uppercase"> {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }} </h6>--}}
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 border rounded">

                                <form action="{{ route('admin.roles.update', [$role->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title">{{ trans('cruds.role.fields.title') }}*</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ old('title', isset($role) ? $role->title : '') }}" required>
                                        @if ($errors->has('title'))
                                            <p class="help-block">
                                                {{ $errors->first('title') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.role.fields.title_helper') }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                        <label for="permissions">{{ trans('cruds.role.fields.permissions') }}*
                                            <span
                                                class="btn btn-outline-primary px-1  btn-sm rounded-3 select-all">{{ trans('global.select_all') }}</span>
                                            <span
                                                class="btn btn-outline-primary px-1  btn-sm rounded-3 deselect-all">{{ trans('global.deselect_all') }}</span></label>
                                        <select name="permissions[]" id="permissions" class="form-control multiple-select"
                                            multiple="multiple" required>
                                            @foreach ($permissions as $id => $permissions)
                                                <option value="{{ $id }}"
                                                    {{ in_array($id, old('permissions', [])) || (isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                                    {{ $permissions }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('permissions'))
                                            <p class="help-block">
                                                {{ $errors->first('permissions') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.role.fields.permissions_helper') }}
                                        </p>
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
        <script>
            $('.select-all').click(function() {
                $('#permissions option').attr("selected", "selected");
                $('.multiple-select').select2();
            });

            $('.deselect-all').click(function() {
                $('#permissions option').removeAttr("selected");
                $('.multiple-select').select2();
            });
        </script>
    @endsection
