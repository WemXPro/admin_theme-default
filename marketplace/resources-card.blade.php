@if(isset($marketplace) and count($marketplace))
<div class="card">
    <div class="card-header">
        <h4>{!! __('admin.marketplace') !!} Beta</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{!! __('admin.name') !!}</th>
                    <th>{!! __('admin.description') !!}</th>
                    <th>{!! __('admin.author') !!}</th>
                    <th>{!! __('admin.version') !!}</th>
                    <th>{!! __('admin.wemx_version') !!}</th>
                    <th>{!! __('admin.price') !!}</th>
                    <th class="text-right">{!! __('admin.actions') !!}</th>
                </tr>
                </thead>
                <tbody>
                @php($install_key = 'install')
                @foreach($marketplace['data'] as $resource)
                    @php($resource['installed'] = false)
                    @if($installedResource = Module::find($resource['real_name']))
                        @php($resource['installed'] = true)
                        @php($install_key = 'reinstall')
                        @php($installedResourceConfig = config($installedResource->getLowerName()))
                    @endif

                    <tr>
                        <td>
                            <img src="{{ $resource['icon'] ?? 'https://imgur.com/koz9j8a.png' }}" alt="Icon"
                                 style="width:32px; height:32px;">
                            {{ $resource['name'] }}
                        </td>

                        <td>@if(!empty($resource['short_desc']))
                                {{ $resource['short_desc'] }}
                            @else
                                {{ $resource['name'] }}
                            @endif</td>
                        <td>
                            <img src="{{ $resource['owner']['avatar'] ?? 'https://imgur.com/koz9j8a.png' }}"
                                 alt="Icon" style="width:32px; height:32px;">
                            {{ $resource['owner']['username'] }}
                        </td>
                        <td>{{ $resource['version'] }}</td>
                        <td>
                            @foreach($resource['wemx_version'] as $wemx_version)
                                {{ $wemx_version }}
                            @endforeach
                        </td>
                        <td>@if($resource['is_free'])
                                {!! __('admin.free') !!}
                            @else
                                {{ $resource['price'] }}
                            @endif</td>
                        <td class="text-right">
                            @if($resource['purchased'])
                                <a href="{{ route('admin.resource.install', ['resource_id' => $resource['id'], 'version_id' => $resource['version_id']]) }}"
                                   class="btn btn-primary">
                                    {!! __('admin.'.$install_key) !!}
                                </a>
                            @endif
                            <a href="{{ $resource['view_url'] }}"
                               class="btn btn-success">
                                {!! __('admin.view') !!}
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
