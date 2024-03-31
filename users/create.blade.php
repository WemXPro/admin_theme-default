@extends(AdminTheme::wrapper(), ['title' => 'Create User', 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">
@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
        <div class="row">
            <div class="col-12">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                        <div class="card-header">
                            <h4>User Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="first_name">{!! __('admin.first_name') !!}</label>
                                    <input type="text" name="first_name" id="first_name"
                                        class="form-control" value="{{ old('first_name') }}" placeholder="{!! __('admin.first_name') !!}"
                                        required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">{!! __('admin.last_name') !!}</label>
                                    <input type="text" name="last_name" id="last_name"
                                        class="form-control" value="{{ old('last_name') }}" placeholder="{!! __('admin.last_name') !!}"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="username">{!! __('admin.username') !!}</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control" value="{{ old('username') }}" placeholder="{!! __('admin.username') !!}"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">{!! __('admin.email') !!}</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control" value="{{ old('email') }}" placeholder="{!! __('admin.email') !!}"
                                        required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="password">{!! __('admin.password') !!}</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control" value="{{ old('password') }}" placeholder="{!! __('admin.password') !!}">
                                    <small>Leave empty to generate a random password that will be emailed to the user</small>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{!! __('admin.groups') !!}</label>
                                    <select
                                        class="form-control select2 select2-hidden-accessible  @error('groups') is-invalid @enderror"
                                        name="groups[]" multiple="" tabindex="-1" aria-hidden="true">
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="verify_email" checked class="custom-control-input" id="verify_email">
                                        <label class="custom-control-label" for="newsletter">
                                            Verify Email
                                        </label>
                                        <div class="text-muted form-text">
                                            If checked, the email address will be verfied and the user will be able to login
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Address (Optional)</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="company_name">{!! __('admin.company_name') !!}</label>
                                <input type="text" name="company_name" id="company_name"
                                    class="form-control" value="{{ old('company_name') }}" placeholder="{!! __('admin.company_name') !!}">
                            </div>
                            <div class="form-group col-12">
                                <label for="address">{!! __('admin.street') !!}</label>
                                <input type="text" name="street" id="street"
                                    class="form-control" value="{{ old('street') }}" placeholder="{!! __('admin.street') !!}">
                            </div>
                            <div class="form-group col-12">
                                <label for="address_2">{!! __('admin.street_2') !!}</label>
                                <input type="text" name="street_2" id="street_2"
                                    class="form-control" value="{{ old('street_2') }}" placeholder="{!! __('admin.street_2') !!}">
                            </div>
                            <div class="form-group col-md-3 col-6">
                                <label for="zip_code">{!! __('admin.zip_code') !!}</label>
                                <input type="text" name="zip_code" id="zip_code"
                                    class="form-control" value="{{ old('zip_code') }}" placeholder="{!! __('admin.zip_code') !!}">
                            </div>
                            <div class="form-group col-md-3 col-6">
                                <label for="city">{!! __('admin.city') !!}</label>
                                <input type="text" name="city" id="city"
                                    class="form-control" value="{{ old('city') }}" placeholder="{!! __('admin.city') !!}">
                            </div>
                            <div class="form-group col-md-3 col-6">
                                <label for="province_state">{!! __('admin.province_state') !!}</label>
                                <input type="text" name="region" id="region"
                                    class="form-control" value="{{ old('province_state') }}" placeholder="{!! __('admin.province_state') !!}">
                            </div>
                            <div class="form-group col-md-3 col-6">
                                <label for="inputState">{!! __('admin.country') !!} *</label>
                                <select id="inputState" name="country"
                                        class="form-control select2 select2-hidden-accessible">
                                    @foreach(config('utils.countries') as $key => $country)
                                        <option value="{{$key}}" @if($user->address->country ?? '' == $key) selected @endif>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card">
                <div class="card-footer text-right">
                    <button class="btn btn-success" type="submit">{!! __('admin.create') !!}</button>
                </div>
            </div>
            </form>
            </div>
        </div>
@endsection
