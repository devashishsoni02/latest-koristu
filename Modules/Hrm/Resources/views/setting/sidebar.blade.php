@can('hrm manage')
    <a href="#hrm-sidenav" class="list-group-item list-group-item-action">
        {{ __('HRM Settings') }}
        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
@endcan
@if (module_is_active('Recruitment'))
    @can('letter offer manage')
        <a href="#offer-letter-settings" class="list-group-item list-group-item-action">
            {{ __('Offer Letter Settings') }}
            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
    @endcan
@endif
@can('letter joining manage')
    <a href="#joining-letter-settings" class="list-group-item list-group-item-action">
        {{ __('Joining Letter Settings') }}
        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
@endcan
@can('letter certificate manage')
    <a href="#experience-certificate-settings" class="list-group-item list-group-item-action">
        {{ __('Certificate of Experience Settings') }}
        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
@endcan
@can('letter noc manage')
    <a href="#noc-settings" class="list-group-item list-group-item-action">
        {{ __('No Objection Certificate Settings') }}
        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
@endcan

