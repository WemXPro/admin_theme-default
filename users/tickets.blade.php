@extends(AdminTheme::wrapper(), ['title' => __('admin.tickets'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            @includeIf(AdminTheme::path('users.user_nav'))
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if(array_key_exists('Tickets', enabledModules() ?? []))
                    @php
                        $tickets = Modules\Tickets\Entities\Ticket::where('user_id', $user->id)->get();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody><tr>
                                <th class="text-left">Subject</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Last Message by</th>
                                <th class="text-right">Last Updated</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            @if($tickets->count() == 0)
                                @include(AdminTheme::path('empty-state'), ['title' => 'No tickets found', 'description' => 'There are no new tickets'])
                            @endif
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="text-left">
                                        {{ $ticket->subject }}
                                    </td>
                                    <td>{{ $ticket->department->name }}</td>
                                    <td>
                                        @if($ticket->is_locked)
                                            <div class="badge badge-warning">
                                                Locked
                                            </div>
                                        @elseif($ticket->is_open)
                                            <div class="badge badge-success">
                                                Open
                                            </div>
                                        @else
                                            <div class="badge badge-danger">
                                                Closed
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $last_messanger = $ticket->getMessages()->latest()->first();
                                        @endphp
                                        <a href="{{ $last_messanger->user->avatar() }}" style="display: flex;justify-content: flex-start;">
                                            <img alt="image" src="https://imgur.com/koz9j8a.png" class="rounded-circle mr-2 mt-1" width="32px" height="32px" data-toggle="tooltip" title="" data-original-title="{{ $last_messanger->user->username }}">
                                            <div class="flex">
                                                {{ $last_messanger->user->username }} <br>
                                                <small>{{ $last_messanger->user->email }}</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-right">{{ $ticket->updated_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('tickets.view', $ticket->id) }}" target="_blank" class="btn btn-success">Open <i class="fas fa-external-link-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>


                @else
                    @includeIf(AdminTheme::path('empty-state'), ['title' => __('admin.no_tickets') , 'description' => __('admin.no_tickets_desc')])
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
