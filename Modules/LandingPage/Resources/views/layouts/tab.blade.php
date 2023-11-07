

    <a href="{{ route('landingpage.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'landingpage.index') ? ' active' : '' }}">{{ __('Top Bar') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('custom_page.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'custom_page.index') ? ' active' : '' }}">{{ __('Custom Page') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('homesection.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'homesection.index') ? ' active' : '' }}">{{ __('Home') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('features.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'features.index') ? ' active' : '' }}">{{ __('Features') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('review.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'review.index') ? ' active' : '' }}">{{ __('Review') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('screenshots.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'screenshots.index') ? ' active' : '' }}">{{ __('Screenshots') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="{{ route('dedicated.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'dedicated.index') ? ' active' : '' }}">{{ __('Dedicated') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="{{ route('buildtech.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'buildtech.index') ? ' active' : '' }}">{{ __('BuildTech') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="{{ route('packagedetails.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'packagedetails.index') ? ' active' : '' }}">{{ __('Package Details') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <a href="{{ route('join_us.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'join_us.index') ? ' active' : '' }}">{{ __('Join Us') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    
    <a href="{{ route('footer.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'footer.index') ? ' active' : '' }}">{{ __('Footer') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    <div class="modal fade" id="exampleModalCenter" tabindex="2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ss_modale" role="document">
            <div class="modal-content image_sider_div">
            
            </div>
        </div>
    </div>

    @push('css')
        @include('landingpage::layouts.infoimagescss')
    @endpush

    @push('scripts')
        @include('landingpage::layouts.infoimagesjs')
    @endpush