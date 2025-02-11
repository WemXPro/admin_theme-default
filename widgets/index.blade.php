@extends(AdminTheme::wrapper(), ['title' => __('admin.settings'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.settings.store') }}" method="POST">
                    <div class="card-header">
                        <h4>{!! __('admin.widgets', ['default' => 'Widgets']) !!}</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            {{-- Display static widgets --}}
                            @foreach ($staticWidgets as $widget)
                                <div class="form-group col-12">
                                    <div class="control-label">
                                        {{ $widget['label'] }}
                                    </div>
                                    <label class="custom-switch mt-2"
                                           onclick="location.href='{{ settings($widget['key'], false) ? route('admin.settings.store', [$widget['key'] => 0]) : route('admin.settings.store', [$widget['key'] => 1]) }}';">
                                        <input type="checkbox" name="{{ $widget['key'] }}" value="1"
                                               class="custom-switch-input"
                                               @if(settings($widget['key'], false)) checked @endif>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">
                                            {{ $widget['description'] }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach

                            {{-- Display dynamic widgets for extensions --}}
                            @foreach ($dynamicWidgets as $widgetKey => $widgetData)
                                @foreach (enabledExtensions() as $module)
                                    @if (View::exists(Theme::moduleView($module->getLowerName(), $widgetData['view'])))
                                        @php
                                            $settingKey = "widget:{$widgetKey}:" . $module->getLowerName();
                                            $toggleUrl  = settings($settingKey, false)
                                                ? route('admin.settings.store', [$settingKey => 0])
                                                : route('admin.settings.store', [$settingKey => 1]);
                                        @endphp
                                        <div class="form-group col-12">
                                            <div class="control-label">
                                                {{ $module->getName() }} {{ $widgetData['label'] }}
                                            </div>
                                            <label class="custom-switch mt-2"
                                                   onclick="location.href='{{ $toggleUrl }}';">
                                                <input type="checkbox" name="{{ $settingKey }}" value="1"
                                                       class="custom-switch-input"
                                                       @if(settings($settingKey, false)) checked @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{ str_replace(':module', $module->getName(), $widgetData['description']) }}
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }
    </style>
@endsection
