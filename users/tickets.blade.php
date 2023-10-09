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

                @includeIf(AdminTheme::path('empty-state'), ['title' => 'No Active Tickets', 'description' => 'This user has no tickets in history'])

            </div>
        </div>
    </div>
</section>
@endsection
