@extends(AdminTheme::wrapper(), ['title' => __('admin.marketplace', ['default' => 'Marketplace']), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link @if(!request()->get('category')) active @endif" href="{{ route('admin.marketplace', ['page' => request()->get('page', 1)]) }}">All Resources</a>
            </li>
            @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link @if(request()->get('category') == $category['name']) active @endif" href="{{ route('admin.marketplace', ['category' => $category['name'],'page' => request()->get('page', 1)]) }}">{{ $category['name'] }}</a>
            </li>
            @endforeach
          </ul>
    </div>
</div>

<section class="section">

<div class="row">

    <div class="col-12 mb-4" style=" display: flex; justify-content: flex-end; ">
        <div class="dropdown d-inline">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by
            </button>
            <div class="dropdown-menu mr-8" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: -100px; will-change: transform;">
                <a class="dropdown-item" href="#">Last Updated</a>
                <a class="dropdown-item" href="#">Most Downloads</a>
                <a class="dropdown-item" href="#">Most Views</a>
                <a class="dropdown-item" href="#">Oldest</a>
                <a class="dropdown-item" href="#">Newest</a>
                <a class="dropdown-item" href="#">Rating</a>
            </div>
        </div>        
    </div>

    @foreach($resources['data'] as $resource)
    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-c">
            <div class="article-header">
                <div class="article-image" data-background="{{ $resource['icon'] }}" style="background-image: url('{{ $resource['icon'] }}');"></div>
                <div class="article-badge">
                    @if($resource['is_free'])
                        <div class="article-badge-item bg-info"><i class="fas fa-cloud-download-alt"></i> FREE</div>
                    @else 
                        <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> {{ $resource['price'] }}</div>
                    @endif
                </div>
            </div>
            <div class="article-details">
                <div class="article-category">
                    <a>{{ $resource['category'] }}</a>
                    <div class="bullet"></div> <a>Posted 2 weeks ago</a></div>
                <div class="article-title">
                    <h2><a href="{{ route('admin.marketplace.view', $resource['id']) }}">{{ $resource['name'] }}</a></h2>
                </div>
                <p>{{ $resource['short_desc'] }}</p>
                <p class="text-success">Supported for your version of WemX</p>
                <div class="flex space-between align-items-end" style="display:flex">
                    <div class="article-user">
                        <img alt="image" src="{{ $resource['owner']['avatar'] }}">
                        <div class="article-user-details">
                        <div class="user-detail-name">
                            <a href="#">{{ $resource['owner']['username'] }}</a>
                        </div>
                        <div class="text-job">Author / Developer</div>
                        </div>
                    </div>
                    <div class="article-cta">
                        <a href="{{ route('admin.marketplace.view', $resource['id']) }}" class="btn btn-icon icon-left btn-primary">View Resource</a>
                    </div>
                </div>
            </div>
        </article>
    </div>
    @endforeach

</div>


</section>
@endsection
