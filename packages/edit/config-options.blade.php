@extends(AdminTheme::path('packages/edit/master'), ['title' => 'Configurable Options', 'tab' => 'config_options'])

@section('content')
<div class="p-0">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-create-option-modal-lg">Create Option</button>
    <div class="table-responsive">
      <table class="table table-striped table-md">
        <tbody><tr>
          <th>#</th>
          <th>Key</th>
          <th>Type</th>
          <th>Is Onetime</th>
          <th>Price per 30 days</th>
          <th>Action</th>
        </tr>
        @foreach($package->configOptions as $option)
        <tr>
          <td>1</td>
          <td>{{ $option->key }}</td>
          <td>{{ $option->type }}</td>
          <td>{{ $option->is_onetime ? 'True' : 'False' }}</td>
          <td>{{ number_format($option->price_per_30_days, 2) }}</td>
          <td><a href="#" class="btn btn-secondary">Detail</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</div>

<div class="modal fade bd-create-option-modal-lg" tabindex="-1" role="dialog" aria-labelledby="CreateOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="">
            @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Configurable Option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="key">{{ __('admin.key') }}</label>
                <select class="form-control select2 select2-hidden-accessible hide" name="key" tabindex="-1" aria-hidden="true">
                    @foreach($package->service()->getPackageConfig($package)->all() as $config)
                        @if(!in_array($config['type'], ['number', 'select', 'bool']))
                            @continue;
                        @endif
                        <option value="{{ $config['key'] }}">{{ $config['name'] }} ({{ $config['type'] }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">{{ __('admin.type') }}</label>
                <select class="form-control select2 select2-hidden-accessible hide" name="type" tabindex="-1" aria-hidden="true">
                    <option value="range">Range slider</option>
                    <option value="number">Number Input</option>
                    <option value="radio">Radio</option>
                    <option value="select">Select Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>
            <div id="number">
                <div class="form-group">
                    <label for="price_per_30_days">Price Per 30 days per unit</label>
                    <input type="number" name="price_per_30_days" min="0" step="0.01" class="form-control" required=""/>
                </div>
                <div class="form-group">
                    <label for="default_value">Default Value</label>
                    <input type="number" name="default_value" min="0" class="form-control" required=""/>
                </div>
                <div class="form-group">
                    <label for="min_value">Mininum value</label>
                    <input type="number" name="min_value" min="0" class="form-control" required=""/>
                </div>
                <div class="form-group">
                    <label for="max_value">Maximum value</label>
                    <input type="number" name="max_value" min="0" class="form-control" required=""/>
                </div>
                <div class="form-group">
                    <label for="step_value">Step</label>
                    <input type="number" name="step_value" min="0" class="form-control" required=""/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection