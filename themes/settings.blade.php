@extends(AdminTheme::wrapper(), ['title' => __('admin.themes'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (View::exists(Theme::path('admin-settings')))
                    @includeIf(Theme::path('admin-settings'))
                @else
                    <div class="alert alert-warning mt-3">
                        <div class="alert-title">{!! __('admin.warning') !!}</div>
                        {{ $theme->name }} {!! __('admin.theme_warning') !!}
                    </div>
                @endif
            </div>
        </div>
        <style>
            span.select2.select2-container.select2-container--default {
                width: 100% !important;
            }
        </style>
@endsection
