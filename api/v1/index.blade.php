@extends(AdminTheme::wrapper(), ['title' => 'Api Keys', 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
<script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
<section class="section">
    <div class="col-12">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h4>Api Keys</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-primary">{{ __('admin.create') }}</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($apiKeys->count() == 0)
                        @includeIf(AdminTheme::path('empty-state'), ['title' => 'No Api Keys', 'description' => 'You haven\'t created any api keys yet.'])
                    @else
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                            <tr>
                                <th>{!! __('admin.id') !!}</th>
                                <th>{!! __('admin.user') !!}</th>
                                <th>{!! __('admin.description') !!}</th>
                                <th>{!! __('admin.permissions') !!}</th>
                                <th>{!! __('admin.expires_at') !!}</th>
                                <th>{!! __('admin.last_used') !!}</th>
                                <th>{!! __('admin.create_at') !!}</th>
                                <th class="text-right">{!! __('admin.actions') !!}</th>
                            </tr>

                            @foreach($apiKeys as $key)
                                <tr>
                                    <td>{{ $key->id }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', ['user' => $key->user->id]) }}"
                                           style="display: flex; color: #6c757d">
                                            <img alt="{!! __('image') !!}" src="{{ $key->user->avatar() }}"
                                                 class="rounded-circle mr-1 mt-1" width="32px" height="32px"
                                                 data-toggle="tooltip" title=""
                                                 data-original-title="{{ $key->user->first_name }} {{ $key->user->last_name }}">
                                            <div class="flex">
                                                {{ $key->user->username }} <br>
                                                <small>{{ $key->user->email }}</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $key->description }}
                                    </td>
                                    <td>
                                        {{ $key->permissions }}
                                    </td>
                                    <td>
                                        {{ $key->expires_at->translatedFormat(settings('date_format', 'd M Y')) }}
                                    </td>
                                    <td>
                                        {{ $key->last_used_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        {{ $key->created_at->translatedFormat(settings('date_format', 'd M Y')) }}
                                    </td>
                                    <td class="text-right">

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="card-footer text-right">
                  {{ $apiKeys->links(AdminTheme::pagination()) }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
