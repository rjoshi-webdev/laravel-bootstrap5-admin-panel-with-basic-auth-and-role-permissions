@extends('layouts.admin')
@section('pageTitle')
    <title>{{ trans('cruds.user.title') }} {{ trans('global.edit') }} </title>
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
                <div class="breadcrumb-title pe-3">{{ trans('cruds.user.title') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.user.title_singular') }}
                            {{ trans('global.edit') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn">
                        <a class="btn btn-primary" href="{{ route('admin.users.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    {{-- <h6 class="mb-0 text-uppercase"> {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }} --}}
                    {{-- </h6> --}}
                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 border rounded">

                                <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                                        @if ($errors->has('name'))
                                            <p class="help-block">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.name_helper') }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                                        @if ($errors->has('email'))
                                            <p class="help-block">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.email_helper') }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                        @if ($errors->has('password'))
                                            <p class="help-block">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.password_helper') }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                        <label for="roles">{{ trans('cruds.user.fields.roles') }}*
                                            <span
                                                class="btn btn-outline-primary px-1  btn-sm rounded-3 select-all">{{ trans('global.select_all') }}</span>
                                            <span
                                                class="btn btn-outline-primary px-1  btn-sm rounded-3 deselect-all">{{ trans('global.deselect_all') }}</span></label>
                                        <select name="roles[]" id="roles" class="form-control multiple-select"
                                            multiple="multiple" required>
                                            @foreach ($roles as $id => $roles)
                                                <option value="{{ $id }}"
                                                    {{ in_array($id, old('roles', [])) || (isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                                                    {{ $roles }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('roles'))
                                            <p class="help-block">
                                                {{ $errors->first('roles') }}
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.roles_helper') }}
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
                $('#roles option').attr("selected", "selected");
                $('.multiple-select').select2();
            });

            $('.deselect-all').click(function() {
                $('#roles option').removeAttr("selected");
                $('.multiple-select').select2();
            });
        </script>
    @endsection
