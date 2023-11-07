{{-- Sidebar Performance Changes --}}
<nav
    class="dash-sidebar light-sidebar {{ empty(company_setting('site_transparent')) || company_setting('site_transparent') == 'on' ? 'transprent-bg' : '' }}">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="{{ url('/') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ get_file(sidebar_logo()) }}{{ '?' . time() }}" alt="" class="logo logo-lg" />
                <img src="{{ get_file(sidebar_logo()) }}{{ '?' . time() }}" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar">

                @foreach (getSideMenu() as $key => $menu)
                    @can($menu->permissions)
                        @php
                            $route = '#!';
                            if (!empty($menu->route)) {
                                $route = route($menu->route);
                            }
                            if (count($menu->childs) == 1) {
                                if (!empty($menu->childs[0]->route)) {
                                    $route = route($menu->childs[0]->route);
                                }
                            }

                        @endphp

                        <li class="dash-item dash-hasmenu">
                            <a href="{{ $route }}" class="dash-link {{ $menu->permissions }}">
                                <span class="dash-micon"><i class="{{ $menu->icon }}"></i></span>
                                <span class="dash-mtext">{{ __($menu->title) }}</span>
                                @if (count($menu->childs) > 1)
                                    <span class="dash-arrow">
                                        <i data-feather="chevron-right"></i>
                                    </span>
                                @endif
                            </a>

                            @if (count($menu->childs) > 1)
                                @include('partials.submenu', [
                                    'childs' => $menu->childs,
                                ])
                            @endif
                        </li>
                    @endcan
                @endforeach
                    @stack('custom_side_menu')
            </ul>
        </div>
    </div>
</nav>
