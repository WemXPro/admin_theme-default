@extends(AdminTheme::wrapper(), ['title' => 'Create Api Key', 'keywords' => 'WemX Dashboard, WemX Panel'])

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
            <form action="{{ route('api-v1.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                        <div class="card-header">
                            <h4>Create Api Token</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="description">{!! __('admin.description') !!}</label>
                                    <input type="text" name="description" id="description"
                                        class="form-control" value="{{ old('description') }}"
                                        required>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label for="full_access">Full Access</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="full_access"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="0">
                                            No, only allow access to the selected permissions
                                        </option>
                                        <option value="1">
                                            Yes, allow access to all permissions
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label for="allowed_ips">Allowed IPs</label>
                                    <textarea class="form-control" name="allowed_ips" id="allowed_ips">{{ old('allowed_ips') }}</textarea>
                                    <small class="mt-1">Separate each IP with a comma, leave empty to allow connections from anywhere</small>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label for="description">Expires At</label>
                                    <input type="date" name="expires_at" id="expires_at"
                                        class="form-control" value="{{ old('expires_at') }}">
                                    <small class="mt-1">Leave empty if you don't wish for the token to expire</small>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success" type="submit">{!! __('admin.create') !!}</button>
                        </div>
                </div>
            </form>
            </div>
        </div>
@endsection
