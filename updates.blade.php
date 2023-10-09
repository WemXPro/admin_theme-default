@extends(AdminTheme::wrapper(), ['title' => 'Updates', 'keywords' => 'WemX Updates, WemX Panel'])

@section('container')
<div class="card mb-6">
    @if(config('app.version') >= $latest_version->version)
    <div class="card-body">
        <div class="empty-state" data-height="400" style="height: 400px;">
            <div class="empty-state-icon" style="background-color: #059669;">
              <i class="fas fa-check"></i>
            </div>
            <h2>You can running the latest version ({{config('app.version')}})</h2>
            <p class="lead">
              Your WemX application is up-to-date! New updates will appear here.
            </p>
            <a href="https://wemx.net/news" target="_blank" class="btn btn-success mt-4">Latest News</a>
            <a href="{{ route('updates.index') }}" class="mt-4 bb">Refresh</a>
          </div>
    </div>
    @else
    <div class="card-body">
      <div class="empty-state" data-height="400" style="height: 400px;">
          <div class="empty-state-icon" style="background-color: #059669; display: flex; justify-content: center; align-items: center">
            <i class="fas fa-download"></i>
            {{-- <img src="/assets/src/spinners/blocks.svg" style="width: 50px;"> --}}
          </div>
          <h2>Update Available</h2>
          <p class="lead">
           You are running an outdated version of WemX
          </p>
          <a href="{{ route('updates.install', ['version' => $latest_version->version, 'type' => 'dev']) }}" class="btn btn-success mt-4">Install v{{ $latest_version->version }}</a>
          <a href="https://wemx.net/news" target="_blank" class="mt-4 bb">View Changelog</a>
        </div>
    </div>
    @endif
</div>

<div class="card">
    <div class="card-body">
        @foreach($versions as $version)
        <div class="media mb-4">
            <img class="mr-3" src="https://imgur.com/oJDxg2r.png" alt="wemx logo" style="width: 46px; height: 46px; border-radius: 10px">
            <div class="media-body">
              <h5 class="mt-0">Version {{ $version->version }} ({{ $version->type }})</h5>
              <p class="mb-0">
                {!! $version->changelog ?? 'No changelog provided' !!}
              </p>
              <small>{{ Carbon::parse($version->created_at)->diffForHumans() }} ({{ Carbon::parse($version->created_at)->format('d M Y') }})</small>
            </div>
            @if(config('app.version') == $version->version)
              <a href="#" class="btn btn-success mt-4 disabled">Installed</a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
