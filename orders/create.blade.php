@extends(AdminTheme::wrapper(), ['title' => __('admin.orders', ['default' => 'Orders']), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">
@endsection

@section('js_libraries')
    <script src="{{ Theme::get('Default')->assets }}assets/modules/codemirror/lib/codemirror.js"></script>
    <script src="{{ Theme::get('Default')->assets }}assets/modules/codemirror/mode/javascript/javascript.js"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12">

            </div>
        </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                    <form method="post" action="{{ route('orders.store') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>{!!  __('admin.update_service', ['default' => 'Update Service']) !!}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-md-12 col-12">
                                    <label for="user">{!!  __('admin.user', ['default' => 'User']) !!}</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="user_id"
                                            tabindex="-1" aria-hidden="true">
                                        @foreach (User::get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label
                                        for="package_id">{!!  __('admin.package', ['default' => 'Package']) !!}</label>
                                    <select class="form-control select2 select2-hidden-accessible"
                                            onchange="retrieveJSONList()" name="package_id" id="package_id"
                                            tabindex="-1" aria-hidden="true">
                                        @foreach (Package::get() as $package)
                                            @if($package->status == 'inactive')
                                                @continue;
                                            @endif
                                            <option value="{{ $package->id }}">{{ $package->name }}
                                                ({{ $package->service }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label for="price">{!!  __('admin.price', ['default' => 'Price']) !!}</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="price"
                                            id="price" tabindex="-1" aria-hidden="true">

                                    </select>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label for="price">{!!  __('admin.status', ['default' => 'Status']) !!}</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="status"
                                            tabindex="-1" aria-hidden="true">
                                        <option value="active"
                                                selected>{!!  __('admin.active', ['default' => 'Active']) !!}</option>
                                        <option
                                            value="suspended">{!!  __('admin.suspended', ['default' => 'Suspended']) !!}</option>
                                        <option
                                            value="terminated">{!!  __('admin.terminated', ['default' => 'Terminated']) !!}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label for="status">
                                        {!!  __('admin.domain', ['default' => 'Domain']) !!} {!!  __('admin.optional', ['default' => '(optional)']) !!}
                                    </label>
                                    <input type="text" class="form-control" name="domain" value=""
                                           placeholder="example.com"/>
                                    <small class="form-text text-muted"></small>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label
                                        for="status">{!!  __('admin.last_renewed_at', ['default' => 'Last Renewed At']) !!}</label>
                                    <input type="date" class="form-control" name="last_renewed_at"
                                           value="{{ Carbon::now()->translatedFormat('Y-m-d') }}" placeholder=""/>
                                    <small class="form-text text-muted"></small>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label for="status">{!!  __('admin.due_date', ['default' => 'Due Date']) !!}</label>
                                    <input type="date" class="form-control" name="due_date" value="" placeholder=""/>
                                    <small class="form-text text-muted"></small>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="create_instance" value="1"
                                               class="custom-control-input" id="customCheck1" checked>
                                        <label class="custom-control-label" for="customCheck1">
                                            {!!  __('admin.create_instance_package_service', ['default' => 'Create an instance of package service']) !!}
                                        </label>
                                    </div>
                                    <small>
                                        {!!  __('admin.create_instance_package_service_desc', ['default' =>
                                        'If this option is enabled, when the order is created it will also create an
                                        instance of the Package Service. For Example, if the package service
                                        is pterodactyl, when the order is created it will create a brand new pterodactyl
                                        server with it.'
                                        ]) !!}

                                    </small>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notify_user" value="1" class="custom-control-input"
                                               id="notify_user" checked>
                                        <label class="custom-control-label" for="notify_user">
                                            {!!  __('admin.send_user_email', ['default' => 'Send user email']) !!}
                                        </label>
                                    </div>
                                    <small>
                                        {!!  __('admin.send_user_email_desc', ['default' =>
                                        'Check this option if you want to notify the user via email that a new order has
                                        been created for them.'
                                        ]) !!}

                                    </small>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-dark" type="submit">{!!  __('admin.create', ['default' => 'Create']) !!}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </section>

    <script>
        function periodToHuman(price) {
            if (price == 1) {
                return 'daily';
            } else if (price == 7) {
                return 'weekly';
            } else if (price == 30) {
                return 'monthly';
            } else if (price == 90) {
                return 'quarterly';
            } else if (price == 365) {
                return 'yearly';
            } else if (price == 730) {
                return 'Per 2 years';
            } else if (price == 1825) {
                return 'Per 5 years';
            } else if (price == 3650) {
                return 'Per 10 years';
            } else {
                return 'daily';
            }
        }

        retrieveJSONList();

        function retrieveJSONList() {
            const selectElement = document.getElementById('price');
            var id = document.getElementById('package_id').value;
            fetch('/admin/orders/prices/' + id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    selectElement.innerHTML = '';

                    data.forEach(function (price) {
                        const optionElement = document.createElement('option');
                        optionElement.value = price.id;
                        optionElement.text = '{{ currency('symbol') }}' + price.price.toFixed(2) + ' @ ' + periodToHuman(price.period);
            selectElement.appendChild(optionElement);
    });
})
.catch(error => {
    console.error('Error:', error);
    // Handle the error case
});

}
</script>
@endsection
