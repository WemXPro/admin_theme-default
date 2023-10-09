@extends(AdminTheme::wrapper(), ['title' => __('admin.services'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! __('admin.services') !!}</div>

                <div class="card-body">
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{!! __('admin.name') !!}</th>
                                <th>{!! __('admin.status') !!}</th>
                                <th class="text-right">{!! __('admin.actions') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Service::all() as $module)
                                <tr>
                                    <td>{{ $module->getName() }}</td>
                                    <td>
                                        @if ($module->isEnabled())
                                            <span class="badge badge-success">{!! __('admin.enabled') !!}</span>
                                        @else
                                            <span class="badge badge-danger">{!! __('admin.disabled') !!}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if ($module->isEnabled())
                                            <a href="{{ route('modules.toggle', ['module' => $module->getName()]) }}"
                                                class="btn btn-danger">{!! __('admin.disable') !!}</a>
                                        @else
                                            <a href="{{ route('modules.toggle', ['module' => $module->getName()]) }}"
                                                class="btn btn-dark">{!! __('admin.enable') !!}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf(AdminTheme::path('marketplace.resources-card'))
@endsection
