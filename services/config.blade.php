@extends(AdminTheme::wrapper(), ['title' => $service->getName() . ' '.__('admin.configuration'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
<script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('services.store', $service->getLowerName()) }}" method="POST">
                    <div class="card-header">
                      <h4>{{ $service->getName() }} {!! __('admin.configuration') !!}</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                      <div class="row">
        
                        @foreach($config->all() as $name => $field)
                          <div class="form-group @isset($field['col']) {{$field['col']}} @else col-6 @endisset">
                              <label>{!! $field['name'] !!}</label>
                              @if($field['type'] == 'select')
                              <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
                              name="{{ $name }}" 
                              id="{{ $name }}"
                              @if(isset($field['multiple']) AND $field['multiple']) multiple @endif
                              >
                                  @foreach($field['options'] ?? [] as $key => $option)
                                    <option value="{{ $key }}" @if(settings($name, $field['default_value'] ?? '') == $key) selected @endif>{{ $option }}</option>
                                  @endforeach
                              </select>
                              @else
                              <input class="form-control"
                                type="{{ $field['type'] }}" 
                                name="{{ $name }}" 
                                id="{{ $name }}" 
                                value="@settings($name, $field['default_value'] ?? '')"
                                placeholder="@isset($field['placeholder']){{$field['placeholder']}} @else{{ $field['name'] }} @endisset"
                                @if(in_array('required', $field['rules'])) required="" @endif>
                              @endif
                              <small class="form-text text-muted">
                                  {!! $field['description'] !!}
                              </small>
                          </div>
                        @endforeach
        
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
@endsection
