@extends(AdminTheme::wrapper(), ['title' => __('admin.email', ['default' => 'Emails']), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
{{--  Massive email block   --}}
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('emails.massive.send') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4>{{ __('admin.massive_email_send') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ __('admin.subject', ['default' => 'Subject']) }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ __('admin.email_content', ['default' => 'Email Content']) }}</label>
                            <div class="col-md-9">
                                <textarea class="summernote" name="body" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ __('admin.users') }}</label>
                            <div class="col-md-9">
                                <select class="form-control select2" name="users" required>
                                    <option value="all_users">{{ __('admin.all_users') }}</option>
                                    <option value="active_orders">{{ __('admin.active_orders_users') }}</option>
                                    <option value="no_orders">{{ __('admin.no_orders_users') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">{{ __('admin.send', ['default' => 'Send']) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection