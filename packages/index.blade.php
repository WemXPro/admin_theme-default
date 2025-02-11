@extends(AdminTheme::wrapper(), ['title' => __('admin.packages'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {!! __('admin.packages') !!}
                </div>
                <div class="card-body">
                    <a href="{{ route('packages.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> {!! __('admin.create_package') !!}
                    </a>

                    @if($packages->count() == 0)
                        @include('admin::empty-state', [
                            'title' => __('admin.packages_not_found'),
                            'description' => __('admin.packages_not_found_desc')
                        ])
                    @else
                        <div id="accordionCategories">
                            @php
                                // We get all categories
                                $categories = Categories::all();
                            @endphp

                            @foreach($categories as $category)
                                @php
                                    // Filter packages for a given category
                                    $categoryPackages = $packages->where('category_id', $category->id);
                                @endphp

                                @if($categoryPackages->count())
                                    <div class="card mb-3">
                                        <h4 class="card-header text-primary justify-content-center" id="heading{{ $category->id }}" data-toggle="collapse"
                                            data-target="#collapse{{ $category->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $category->id }}">
                                            {{ $category->name }}
                                        </h4>
                                        <div id="collapse{{ $category->id }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                                             aria-labelledby="heading{{ $category->id }}"
                                             data-parent="#accordionCategories">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>{!! __('admin.id') !!}</th>
                                                            <th>{!! __('admin.icon') !!}</th>
                                                            <th>{!! __('admin.name') !!}</th>
                                                            <th>{!! __('admin.service') !!}</th>
                                                            <th>{!! __('admin.status') !!}</th>
                                                            <th class="text-right">{!! __('admin.actions') !!}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($categoryPackages as $package)
                                                            <tr>
                                                                <td>{{ $package->order ?? 0 }}</td>
                                                                <td>
                                                                    <img alt="image"
                                                                         src="{{ asset('storage/products/' . $package->icon) }}"
                                                                         class="rounded-circle" width="35"
                                                                         data-toggle="tooltip"
                                                                         title="{{ $package->name }}">
                                                                </td>
                                                                <td>{{ $package->name }}</td>
                                                                <td>{{ $package->service }}</td>
                                                                <td>
                                                                    <span class="badge badge-secondary">
                                                                        {!! __('admin.' . $package->status) !!}
                                                                    </span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="{{ route('admin.change-order', ['id' => $package->id, 'model' => 'packages', 'direction' => 'up']) }}"
                                                                       class="btn btn-primary btn-sm">
                                                                        <i class="fas fa-caret-up"></i>
                                                                    </a>
                                                                    <a href="{{ route('admin.change-order', ['id' => $package->id, 'model' => 'packages', 'direction' => 'down']) }}"
                                                                       class="btn btn-primary btn-sm">
                                                                        <i class="fas fa-caret-down"></i>
                                                                    </a>
                                                                    <a href="{{ route('packages.clone', $package->id) }}"
                                                                       class="btn btn-primary btn-sm">
                                                                        <i class="fas fa-clone"></i>
                                                                    </a>
                                                                    <a href="{{ route('packages.edit', $package->id) }}"
                                                                       class="btn btn-primary btn-sm">
                                                                        {!! __('admin.edit') !!}
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('packages.destroy', $package->id) }}"
                                                                        method="POST" style="display: inline-block;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button onclick="deleteItem(event)"
                                                                                type="submit"
                                                                                class="btn btn-danger btn-sm">
                                                                            {!! __('admin.delete') !!}
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
