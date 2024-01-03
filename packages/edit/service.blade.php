@extends(AdminTheme::path('packages/edit/master'), ['title' => 'Package Service', 'tab' => 'service'])

@section('content')
<div>

    @includeIf(AdminTheme::serviceView($package->service, 'params'))

    @if($package->service()->hasPackageConfig($package))
    <form action="{{ route('package.update-service', $package->id) }}" method="POST">
        @csrf
        <div class="row">
            @foreach($package->service()->getPackageConfig($package)->all() ?? [] as $name => $field)
            <div class="form-group @isset($field['col']) {{$field['col']}} @else col-6 @endisset" style="display: flex;flex-direction: column;">
                <label>{!! $field['name'] !!}</label>
                @if($field['type'] == 'select')
                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
                name="{{ $field['key'] }}"
                id="{{ $field['key'] }}"
                @if(isset($field['save_on_change']) AND $field['save_on_change']) onchange="saveServiceSettings()" @endif
                @if(isset($field['multiple']) AND $field['multiple']) multiple @endif
                >
                    @foreach($field['options'] ?? [] as $key => $option)
                    <option value="{{ $key }}"
                    @if(in_array($key, (array) getValueByKey($field['key'], $package->data, $field['default_value'] ?? ''))) selected @endif
                    >{{ $option }}</option>
                    @endforeach
                </select>
                @elseif($field['type'] == 'bool')
                <label class="custom-switch mt-2">
                    <input type="hidden" name="{{ $field['key'] }}" value="0">
                    <input type="checkbox" name="{{ $field['key'] }}" @if(isset($field['save_on_change']) AND $field['save_on_change']) onchange="saveServiceSettings()" @endif value="1" class="custom-switch-input" @if(getValueByKey($field['key'], $package->data, $field['default_value'] ?? '')) checked @endif>
                    <span class="custom-switch-indicator"></span>
                </label>
                @elseif($field['type'] == 'textarea')
                    <textarea class="form-control" name="{{ $field['key'] }}" id="{{ $field['key'] }}">{{ getValueByKey($field['key'], $package->data, $field['default_value'] ?? '') }}</textarea>
                @else
                <input class="form-control"
                type="{{ $field['type'] }}"
                name="{{ $field['key'] }}"
                id="{{ $field['key'] }}"
                @isset($field['min']) min="{{$field['min']}}" @endisset
                @isset($field['max']) max="{{$field['max']}}" @endisset
                @if(isset($field['save_on_change']) AND $field['save_on_change']) onchange="saveServiceSettings()" @endif
                value="{{ getValueByKey($field['key'], $package->data, $field['default_value'] ?? '') }}"
                placeholder="@isset($field['placeholder']){{$field['placeholder']}} @else{{ $field['name'] }} @endisset"
                @if(in_array('required', $field['rules'])) required="" @endif>
                @endif
                <small class="form-text text-muted">
                    {!! $field['description'] !!}
                </small>
            </div>
            @endforeach
            <div class="col-12">
                <div class="text-right">
                    <button class="btn btn-success" id="service-settings-submit" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
    @endif

    <script>
        function saveServiceSettings()
        {
            document.getElementById('service-settings-submit').click();
        }
    </script>

</div>
@endsection
