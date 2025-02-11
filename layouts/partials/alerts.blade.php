@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <a href="#" style="background: #0000003d;" class="badge badge-danger">
                <i class="fas fa-solid fa-bell" style="margin-left: 0px"></i>
            </a>
            {!! $error !!}
        </div>
    @endforeach
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <a href="#" style="background: #0000003d;" class="badge badge-success">
            <i class="fas fa-solid fa-bell" style="margin-left: 0px"></i>
        </a>
        {!! session('success') !!}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <a href="#" style="background: #0000003d;" class="badge badge-danger">
            <i class="fas fa-solid fa-bell" style="margin-left: 0px"></i>
        </a>
        {!! session('error') !!}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning">
        <a href="#" style="background: #0000003d;" class="badge badge-warning">
            <i class="fas fa-solid fa-bell" style="margin-left: 0px"></i>
        </a>
        {!! session('warning') !!}
    </div>
@endif

@if(Settings::get('maintenance') === 'true' && Auth::user() && Auth::user()->is_admin())
    <div class="alert alert-warning">
        <div class="alert-title">{!! __('admin.maintenance') !!}</div>
        {!! __('admin.maintenance_mode_desc') !!}
        <a href="/admin/settings/store?maintenance=false" class="btn btn-icon icon-left btn-primary ml-2">
            <i class="fas fa-exclamation-triangle"></i>
            {!! __('admin.maintenance_disable_button') !!}
        </a>
    </div>
@endif

@if(version_compare(PHP_VERSION, '8.2', '<'))
    <div class="alert alert-danger" role="alert">
        You use an outdated PHP version: <code>{{ PHP_VERSION }}</code>.
        Please upgrade to PHP <code>8.2</code> or higher. <br><br>
        <a href="https://docs.wemx.net/en/project/upgrade-php-83" target="_blank"
           class="btn btn-primary btn-sm">
            PHP Upgrade Instructions
        </a>
    </div>
@endif

@if(!config('laravelcloudflare.enabled') && request()->header('cf-ipcountry'))
    <div class="alert alert-danger" role="alert">
        {!! __('admin.enable_cloudflare_proxy_integration') !!}
    </div>
@endif

@if(!Cache::has('cron_active'))
    <div class="alert alert-danger" role="alert">
        {!! __('admin.cronjobs_are_not_running_add_php_artisan_scheduler', ['base_path' => base_path()]) !!}
    </div>
@endif

@if(!Cache::has('queue_active'))
    <div class="alert alert-danger" role="alert">
        {!! __('admin.queue_worker_not_setup') !!}
    </div>
@endif

@if(config('app.debug') && config('app.version') !== 'dev')
    <div class="alert alert-warning" role="alert">
        {!! __('admin.disable_debug_mode_immediately_if_your_application', ['base_path' => base_path('.env')]) !!}
    </div>
@endif
