<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav"> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("delegate.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("delegate.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("delegate/orders") || request()->is("delegate/orders/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-gift c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("delegate.money-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("delegate/money-requests") || request()->is("delegate/money-requests/*") ? "c-active" : "" }}">
                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.moneyRequest.title') }}
            </a>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("delegate.targets.index") }}" class="c-sidebar-nav-link {{ request()->is("delegate/targets") || request()->is("delegate/targets/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-medal c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.target.title') }}
            </a>
        </li> 
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("delegate.messenger.index") }}" class="{{ request()->is("delegate/messenger") || request()->is("delegate/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>