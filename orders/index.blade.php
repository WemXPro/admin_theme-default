@extends(AdminTheme::wrapper(), ['title' => __('admin.order'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12 mb-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link @if($status == 'active') active @endif"
                                   href="{{ route('orders.index', ['status' => 'active']) }}">
                                    {!! __('admin.active') !!}
                                    <span class="badge @if($status == 'active') badge-white @else badge-primary @endif">
                                            {{ Order::whereStatus('active')->count() }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($status == 'suspended') active @endif"
                                   href="{{ route('orders.index', ['status' => 'suspended']) }}">{!! __('admin.suspended') !!}
                                    <span
                                        class="badge @if($status == 'suspended') badge-white @else badge-primary @endif">
                                        {{ Order::whereStatus('suspended')->count() }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($status == 'cancelled') active @endif"
                                   href="{{ route('orders.index', ['status' => 'cancelled']) }}">{!! __('admin.cancelled') !!}
                                    <span
                                        class="badge @if($status == 'cancelled') badge-white @else badge-primary @endif">
                                        {{ Order::whereStatus('cancelled')->count() }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($status == 'terminated') active @endif"
                                   href="{{ route('orders.index', ['status' => 'terminated']) }}">{!! __('admin.terminated') !!}
                                    <span
                                        class="badge @if($status == 'terminated') badge-white @else badge-primary @endif">
                                        {{ Order::whereStatus('terminated')->count() }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{!! __('admin.orders') !!}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('orders.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="fas fa-solid fa-plus"></i> {!! __('admin.create') !!}</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>{!! __('admin.description') !!}</th>
                                    <th>{!! __('admin.user') !!}</th>
                                    <th>{!! __('admin.price') !!}</th>
                                    <th>{!! __('admin.service') !!}</th>
                                    <th>{!! __('admin.status') !!}</th>
                                    <th>{!! __('admin.create_at') !!}</th>
                                    <th>{!! __('admin.actions') !!}</th>
                                </tr>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ Str::substr($order->id, 0, 8) }}</td>
                                        <td>
                                            <a href="{{ route('orders.edit', ['order' => $order->id]) }}"
                                               style="display: flex; color: #6c757d">
                                                <img alt="image"
                                                     src="{{ asset('storage/products/' . $order->package['icon']) }}"
                                                     class="mr-1 mt-1" style="border-radius: 5px" width="32px"
                                                     height="32px" data-toggle="tooltip" title="" data-original-title="
                                                    {{ $order->package['name'] }}">
                                                {{ $order->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $order->user->id]) }}"
                                               style="display: flex; color: #6c757d">
                                                <img alt="image" src="{{ $order->user->avatar() }}"
                                                     class="rounded-circle mr-1 mt-1" width="32px" height="32px"
                                                     data-toggle="tooltip" title="" data-original-title="
                                                    {{ $order->user->first_name }} {{ $order->user->last_name }}">
                                                <div class="flex">
                                                    {{ $order->user->username }} <br>
                                                    <small>{{ $order->user->email }}</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ currency('symbol') }}{{ $order->price['renewal_price'] }}</span>
                                            / {!! $order->periodToHuman() !!}</td>
                                        <td>{{ $order->service }}</td>
                                        <td>
                                            <div class="flex align-items-center">
                                                <i class="fas fa-solid fa-circle
                                                    @if($order->status == 'active') text-success @elseif($order->status == 'suspended') text-warning
                                                    @elseif($order->status == 'cancelled' OR $order->status == 'terminated') text-danger @endif"
                                                   style="font-size: 11px;">

                                                </i>
                                                {!! __('admin.' . $order->status) !!}
                                            </div>
                                        </td>
                                        <td>
                                            {!! __('admin.created') !!}
                                            : {{ $order->created_at->translatedFormat(settings('date_format', 'd M Y')) }}
                                            <br>
                                            {!! __('admin.due_date') !!}
                                            : {{ $order->due_date->translatedFormat(settings('date_format', 'd M Y')) }}
                                            <br>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.edit', ['order' => $order->id]) }}"
                                                class="btn btn-primary"> {!! __('admin.manage') !!}</a>
                                            @if($order->status == 'terminated')
                                                <button type="button" onclick="deleteOrder({{ $order->id }})" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $orders->links(AdminTheme::pagination()) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    function deleteOrder(order) {
        if (window.confirm('Are you sure you want to delete this order? All payments and data stored related to the order will be deleted.')) {
            window.location.href = "/admin/orders/" + order +"/delete";
        } else {
            event.preventDefault();
        }
    }
</script>
@endsection
