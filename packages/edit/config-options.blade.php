@extends(AdminTheme::path('packages/edit/master'), ['title' => 'Configurable Options', 'tab' => 'config_options'])

@section('content')
    <div class="p-0">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-create-option-modal-lg">
            Create Option
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Key</th>
                    <th>Type</th>
                    <th>Is Onetime</th>
                    <th>Price per 30 days</th>
                    <th class="text-right">Action</th>
                </tr>
                @foreach($package->configOptions()->orderBy('order', 'desc')->get() as $option)
                    <tr>
                        <td>{{ $option->id }}</td>
                        <td>{{ $option->key }}</td>
                        <td>{{ $option->type }}</td>
                        <td>{{ $option->is_onetime ? 'True' : 'False' }}</td>
                        <td>{{ number_format($option->data['monthly_price_unit'] ?? 0, 2) }}</td>
                        <td class="text-right">
                            <a href="{{ route('packages.config-options.move-option', ['package' => $package->id, 'option' => $option->id, 'direction' => 'up']) }}"
                               class="btn btn-primary"><i class="fas fa-solid fa-caret-up"></i></a>
                            <a href="{{ route('packages.config-options.move-option', ['package' => $package->id, 'option' => $option->id, 'direction' => 'down']) }}"
                               class="btn btn-primary"><i class="fas fa-solid fa-caret-down"></i></a>
                            <a href="{{ route('packages.config-options.edit-option', ['package' => $package->id, 'option' => $option->id]) }}"
                               class="btn btn-primary">Edit</a>
                            <a href="{{ route('packages.config-options.delete-option', ['package' => $package->id, 'option' => $option->id]) }}"
                               class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade bd-create-option-modal-lg" tabindex="-1" role="dialog"
         aria-labelledby="CreateOptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('packages.config-options.add', $package->id) }}" method="POST">
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
                            <select class="form-control select2 select2-hidden-accessible hide" name="key" tabindex="-1"
                                    aria-hidden="true">
                                @foreach($package->service()->getPackageConfig($package)->all() as $config)
                                    @if(!isset($config['is_configurable']) OR !$config['is_configurable'])
                                        @continue
                                    @endif
                                    <option value="{{ $config['key'] }}">{{ $config['name'] }} ({{ $config['type'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('admin.type') }}</label>
                            <select class="form-control select2 select2-hidden-accessible hide" name="type"
                                    tabindex="-1" aria-hidden="true">
                                <option value="range">Range slider</option>
                                <option value="number">Quantity / Number</option>
                                {{-- <option value="radio">Radio</option> --}}
                                <option value="select">Select Dropdown</option>
                                <option value="text">Text</option>
                                {{-- <option value="checkbox">Checkbox</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function duplicateFirstChildOfDiv(originalDivId) {
            // Select the original div
            var originalDiv = document.getElementById(originalDivId);
            if (!originalDiv) {
                console.error('The original div was not found');
                return;
            }

            // Select the first child of the original div
            var firstChild = originalDiv.firstElementChild;
            if (!firstChild) {
                console.error('No child elements found inside the div');
                return;
            }

            // Duplicate the first child
            var duplicateChild = firstChild.cloneNode(true);

            // Append the duplicated child to the same parent div
            originalDiv.appendChild(duplicateChild);
        }

        function deleteLastChildOfDiv(divId) {
            // Select the div
            var div = document.getElementById(divId);
            if (!div) {
                console.error('The div was not found');
                return;
            }

            // Check if the div has any children
            if (div.lastElementChild) {
                // Delete the last child of the div
                div.removeChild(div.lastElementChild);
            } else {
                console.error('No child elements to remove');
            }
        }

        function duplicateAndIncrementOptions(div) {
            // Find the parent container
            var container = document.getElementById(div);
            if (!container) return; // Exit if container not found

            // Find the last row within the container
            var lastRow = container.querySelector('.row:last-child');
            if (!lastRow) return; // Exit if no row found

            // Clone the last row
            var clonedRow = lastRow.cloneNode(true);

            // Update the name attributes of inputs in the cloned row
            var inputs = clonedRow.querySelectorAll('input');
            inputs.forEach(function (input) {
                var match = input.name.match(/\[options\]\[(\d+)\]/);
                if (match && match[1]) {
                    var index = parseInt(match[1], 10);
                    var newIndex = index + 1;
                    input.name = input.name.replace(`[options][${index}]`, `[options][${newIndex}]`);
                }
            });

            // Append the cloned row to the container
            container.appendChild(clonedRow);
        }

    </script>

@endsection
