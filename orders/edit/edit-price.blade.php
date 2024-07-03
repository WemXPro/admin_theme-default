@extends(AdminTheme::path('orders.edit.wrapper'), ['active' => 'price'])

@section('order-section')
<div class="card">
    <form action="{{ route('orders.update-price', $order->id) }}" method="POST">
        @csrf
    <div class="card-header">
        <h4>Price</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12 col-12">
                <label for="price[type]">{!! __('admin.type', ['default' => 'Type']) !!}</label>
                <select class="form-control select2 select2-hidden-accessible" name="price[type]" id="price[type]"tabindex="-1" aria-hidden="true">
                    <option value="recurring" @if($order->isRecurring()) selected="" @endif>{{ __('admin.recurring') }}</option>
                    <option value="one_time" @if(!$order->isRecurring()) selected="" @endif>{{ __('admin.one_time') }}</option>
                </select>
                <small class="form-text text-muted"></small>
            </div>
            <div class="col-md-12 col-12 @if(!$order->isRecurring()) d-none @endif" id="">
                <div class="form-group">
                    <label for="period">{{ __('admin.period') }}</label>
                    <select
                        class="form-control select2 select2-hidden-accessible hide"
                        id="period" name="price[period]" tabindex="-1"
                        aria-hidden="true">
                        <option value="1"
                                @if ($order->price['period'] == 1) selected @endif>
                            {{ __('admin.daily') }}
                        </option>
                        <option value="7"
                                @if ($order->price['period'] == 7) selected @endif>
                            {{ __('admin.weekly') }}
                        </option>
                        <option value="30"
                                @if ($order->price['period'] == 30) selected @endif>
                            {{ __('admin.monthly') }}
                        </option>
                        <option value="90"
                                @if ($order->price['period'] == 90) selected @endif>
                            {{ __('admin.quaterly') }}
                        </option>
                        <option value="365"
                                @if ($order->price['period'] == 365) selected @endif>
                            {{ __('admin.yearly') }}
                        </option>
                        <option value="730"
                                @if ($order->price['period'] == 730) selected @endif>
                            {!! __('admin.per_years', ['years' => 2]) !!}
                        </option>
                        <option value="1825"
                                @if ($order->price['period'] == 1825) selected @endif>
                            {!! __('admin.per_years', ['years' => 5]) !!}
                        </option>
                        <option value="3650"
                                @if ($order->price['period'] == 3650) selected @endif>
                            {!! __('admin.per_years', ['years' => 10]) !!}
                        </option>
                    </select>
                    <small class="form-text text-muted">The renewal period for this order</small>
                </div>
            </div>
            <div class="form-group col-md-12 col-12">
                <label>{!! __('admin.renewal_price') !!}</label>
                <input type="number" class="form-control" name="price[renewal_price]" value="{{ $order->price['renewal_price'] ?? 0 }}" required/>
                <small class="form-text text-muted">The renewal price the customer has to pay to renew the service</small>
            </div>
            <div class="form-group col-md-12 col-12">
                <label>{!! __('admin.upgrade_fee') !!}</label>
                <input type="number" class="form-control" name="price[upgrade_fee]" value="{{ $order->price['upgrade_fee'] ?? 0 }}" required/>
                <small class="form-text text-muted">The fee the user must pay in order to upgrade to a higher plan</small>
            </div>
            <div class="form-group col-md-12 col-12">
                <label>{!! __('admin.cancellation_fee') !!}</label>
                <input type="number" class="form-control" name="price[cancellation_fee]" value="{{ $order->price['cancellation_fee'] ?? 0 }}" required/>
                <small class="form-text text-muted">The fee the user must pay in order to cancel</small>
            </div>
            <div class="col-12">
                <a href="#more_price_settings" onclick="toggleMorePriceSettings()">Show Advanced Settings</a>
            </div>
            <div class="col-md-12 col-12 mt-4" id="more_price_settings" style="display: none;">
                <div class="form-group">
                    <label>{!! __('admin.price') !!}</label>
                    <input type="number" class="form-control" name="price[price]" value="{{ $order->price['price'] ?? 0 }}" required/>
                    <small class="form-text text-muted">The initial price user paid when they purchased the order</small>
                </div>
                <div class="form-group">
                    <label>{!! __('admin.setup_fee') !!}</label>
                    <input type="number" class="form-control" name="price[setup_fee]" value="{{ $order->price['setup_fee'] ?? 0 }}" required/>
                    <small class="form-text text-muted">The initial setup fee the user paid</small>
                </div>
            </div>
        </div>              
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h4>Price Modifiers</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Renewal Price</th>
                        <th>Cancellation fee</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Additional Ram</td>
                        <td>Custom Option</td>
                        <td>$10.00 / monthly</td>
                        <td>$0</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                </tbody>
            </table>
        </div>  
    </div>
</div>

<script>
    function toggleMorePriceSettings() {
        var morePriceSettings = document.getElementById('more_price_settings');
        if (morePriceSettings.style.display === 'none') {
            morePriceSettings.style.display = 'block';
        } else {
            morePriceSettings.style.display = 'none';
        }
    }
</script>
@endsection