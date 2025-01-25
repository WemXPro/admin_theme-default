<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" target="_blank" class="nav-link nav-link-lg">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
    </form>

    @if (auth()->check())
        <ul class="navbar-nav navbar-right">
            @foreach (enabledExtensions() as $extension)
                @includeIf(AdminTheme::moduleView($extension->getLowerName(), 'elements.navbar-dropdown-right'))
            @endforeach

            <li>
                <a href="{{ route('admin.toggle-mode') }}" class="nav-link nav-link-lg">
                    <i class="fas fa-adjust"></i>
                </a>
            </li>

            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
                    <i class="far fa-envelope"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">
                        {!! __('admin.email_history', ['default' => 'Email History']) !!}
                    </div>
                    <div class="dropdown-list-content dropdown-list-message">
                        @foreach (EmailHistory::where('user_id', Auth::user()->id)->latest()->paginate(10) as $email)
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image"
                                         src="https://upload.wikimedia.org/wikipedia/commons/5/5f/Gravatar-default-logo.jpg"
                                         class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>{{ $email->receiver }}</b>
                                    <p>{{ $email->subject }}</p>
                                    <div class="time">{{ $email->created_at->diffForHumans() }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="{{ route('email.history') }}">
                            {!! __('admin.view_all', ['default' => 'View All']) !!}
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </li>

            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown"
                   class="nav-link notification-toggle nav-link-lg
                   @if (Notification::where('user_id', Auth::user()->id)->where('read_at', '=', null)->exists()) beep @endif">
                    <i class="far fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">
                        {!! __('admin.notifications', ['default' => 'Notifications']) !!}
                        <div class="float-right">
                            <a href="{{ route('notifications.mark-as-read') }}">
                                {!! __('admin.mark_as_read', ['default' => 'Mark All As Read']) !!}
                            </a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        @foreach (Notification::where('user_id', Auth::user()->id)->latest()->paginate(10) as $notification)
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-desc">
                                    {{ $notification->message }}
                                    <div class="time text-primary">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ Auth::user()->avatar() }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::user()->hasPerm('admin.view'))
                        <a href="{{ route('admin.view') }}" class="dropdown-item has-icon">
                            <i class="fas fa-solid fa-toolbox"></i>
                            {!! __('admin.admin_panel') !!}
                        </a>
                    @endif
                    <a href="{{ route('user.settings') }}" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i>
                        {!! __('admin.settings', ['default' => 'Settings']) !!}
                    </a>
                    @foreach (enabledExtensions() as $extension)
                        @if($extension->config('elements.user_dropdown', false))
                            @foreach ($extension->config('elements.user_dropdown', []) as $key => $menu)
                                <a href="{{ $menu['href'] }}" class="dropdown-item has-icon"
                                   style="{{ $menu['style'] }}">
                                    {!! $menu['icon'] !!} {!! __($menu['name']) !!}
                                </a>
                            @endforeach
                        @endif
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="/auth/logout" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        {!! __('admin.logout', ['default' => 'Logout']) !!}
                    </a>
                </div>
            </li>
        </ul>
    @endif
</nav>
