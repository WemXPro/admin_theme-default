<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.view') }}">{!! __('admin.admin_panel') !!}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.view') }}">{!! __('admin.panel', ['default' => 'PANEL']) !!}</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">{!! __('admin.dashboard', ['default' => 'Dashboard']) !!}</li>
            <li>
                <a class="nav-link {{ nav_active('admin.view') }}" href="{{ route('admin.view') }}">
                    <i class="fas fa-fire"></i>
                    <span>{!! __('admin.overview') !!}</span>
                </a>
            </li>

            <li class="menu-header">
                {!!  __('admin.client_management', ['default' => 'Client Management']) !!}
            </li>
            <li class="dropdown {{ nav_active(['users.*', 'groups.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                    <span>{!! __('admin.customers') !!}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ nav_active('users.*') }}" href="{{ route('users.index') }}">
                            {!! __('admin.clients') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('groups.*') }}" href="{{ route('groups.index') }}">
                            {!! __('admin.groups') !!}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ nav_active(['admin.bans.*', 'admin.warnings.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-gavel"></i>
                    <span>{!! __('admin.moderation') !!}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ nav_active('admin.bans.*') }}" href="{{ route('admin.bans.index') }}">
                            {{ __('admin.bans') }}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.warnings.*') }}"
                           href="{{ route('admin.warnings.index') }}">
                            {{ __('admin.warnings') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="nav-link {{ nav_active('payments.index') }}"
                   href="{{ route('payments.index', ['status' => 'paid']) }}">
                    <i class="fas fa-solid fa-coins"></i>
                    <span>{!! __('admin.payments', ['default' => 'Payments']) !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('payments.subscriptions') }}"
                   href="{{ route('payments.subscriptions', ['status' => 'paid']) }}">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>{!! __('client.subscription') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('orders.*') }}"
                   href="{{ route('orders.index', ['status' => 'active']) }}">
                    <i class="fas fa-solid fa-server"></i>
                    <span>{!!  __('admin.orders', ['default' => 'Orders']) !!}</span>
                </a>
            </li>

            <li class="menu-header">{!!  __('admin.settings', ['default' => 'Settings']) !!}</li>
            <li class="dropdown {{ nav_active('admin/settings', prefix: true) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                    <span>{!!  __('admin.configuration', ['default' => 'Configuration']) !!}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ nav_active('admin.settings') }}" href="{{ route('admin.settings') }}">
                            {!! __('admin.settings') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.config') }}" href="{{ route('admin.config') }}">
                            {!! __('admin.config') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.seo') }}" href="{{ route('admin.seo') }}">
                            {!! __('admin.seo') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.taxes') }}" href="{{ route('admin.taxes') }}">
                            {{ __('admin.taxes') }}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.registrations') }}"
                           href="{{ route('admin.registrations') }}">
                            {!! __('admin.registrations') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.oauth') }}" href="{{ route('admin.oauth') }}">
                            {!! __('admin.oauth') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.captcha') }}" href="{{ route('admin.captcha') }}">
                            {!! __('admin.captcha') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.maintenance') }}"
                           href="{{ route('admin.maintenance') }}">
                            {!! __('admin.maintenance') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('admin.settings.portal') }}"
                           href="{{ route('admin.settings.portal') }}">
                            {!! __('admin.portals') !!}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ nav_active('admin/emails', prefix: true) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-envelope"></i>
                    <span>{!! __('admin.emails') !!}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ nav_active('emails.history') }}" href="{{ route('emails.history') }}">
                            {!! __('admin.history') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('emails.configure') }}" href="{{ route('emails.configure') }}">
                            {!! __('admin.configure') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('emails.messages') }}" href="{{ route('emails.messages') }}">
                            {!! __('admin.messages') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('emails.templates') }}" href="{{ route('emails.templates') }}">
                            {!! __('admin.templates') !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ nav_active('emails.mass-mailer') }}"
                           href="{{ route('emails.mass-mailer') }}">
                            Mass Mailer
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="nav-link {{ nav_active('pages.*') }}" href="{{ route('pages.index') }}">
                    <i class="fas fa-solid fa-file"></i>
                    <span>{!! __('admin.pages') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('articles.*') }}" href="{{ route('articles.index') }}">
                    <i class="fas fa-solid fa-newspaper"></i>
                    <span>{{ __('admin.articles') }}</span>
                </a>
            </li>


            <li class="menu-header">
                {!! __('admin.products_and_services') !!}
            </li>

            <li>
                <a class="nav-link {{ nav_active('categories.*') }}" href="{{ route('categories.index') }}">
                    <i class="fas fa-folder-open"></i>
                    <span>{!! __('admin.categories') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('packages.*') }}" href="{{ route('packages.index') }}">
                    <i class="fas fa-box-open"></i>
                    <span>{!! __('admin.packages') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('coupons.*') }}" href="{{ route('coupons.index') }}">
                    <i class="fas fa-tag"></i>
                    <span>{!! __('admin.coupons') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('gateways.*') }}" href="{{ route('gateways.index') }}">
                    <i class="fas fa-solid fa-credit-card"></i>
                    <span>{!! __('admin.gateways') !!}</span>
                </a>
            </li>

            <li class="menu-header">
                {!! __('admin.design_and_compatibility') !!}
            </li>

            <li>
                <a class="nav-link {{ nav_active(['admin.themes', 'admin.theme.*']) }}"
                   href="{{ route('admin.themes') }}">
                    <i class="fas fa-sharp fa-solid fa-palette"></i>
                    <span>{!! __('admin.themes') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('modules.view') }}" href="{{ route('modules.view') }}">
                    <i class="fas fa-solid fa-plug"></i>
                    <span>{!! __('admin.modules') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('services.view') }}" href="{{ route('services.view') }}">
                    <i class="fas fa-solid fa-robot"></i>
                    <span>{!! __('admin.services') !!}</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ nav_active('widgets.index') }}" href="{{ route('widgets.index') }}">
                    <i class="fa-solid fa-square-poll-horizontal"></i>
                    <span>{!! __('admin.widgets') !!}</span>
                </a>
            </li>

            @include('admin::layouts.partials.extensions-menu-items', [
                'extensions' => enabledExtensions('Modules'),
                'name' => __('admin.modules')
            ])
            @include('admin::layouts.partials.extensions-menu-items', [
                'extensions' => enabledExtensions('Services'),
                'name' => __('admin.services')
            ])

            <li class="menu-header">
                {!! __('admin.other') !!}
            </li>
            <li>
                <a class="nav-link {{ nav_active('api-v1.*') }}" href="{{ route('api-v1.index') }}">
                    <i class="fas fa-solid fa-code"></i>
                    <span>{!! __('admin.api_tokens') !!}</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ nav_active('updates.index') }}" href="{{ route('updates.index') }}">
                    <i class="fas fa-cloud-download-alt"></i>
                    <span>{{ __('admin.updates') }}</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ nav_active('logs.index') }}" href="{{ route('logs.index') }}">
                    <i class="fas fa-book"></i>
                    <span>{!! __('admin.logs') !!}</span>
                </a>
            </li>
        </ul>

        <div id="nav-footer" style="min-height: 20px;"></div>
        <hr>
    </aside>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let activeItem = document.querySelector('.sidebar-menu .active-nav');
                if (activeItem) {
                    activeItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 300);
        });
    </script>
</div>
