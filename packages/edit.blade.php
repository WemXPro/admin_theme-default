@extends(AdminTheme::wrapper(), ['title' => 'Packages', 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">
@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('admin.edit_package') }}</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a onclick="openTab('home')" class="nav-link nav-link-tab active" id="home_tab"
                               data-toggle="tab"
                               href="#home" role="tab" aria-controls="home"
                               aria-selected="true">{{ __('admin.package') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('features')" class="nav-link nav-link-tab" id="features_tab"
                               data-toggle="tab"
                               href="#features" role="tab" aria-controls="features"
                               aria-selected="false">{{ __('admin.features') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('profile')" class="nav-link nav-link-tab" id="profile_tab"
                               data-toggle="tab"
                               href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">{{ __('admin.prices') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('contact')" class="nav-link nav-link-tab" id="contact_tab"
                               data-toggle="tab"
                               href="#contact" role="tab" aria-controls="contact"
                               aria-selected="false">{{ __('admin.service_provider') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('emails')" class="nav-link nav-link-tab" id="emails_tab"
                               data-toggle="tab"
                               href="#emails" role="tab" aria-controls="emails" aria-selected="false">
                                {{ __('admin.emails') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('webhooks')" class="nav-link nav-link-tab" id="webhooks_tab"
                               data-toggle="tab"
                               href="#webhooks" role="tab" aria-controls="webhooks" aria-selected="false">
                                {{ __('admin.webhooks') }}</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="openTab('links')" class="nav-link nav-link-tab" id="links_tab" data-toggle="tab"
                               href="#links" role="tab" aria-controls="links"
                               aria-selected="false">{{ __('admin.links') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home_tab">
                            <form action="{{ route('packages.update', ['package' => $package->id]) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label for="name">{{ __('admin.package_name') }}</label>
                                        <input type="text" name="name" id="name"
                                               placeholder="{{ __('admin.package_name') }}"
                                               class="form-control" value="{{ $package->name }}" required=""/>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <label for="category">{{ __('admin.category') }}</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="category"
                                                tabindex="-1" aria-hidden="true">
                                            @foreach (Categories::get() as $category)
                                                <option value="{{ $category->id }}"
                                                        @if ($package->category_id == $category->id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <label for="status">{{ __('admin.package_status') }}</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                                tabindex="-1" aria-hidden="true">
                                            <option value="active" @if ($package->status == 'active') selected @endif>
                                                {{ __('admin.active') }}
                                            </option>
                                            <option value="unlisted"
                                                    @if ($package->status == 'unlisted') selected @endif>
                                                {{ __('admin.unlisted_only_users_with_direct_link_can_view') }}
                                            </option>
                                            <option value="restricted"
                                                    @if ($package->status == 'restricted') selected @endif>
                                                {{ __('admin.admin_only_only_administrators_can_view') }}
                                            </option>
                                            <option value="inactive"
                                                    @if ($package->status == 'inactive') selected @endif>
                                                {{ __('admin.retired_inactive_package_will_not_be_shown_to_new') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-12 mt-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="icon" id="customFile">
                                            <label class="custom-file-label"
                                                   for="customFile">{{ __('admin.choose_file') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label for="description">{{ __('admin.package_description') }}</label>
                                        <textarea class="summernote form-control" name="description" id="description"
                                                  style="display: none;">
                                        @isset($package->description)
                                                {!! $package->description !!}
                                            @endisset
                                        </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 col-6">
                                        <label for="stock">{{ __('admin.global_stock') }}</label>
                                        <input type="number" name="global_stock" id="stock" min="-1"
                                               value="{{ $package->global_quantity }}" class="form-control"
                                               required=""/>
                                        <small
                                            class="form-text text-muted">{!! __('admin.client_stock_indicates_the_stock_limit_per_client') !!}</small>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <label for="stock">{{ __('admin.per_client_stock') }}</label>
                                        <input type="number" name="client_stock" id="stock" min="-1"
                                               value="{{ $package->client_quantity }}" class="form-control"
                                               required=""/>
                                        <small
                                            class="form-text text-muted">{!! __('admin.client_stock_indicates_the_stock_limit_per_client') !!}</small>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <div class="form-group">
                                            <div class="control-label">{{ __('admin.require_domain') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="require_domain" class="custom-switch-input"
                                                       value="1" @if($package->require_domain) checked @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('admin.does_this_package_require_the_user_to_have_domain') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <div class="form-group">
                                            <div class="control-label">{{ __('admin.allow_notes') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="allow_notes" class="custom-switch-input"
                                                       value="1" @if($package->allow_notes) checked @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{ __('admin.allow_users_to_include_special_notes_additional') }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-dark" type="submit">{{ __('admin.update') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features_tab">
                            <form action="{{ route('package.create-feature', $package->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-3 col-6" data-toggle="modal" data-target="#IconModal">
                                        <label for="name">{{ __('admin.icon') }}</label>
                                        <input type="text" name="icon" id="feature-icon" placeholder=""
                                               class="form-control" value="" required=""/>
                                    </div>
                                    <div class="form-group col-md-3 col-6">
                                        <label for="icon">{{ __('admin.color') }}</label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                                name="color" id="color" tabindex="-1" aria-hidden="true">
                                            @foreach (config('utils.colors') as $key => $color)
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="description">{{ __('admin.description') }}</label>
                                        <input type="text" name="description" id="description" placeholder=""
                                               class="form-control" value="" required=""/>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">{{ __('admin.add_feature') }}</button>
                                </div>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="IconModal" tabindex="-1" role="dialog"
                                 aria-labelledby="IconModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="IconModalLabel">{{ __('admin.select_icon') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('admin.close') }}">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                @foreach(config('utils.icons') as $icon)
                                                    <div class="col-1 mb-4">
                                                        <div class="bx-md d-flex justify-content-center"
                                                             style="cursor: pointer;" onclick='setIcon("{{ $icon }}")'>
                                                            {!! $icon !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="form-group col-md-12 col-12">
                                                    <label for="description">{{ __('admin.icon_font') }}</label>
                                                    <input type="text" name="description" id="custom-icon"
                                                           value="<i class='bx bxs-check-shield' ></i>"
                                                           class="form-control" value="" required=""/>
                                                    <small>{!! __('admin.custom_icons_on_boxicons_choose_icon') !!}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('admin.close') }}</button>
                                            <button type="button" onclick="setFeatureIcon()" class="btn btn-primary"
                                                    data-dismiss="modal">{{ __('admin.use_icon') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="sortable-table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('admin.icon') }}</th>
                                            <th>{{ __('admin.feature') }}</th>
                                            <th>{{ __('admin.order_id') }}</th>
                                            <th class="text-right">{{ __('admin.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                        @foreach($package->features()->orderBy('order', 'desc')->get() as $feature)
                                            <tr>
                                                <td><span class='bx-sm text-primary'>{!! $feature->icon !!}</span></td>
                                                <td class="align-middle">
                                                    {{ $feature->description }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $feature->order }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('package.move-feature', ['package' => $package->id, 'feature' => $feature->id, 'direction' => 'up']) }}"
                                                       class="btn btn-primary"><i class="fas fa-solid fa-caret-up"></i></a>
                                                    <a href="{{ route('package.move-feature', ['package' => $package->id, 'feature' => $feature->id, 'direction' => 'down']) }}"
                                                       class="btn btn-primary"><i
                                                            class="fas fa-solid fa-caret-down"></i></a>
                                                    <a href="{{ route('package.destroy-feature', ['package' => $package->id, 'feature' => $feature->id]) }}"
                                                       class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile_tab">
                            <button class="btn btn-primary mt-4 mb-4" data-toggle="modal"
                                    data-target="#createPriceModal">{{ __('admin.new_price') }}
                            </button>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('admin.period') }}</th>
                                    <th scope="col">{{ __('admin.status') }}</th>
                                    <th scope="col">{{ __('admin.price') }}</th>
                                    <th scope="col">{{ __('admin.renewal_price') }}</th>
                                    <th scope="col">{{ __('admin.setup_fee') }}</th>
                                    <th scope="col">{{ __('admin.cancellation_fee') }}</th>
                                    <th scope="col">{!! __('admin.actions') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($prices as $price)
                                    <tr>
                                        <td>{{ $price->type == 'single' ? ucfirst($price->type) : ucfirst($price->type). ' / ' . $price->periodToHuman() }}</td>
                                        <td>
                                            @if($price->is_active)
                                                <div class="flex align-items-center">
                                                    <i class="fas fa-solid fa-circle  text-success "
                                                       style="font-size: 11px;"></i> {!! __('admin.active') !!}
                                                </div>
                                            @else
                                                <div class="flex align-items-center">
                                                    <i class="fas fa-solid fa-circle  text-danger "
                                                       style="font-size: 11px;"></i> {!! __('admin.inactive') !!}
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ currency('symbol') }}{{ $price->price }}</td>
                                        <td>{{ currency('symbol') }} @isset($price->renewal_price)
                                                {{ $price->renewal_price }}
                                            @else
                                                {{ $price->price }}
                                            @endif
                                        </td>
                                        <td>{{ currency('symbol') }}{{ $price->setup_fee }}</td>
                                        <td>{{ currency('symbol') }}{{ $price->cancellation_fee }}</td>
                                        <td>
                                            <button class="btn btn-primary mt-4 mb-4" data-toggle="modal"
                                                    data-target="#editPriceModal-{{ $price->id }}">{{ __('admin.edit') }}
                                            </button>
                                            <a href="{{ route('package_price.delete', ['price' => $price->id]) }}"
                                               class="btn btn-icon icon-left btn-danger">{!! __('admin.delete') !!}</a>
                                        </td>
                                    </tr>

                                    {{-- create editing modal for each instance --}}
                                    <div class="modal fade" tabindex="-1" role="dialog"
                                         id="editPriceModal-{{ $price->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form
                                                    action="{{ route('package_price.update', ['price' => $price->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ __('admin.editing_price_cycle') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="{{ __('admin.close') }}">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body modal-lg">

                                                        <div class="form-group">
                                                            <label for="type">{{ __('admin.type') }}</label>
                                                            <select class="form-control select2 select2-hidden-accessible hide" id="type-{{$price->id}}"
                                                                    name="type" tabindex="-1" aria-hidden="true" onchange="setPriceType('{{$price->id}}')">
                                                                <option value="single" @if($price->type == 'single') selected @endif>{{ __('admin.single') }}</option>
                                                                <option value="recurring" @if($price->type == 'recurring') selected @endif>{{ __('admin.recurring') }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="row @if($price->type == 'single') d-none @endif" id="recurring-options-{{ $price->id }}">
                                                            <div class="form-group col-md-12 col-12">
                                                                <label for="period">{{ __('admin.period') }}</label>
                                                                <select
                                                                    class="form-control select2 select2-hidden-accessible hide"
                                                                    id="period" name="period" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <option value="1"
                                                                            @if ($price->period == 1) selected @endif>
                                                                        {{ __('admin.daily') }}
                                                                    </option>
                                                                    <option value="7"
                                                                            @if ($price->period == 7) selected @endif>
                                                                        {{ __('admin.weekly') }}
                                                                    </option>
                                                                    <option value="30"
                                                                            @if ($price->period == 30) selected @endif>
                                                                        {{ __('admin.monthly') }}
                                                                    </option>
                                                                    <option value="90"
                                                                            @if ($price->period == 90) selected @endif>
                                                                        {{ __('admin.quaterly') }}
                                                                    </option>
                                                                    <option value="365"
                                                                            @if ($price->period == 365) selected @endif>
                                                                        {{ __('admin.yearly') }}
                                                                    </option>
                                                                    <option value="730"
                                                                            @if ($price->period == 730) selected @endif>
                                                                        {!! __('admin.per_years', ['years' => 2]) !!}
                                                                    </option>
                                                                    <option value="1825"
                                                                            @if ($price->period == 1825) selected @endif>
                                                                        {!! __('admin.per_years', ['years' => 5]) !!}
                                                                    </option>
                                                                    <option value="3650"
                                                                            @if ($price->period == 3650) selected @endif>
                                                                        {!! __('admin.per_years', ['years' => 10]) !!}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-12 col-12">
                                                                <label for="price">{{ __('admin.price') }}</label>
                                                                <input onInput="updateRenewal({{ $price->id }})"
                                                                       type="number" name="price"
                                                                       id="price-{{ $price->id }}" min="0"
                                                                       step="0.01" value="{{ $price->price }}"
                                                                       class="form-control" required=""/>
                                                            </div>

                                                            <div class="form-group col-md-12 col-12">
                                                                <label for="setup_fee">{{ __('admin.setup_fee') }}</label>
                                                                <input type="number" name="setup_fee" id="setup_fee"
                                                                       min="0.00" step="0.01"
                                                                       value="{{ $price->setup_fee }}"
                                                                       class="form-control"
                                                                       required=""/>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-12 col-12">
                                                                <label for="price">{{ __('admin.data') }}</label>
                                                                <textarea type="text" name="data"
                                                                          id="data-{{ $price->id }}"
                                                                          class="form-control">@json($price->data)</textarea>
                                                                <small>{{ __('admin.data_for_custom_gateways_should_be_left_empty') }}</small>
                                                            </div>
                                                        </div>

                                                        <div class="row @if($price->type == 'single') d-none @endif" id="price-options-{{ $price->id }}">
                                                            <div class="form-group col-md-6 col-6">
                                                                <div class="control-label">{{ __('admin.renewal_price') }}</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input onchange="checkbox({{ $price->id }})"
                                                                           type="checkbox"
                                                                           id="enable-renewal-price-{{ $price->id }}"
                                                                           name="enable-renewal-price"
                                                                           class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">{{ __('admin.use_custom_renewal_price') }}</span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group col-md-6 col-6">
                                                                <label for="renewal_price" data-toggle="tooltip"
                                                                       data-placement="right" title=""
                                                                       data-original-title="Renewal price refers to the cost of renewing a subscription, service or contract after the initial period at a possibly different rate.">{{ __('admin.renewal_price') }} <i
                                                                        class="fa-solid fa-circle-info"></i></label>
                                                                <input type="number" name="renewal_price"
                                                                       id="renewal_price-{{ $price->id }}" min="0.00"
                                                                       value="{{ $price->renewal_price }}" step="0.01"
                                                                       class="form-control" disabled/>
                                                            </div>

                                                            <div class="form-group col-md-6 col-6">
                                                                <div class="control-label">{{ __('admin.cancelled_fee') }}</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input type="checkbox"
                                                                           onchange="checkbox({{ $price->id }})"
                                                                           id="enable-cancellation-fee-{{ $price->id }}"
                                                                           name="enable-cancellation-fee"
                                                                           class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">{{ __('admin.setup_cancellation_fee') }}</span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group col-md-6 col-6">
                                                                <label for="cancellation_fee" data-toggle="tooltip"
                                                                       data-placement="right" title=""
                                                                       data-original-title="Cancellation fee is a charge for ending a contract or service agreement before its end date.">{{ __('admin.cancelled_fee') }} <i class="fa-solid fa-circle-info"></i></label>
                                                                <input type="number" name="cancellation_fee"
                                                                       id="cancellation_fee-{{ $price->id }}"
                                                                       value="{{ $price->cancellation_fee }}" min="0.00"
                                                                       step="0.01" class="form-control" disabled/>
                                                            </div>

                                                        </div>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <div class="control-label">{{ __('admin.active') }}</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input type="checkbox" name="is_active"
                                                                           class="custom-switch-input" value="1"
                                                                           @if($price->is_active) checked @endif>
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">{{ __('admin.you_can_deactivate_price_if_you_no_longer') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('admin.close') }}
                                                        </button>
                                                        <button class="btn btn-primary" type="submit">{{ __('admin.update') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>

                            @if (Prices::where('package_id', $package->id)->count() == 0)
                                @include(AdminTheme::path('empty-state'), [
                                    'title' => 'No prices found',
                                    'description' => 'This package is unlisted, please create a price.',
                                ])
                            @endif
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact_tab">
                            <div class="form-group col-md-12 col-12">
                                <label for="service">{{ __('admin.service_provider') }}</label>
                                <select class="form-control select2 select2-hidden-accessible"
                                        onchange="updateService()"
                                        name="service" id="service" tabindex="-1" aria-hidden="true">
                                    @foreach (Service::allEnabled() as $service)
                                        <option value="{{ $service->module()->getLowerName() }}"
                                                @if ($package->service == $service->module()->getLowerName()) selected @endif>{{ $service->about()->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>

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
                                            @if(in_array($key, (array) $package->data(Str::remove("[]", $field['key']), $field['default_value'] ?? ''))) selected @endif
                                            >{{ $option }}</option>
                                            @endforeach
                                        </select>
                                        @elseif($field['type'] == 'bool')
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="{{ $field['key'] }}" @if(isset($field['save_on_change']) AND $field['save_on_change']) onchange="saveServiceSettings()" @endif value="1" class="custom-switch-input" @if($package->data($field['key'], $field['default_value'] ?? '')) checked @endif>
                                            <span class="custom-switch-indicator"></span>
                                          </label>
                                        @else
                                        <input class="form-control"
                                        type="{{ $field['type'] }}"
                                        name="{{ $field['key'] }}"
                                        id="{{ $field['key'] }}"
                                        @isset($field['min']) min="{{$field['min']}}" @endisset
                                        @isset($field['max']) max="{{$field['max']}}" @endisset
                                        @if(isset($field['save_on_change']) AND $field['save_on_change']) onchange="saveServiceSettings()" @endif
                                        value="{{ $package->data($field['key'], $field['default_value'] ?? '') }}"
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
                                            <button class="btn btn-primary" id="service-settings-submit" type="submit">Update</button>
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
                        <div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails_tab">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mt-4 mb-4" data-toggle="modal"
                                    data-target="#createEmail">
                                {{ __('admin.create') }}
                            </button>

                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                WemX already sends a set of emails when an order is cancelled, suspended or terminated.
                                You can configure them <a target="_blank"
                                                          href="/admin/emails/messages"><strong>here</strong></a>
                                - This page provides you more customibility to send package specific emails.
                                <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('admin.close') }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            @if (PackageEmail::where('package_id', $package->id)->count() == 0)
                                @include(AdminTheme::path('empty-state'), [
                                    'title' => 'No emails found',
                                    'description' => 'You haven\'t created any emails for this package',
                                ])
                            @endif

                            <!-- Create Email Modal -->
                            <div class="modal fade bd-example-modal-lg" id="createEmail" tabindex="-1" role="dialog"
                                 aria-labelledby="createEmailLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createEmailLabel">{{ __('admin.email_event') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('admin.close') }}">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('packages.emails.create', $package->id) }}" method="POST"
                                              enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="event">{{ __('admin.event') }}</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                            name="event"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="creation">
                                                            {{ __('admin.creation') }}
                                                        </option>
                                                        <option value="renewal">
                                                            {{ __('admin.renewal') }}
                                                        </option>
                                                        <option value="upgrade">
                                                            {{ __('admin.upgrade') }}
                                                        </option>
                                                        <option value="suspension">
                                                            {{ __('admin.suspension') }}
                                                        </option>
                                                        <option value="unsuspension">
                                                            {{ __('admin.unsuspension') }}
                                                        </option>
                                                        <option value="cancellation">
                                                            {{ __('admin.cancellation') }}
                                                        </option>
                                                        <option value="termination">
                                                            {{ __('admin.termination') }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="title">{{ __('admin.email_title') }}</label>
                                                    <input type="text" name="title" id="title" placeholder="{{ __('admin.subject') }}"
                                                           class="form-control" required=""/>
                                                </div>

                                                <div class="">
                                                    <label for="body">{{ __('admin.email_body') }}</label>
                                                    <textarea class="summernote form-control" name="body" id="body"
                                                              style="display: none;">
                                                </textarea>
                                                    <small class="form-text text-muted"></small>
                                                </div>

                                                <div class="form-group" style="display: flex;flex-direction: column;">
                                                    <label for="myfile">{{ __('admin.select_a_file_optional') }}</label>
                                                    <input class="" type="file" id="myfile" name="attachment">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    {{ __('admin.close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tbody>
                                        @if($package->emails->count() > 0)
                                            <tr>
                                                <th>{{ __('admin.event') }}</th>
                                                <th>{{ __('admin.title') }}</th>
                                                <th class="text-right">{{ __('admin.last_updated') }}</th>
                                                <th class="text-right">{{ __('admin.action') }}</th>
                                            </tr>
                                        @endif
                                        @foreach($package->emails->all() as $email)
                                            <tr>
                                                <td>{{ $email->event }}</td>
                                                <td>{{ $email->title }}</td>
                                                <td class="text-right">{{ $email->updated_at->diffForHumans() }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('packages.emails.delete', ['email' => $email->id]) }}"
                                                       class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    <button data-toggle="modal" data-target="#editEmail{{$email->id}}"
                                                            class="btn btn-primary">{{ __('admin.manage') }}
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Create Email Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="editEmail{{$email->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="editEmail{{$email->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editEmail{{$email->id}}Label">
                                                                {{ __('admin.email_event') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="{{ __('admin.close') }}">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('packages.emails.update', ['email' => $email->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <label for="event">{{ __('admin.event') }}</label>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="event"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="creation"
                                                                                @if($email->event == 'creation') selected @endif>
                                                                            {{ __('admin.creation') }}
                                                                        </option>
                                                                        <option value="renewal"
                                                                                @if($email->event == 'renewal') selected @endif>
                                                                            {{ __('admin.renewal') }}
                                                                        </option>
                                                                        <option value="upgrade"
                                                                                @if($email->event == 'upgrade') selected @endif>
                                                                            {{ __('admin.upgrade') }}
                                                                        </option>
                                                                        <option value="suspension"
                                                                                @if($email->event == 'suspension') selected @endif>
                                                                            {{ __('admin.suspension') }}
                                                                        </option>
                                                                        <option value="unsuspension"
                                                                                @if($email->event == 'unsuspension') selected @endif>
                                                                            {{ __('admin.unsuspension') }}
                                                                        </option>
                                                                        <option value="cancellation"
                                                                                @if($email->event == 'cancellation') selected @endif>
                                                                            {{ __('admin.cancellation') }}
                                                                        </option>
                                                                        <option value="termination"
                                                                                @if($email->event == 'termination') selected @endif>
                                                                            {{ __('admin.termination') }}
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label for="title">{{ __('admin.email_title') }}</label>
                                                                    <input type="text" name="title" id="title"
                                                                           value="{{ $email->title }}"
                                                                           placeholder="{{ __('admin.subject') }}"
                                                                           class="form-control" required=""/>
                                                                </div>

                                                                <div class="">
                                                                    <label for="body">{{ __('admin.email_body') }}</label>
                                                                    <textarea class="summernote form-control"
                                                                              name="body" id="body"
                                                                              style="display: none;">
                                                                        {!! $email->body !!}
                                                                    </textarea>
                                                                    <small class="form-text text-muted"></small>
                                                                </div>

                                                                <div class="form-group"
                                                                     style="display: flex;flex-direction: column;">
                                                                    <label for="myfile">{{ __('admin.select_a_file_optional') }}</label>
                                                                    <input class="" type="file" id="myfile"
                                                                           name="attachment">
                                                                </div>

                                                                @if($email->attachment)
                                                                    <span
                                                                        class="badge badge-pill badge-secondary">{{ basename($email->attachment) }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('admin.close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">{{ __('admin.update') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="webhooks" role="tabpanel" aria-labelledby="webhooks_tab">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mt-4 mb-4" data-toggle="modal"
                                    data-target="#createWebhook">
                                {{ __('admin.create') }}
                            </button>

                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                Package webhooks are a powerful feature allowing you to do a huge amount of things. You
                                can also use custom variables inside webhooks. <a
                                    href="https://docs.wemx.net/en/setup/packages#package-webhooks" target="_blank">Learn
                                    More</a>
                            </div>

                            @if ($package->webhooks->count() == 0)
                                @include(AdminTheme::path('empty-state'), [
                                    'title' => 'No webhooks found',
                                    'description' => 'You haven\'t created any webhooks for this package',
                                ])
                            @endif

                            <!-- Create Webhook Modal -->
                            <div class="modal fade bd-example-modal-lg" id="createWebhook" tabindex="-1" role="dialog"
                                 aria-labelledby="createWebhookLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createWebhookLabel">{{ __('admin.webhook_event') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('admin.close') }}">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('packages.webhooks.create', $package->id) }}"
                                              method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="event">{{ __('admin.event') }}</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                            name="event"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="creation">
                                                            {{ __('admin.creation') }}
                                                        </option>
                                                        <option value="renewal">
                                                            {{ __('admin.renewal') }}
                                                        </option>
                                                        <option value="upgrade">
                                                            {{ __('admin.upgrade') }}
                                                        </option>
                                                        <option value="suspension">
                                                            {{ __('admin.suspension') }}
                                                        </option>
                                                        <option value="unsuspension">
                                                            {{ __('admin.unsuspension') }}
                                                        </option>
                                                        <option value="cancellation">
                                                            {{ __('admin.cancellation') }}
                                                        </option>
                                                        <option value="termination">
                                                            {{ __('admin.termination') }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="method">{{ __('admin.method') }}</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                            name="method"
                                                            tabindex="-1" aria-hidden="true">

                                                        @foreach(['get', 'post', 'put', 'patch', 'delete', 'head'] as $key => $method)
                                                            <option value="{{ $method }}"
                                                                    style="text-transform: uppsercase">
                                                                {{ strtoupper($method) }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="url">{{ __('admin.url') }}</label>
                                                    <input type="url" name="url" id="url"
                                                           placeholder="https://example.com/api/v1"
                                                           class="form-control" required=""/>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="data">{{ __('admin.data') }}</label>
                                                    <textarea class="form-control" name="data" id="data"
                                                              placeholder='{"key": "value"}'
                                                              style="height: 200px !important"></textarea>
                                                    <small class="form-text text-muted"></small>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="headers">{{ __('admin.headers') }}</label>
                                                    <textarea class="form-control" name="headers" id="headers"
                                                              placeholder='{"Authorization": "Bearer apikey"}'></textarea>
                                                    <small class="form-text text-muted"></small>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    {{ __('admin.close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tbody>
                                        @if($package->webhooks->count() > 0)
                                            <tr>
                                                <th>{{ __('admin.event') }}</th>
                                                <th>{{ __('admin.method') }}</th>
                                                <th class="text-right">{{ __('admin.last_updated') }}</th>
                                                <th class="text-right">{{ __('admin.action') }}</th>
                                            </tr>
                                        @endif
                                        @foreach($package->webhooks->all() as $webhook)
                                            <tr>
                                                <td>{{ $webhook->event }}</td>
                                                <td>{{ $webhook->method }}</td>
                                                <td class="text-right">{{ $webhook->updated_at->diffForHumans() }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('packages.webhooks.delete', ['webhook' => $webhook->id]) }}"
                                                       class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    <button data-toggle="modal"
                                                            data-target="#editWebhook{{$webhook->id}}"
                                                            class="btn btn-primary">{{ __('admin.manage') }}
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Create Email Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="editWebhook{{$webhook->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="editWebhook{{$webhook->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editWebhook{{$webhook->id}}Label">{{ __('admin.webhook_event') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="{{ __('admin.close') }}">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('packages.webhooks.update', ['webhook' => $webhook->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <label for="event">{{ __('admin.event') }}</label>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="event"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="creation"
                                                                                @if($webhook->event == 'creation') selected @endif>
                                                                            {{ __('admin.creation') }}
                                                                        </option>
                                                                        <option value="renewal"
                                                                                @if($webhook->event == 'renewal') selected @endif>
                                                                            {{ __('admin.renewal') }}
                                                                        </option>
                                                                        <option value="upgrade"
                                                                                @if($webhook->event == 'upgrade') selected @endif>
                                                                            {{ __('admin.upgrade') }}
                                                                        </option>
                                                                        <option value="suspension"
                                                                                @if($webhook->event == 'suspension') selected @endif>
                                                                            {{ __('admin.suspension') }}
                                                                        </option>
                                                                        <option value="unsuspension"
                                                                                @if($webhook->event == 'unsuspension') selected @endif>
                                                                            {{ __('admin.unsuspension') }}
                                                                        </option>
                                                                        <option value="cancellation"
                                                                                @if($webhook->event == 'cancellation') selected @endif>
                                                                            {{ __('admin.cancellation') }}
                                                                        </option>
                                                                        <option value="termination"
                                                                                @if($webhook->event == 'termination') selected @endif>
                                                                            {{ __('admin.termination') }}
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label for="method">{{ __('admin.method') }}</label>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="method"
                                                                        tabindex="-1" aria-hidden="true">

                                                                        @foreach(['get', 'post', 'put', 'patch', 'delete', 'head'] as $key => $method)
                                                                            <option value="{{ $method }}"
                                                                                    style="text-transform: uppsercase"
                                                                                    @if($webhook->method == $method) selected @endif>
                                                                                {{ strtoupper($method) }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label for="url">{{ __('admin.url') }}</label>
                                                                    <input type="url" name="url" id="url"
                                                                           placeholder="https://example.com/api/v1"
                                                                           class="form-control"
                                                                           value="{{ $webhook->url }}" required=""/>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label for="data">{{ __('admin.data') }}</label>
                                                                    <textarea class="form-control" name="data" id="data"
                                                                              placeholder='{"key": "value"}'
                                                                              style="height: 200px !important">{{ json_encode($webhook->data, JSON_PRETTY_PRINT) }}</textarea>
                                                                    <small class="form-text text-muted"></small>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label for="headers">{{ __('admin.headers') }}</label>
                                                                    <textarea class="form-control" name="headers"
                                                                              id="headers"
                                                                              placeholder='{"Authorization": "Bearer apikey"}'>{{ json_encode($webhook->headers, JSON_PRETTY_PRINT) }}</textarea>
                                                                    <small class="form-text text-muted"></small>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('admin.close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">{{ __('admin.update') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="links" role="tabpanel" aria-labelledby="links_tab">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{ __('admin.package_checkout') }}</label>
                                    <input type="text" class="form-control"
                                           value="{{ route('store.package', $package->id) }}" readonly="">
                                    <small class="form-text text-muted">
                                        {{ __('admin.direct_link_to_the_checkout_page_on_your_application') }}
                                    </small>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('admin.package_process_payment') }}</label>
                                    <input type="text" class="form-control"
                                           value="{{ route('payment.package', ['package' => $package->id, 'price_id' => '1', 'gateway' => '1']) }}"
                                           readonly="">
                                    <small class="form-text text-muted">
                                        {{ __('admin.important_replace_price_id_with_the_id') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Create Item Modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="createPriceModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('package_price.create', ['package' => $package->id]) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('admin.create_price') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('admin.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="type">{{ __('admin.type') }}</label>
                            <select class="form-control select2 select2-hidden-accessible hide" id="type-0"
                                    name="type" tabindex="-1" aria-hidden="true" onchange="setPriceType('0')">
                                <option value="single">{{ __('admin.single') }}</option>
                                <option value="recurring" selected>{{ __('admin.recurring') }}</option>
                            </select>
                        </div>
                        
                        <div class="row" id="recurring-options-0">
                            <div class="form-group col-md-12 col-12">
                                <label for="period">{{ __('admin.period') }}</label>
                                <select class="form-control select2 select2-hidden-accessible hide" id="period"
                                        name="period" tabindex="-1" aria-hidden="true">
                                    <option value="1">{{ __('admin.daily') }}</option>
                                    <option value="7">{{ __('admin.weekly') }}</option>
                                    <option value="30" selected>{{ __('admin.monthly') }}</option>
                                    <option value="90">{{ __('admin.quaterly') }}</option>
                                    <option value="365">{{ __('admin.yearly') }}</option>
                                    <option value="730">{!! __('admin.per_years', ['years' => 2]) !!}</option>
                                    <option value="1825">{!! __('admin.per_years', ['years' => 5]) !!}</option>
                                    <option value="3650">{!! __('admin.per_years', ['years' => 10]) !!}</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label for="price-0">{{ __('admin.price') }}</label>
                                <input onInput="updateRenewal(0)" type="number" name="price" id="price-0"
                                       min="0" step="0.01" value="1.00" class="form-control" required=""/>
                            </div>

                            <div class="form-group col-md-12 col-12">
                                <label for="setup_fee">{{ __('admin.setup_fee') }}</label>
                                <input type="number" name="setup_fee" id="setup_fee" min="0.00" step="0.01"
                                       value="0.00" class="form-control" required=""/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label for="data">{{ __('admin.data') }}</label>
                                <textarea type="text" name="data" id="data"
                                          class="form-control"></textarea>
                                <small>{{ __('admin.data_for_custom_gateways_should_be_left_empty') }}</small>
                            </div>
                        </div>

                        <div class="row" id="price-options-0">
                            <div class="form-group col-md-6 col-6">
                                <div class="control-label">{{ __('admin.renewal_price') }}</div>
                                <label class="custom-switch mt-2">
                                    <input onchange="checkbox(0)" type="checkbox" id="enable-renewal-price-0"
                                           name="enable-renewal-price" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ __('admin.use_custom_renewal_price') }}</span>
                                </label>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <label for="renewal_price-0" data-toggle="tooltip" data-placement="right" title=""
                                       data-original-title="Renewal price refers to the cost of renewing a subscription, service or contract after the initial period at a possibly different rate.">{!! __('admin.renewal_price') !!} <i class="fa-solid fa-circle-info"></i></label>
                                <input type="number" name="renewal_price" id="renewal_price-0" min="0.00"
                                       step="0.01" class="form-control" disabled/>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <div class="control-label">{{ __('admin.cancellation_fee') }}</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" onchange="checkbox(0)" id="enable-cancellation-fee-0"
                                           name="enable-cancellation-fee" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ __('admin.setup_cancellation_fee') }}</span>
                                </label>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <label for="cancellation_fee-0" data-toggle="tooltip" data-placement="right"
                                       title=""
                                       data-original-title="Cancellation fee is a charge for ending a contract or service agreement before its end date.">
                                    {!! __('admin.cancellation_fee') !!} <i class="fa-solid fa-circle-info"></i></label>
                                <input type="number" name="cancellation_fee" id="cancellation_fee-0" min="0.00"
                                       step="0.01" class="form-control" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const storedTabId = localStorage.getItem('activeTab');

        if (storedTabId) {
            openTab(storedTabId);
        } else {
            openTab('home');
        }

        function openTab(tabId) {
            const tabLinks = document.querySelectorAll('.nav-link-tab');
            const tabContents = document.querySelectorAll('.tab-pane');

            tabLinks.forEach(link => {
                link.classList.remove('active');
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    openTab(link.getAttribute('href').substr(1));
                });
            });

            tabContents.forEach(content => {
                content.classList.remove('show', 'active');
            });

            document.querySelector('.nav-link-tab[href="#' + tabId + '"]').classList.add('active');
            document.getElementById(tabId).classList.add('show', 'active');
            localStorage.setItem('activeTab', tabId);
        }

        function updateRenewal(id) {
            if (document.getElementById('enable-renewal-price-' + id).checked == false) {
                document.getElementById('renewal_price-' + id).value = document.getElementById('price-' + id).value;
            }
        }

        function checkbox(id) {
            if (document.getElementById('enable-renewal-price-' + id).checked == false) {
                document.getElementById('renewal_price-' + id).setAttribute('disabled', '');
            } else {
                document.getElementById('renewal_price-' + id).removeAttribute('disabled');
            }

            if (document.getElementById('enable-cancellation-fee-' + id).checked == false) {
                document.getElementById('cancellation_fee-' + id).setAttribute('disabled', '');
            } else {
                document.getElementById('cancellation_fee-' + id).removeAttribute('disabled');
            }
        }

        function setPriceType(id) {
            var type = document.getElementById('type-' + id).value;

            if(type == 'single') {
                document.getElementById('recurring-options-' + id).classList.add('d-none');
                document.getElementById('price-options-'+ id).classList.add('d-none');
            } else {
                document.getElementById('recurring-options-'+ id).classList.remove('d-none');
                document.getElementById('price-options-'+ id).classList.remove('d-none');
            }
        }

        function updateService() {
            var service = document.getElementById("service").value;
            if (service) {
                window.location = '/admin/packages/update-service/{{ $package->id }}/' + service;
            }
        }

        function setIcon(icon) {
            document.getElementById("custom-icon").value = icon;
        }

        function setFeatureIcon() {
            document.getElementById("feature-icon").value = document.getElementById("custom-icon").value;
        }
    </script>

    <style>
        span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }
    </style>
@endsection
