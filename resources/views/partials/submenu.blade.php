{{-- Sidebar Performance Changes --}}
<ul class="dash-submenu">
    @foreach ($childs as $child)
        @can($child->permissions)
            <li class="dash-item">
                <a class="dash-link" href="{{ empty($child->route) ? '#!' : route($child->route) }}">{{ __($child->title) }}
                    @if (count($child->childs))
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    @endif
                </a>
                @include('partials.submenu', ['childs' => $child->childs])
            </li>
        @endcan
    @endforeach
</ul>
