@extends('layouts.main')
@section('page-title')
{{__('Add-on Manager')}}
@endsection
@section('page-breadcrumb')
{{ __('Add-on Manager') }}
@endsection
@section('page-action')
<div>
    <a href="{{ route('module.add') }}" class="btn btn-sm btn-primary"  data-bs-toggle="tooltip" title="" data-bs-original-title="{{ __('ModuleSetup')}}">
          <i class="ti ti-plus"></i>
    </a>
</div>
@endsection
@section('content')
<div class="row justify-content-center px-0">
    <div class=" col-12">
        <div class="card">
            <div class="card-body package-card-inner  d-flex align-items-center">
                <div class="package-itm theme-avtar">
                    <a href="https://workdo.io/product-category/dash-saas-addon/?utm_source=dash-main-file&utm_medium=superadmin&utm_campaign=plan-btn-all" target="new">
                        <img src="https://workdo.io/wp-content/uploads/2023/03/favicon.jpg" alt="">
                    </a>
                </div>
                <div class="package-content flex-grow-1  px-3">
                    <h4>{{ __('Buy More Add-on')}}</h4>
                    <div class="text-muted">{{ __('+'.count($modules).' Premium Add-on')}}</div>
                </div>
                <div class="price text-end">
                  <a class="btn btn-primary" href="https://workdo.io/product-category/dash-saas-addon/?utm_source=dash-main-file&utm_medium=superadmin&utm_campaign=plan-btn-all" target="new">
                    {{ __('Buy More Add-on')}}
                  </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] start -->
    <div class="event-cards row px-0">
        @foreach ($modules as $module)
            @php
                $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                $path =$module->getPath().'/module.json';
                $json = json_decode(file_get_contents($path), true);
            @endphp
            @if (!isset($json['display']) || $json['display'] == true)
            <div class="col-lg-2 col-md-4 col-sm-6 product-card ">
                <div class="card {{ ($module->isEnabled()) ? 'enable_module' : 'disable_module'}}">
                    <div class="product-img">
                        <div class="theme-avtar">
                            <img src="{{ get_module_img($module->getName()) }}"
                                alt="{{ $module->getName() }}" class="img-user"
                                style="max-width: 100%">
                            </div>
                            <small class="text-muted">
                                @if ($module->isEnabled())
                                <span class="badge bg-success">{{ __('Enable') }}</span>
                                @else
                                <span class="badge bg-danger">{{ __('Disable') }}</span>
                                @endif
                            </small>
                        <div class="checkbox-custom">
                            <div class="btn-group card-option">
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    @if ($module->isEnabled())
                                    <a href="#!" class="dropdown-item module_change" data-id="{{ $id }}">
                                        <span>{{ __('Disable') }}</span>
                                    </a>
                                    @else
                                    <a href="#!" class="dropdown-item module_change" data-id="{{ $id }}">
                                        <span>{{ __('Enable') }}</span>
                                    </a>
                                    @endif
                                    <form action="{{ route('module.enable') }}" method="POST" id="form_{{ $id }}">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $module->getName() }}">
                                    </form>
                                    <form action="{{ route('module.remove', $module->getName()) }}" method="POST" id="form_{{ $id }}">
                                        @csrf
                                        <button type="button" class="dropdown-item show_confirm" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$id}}">
                                            <span class="text-danger">{{ __("Remove") }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4 class="text-capitalize"> {{ Module_Alias_Name($module->getName()) }}</h4>
                        <p class="text-muted text-sm mb-0">
                            {{ isset($json['description']) ? $json['description'] : '' }}
                        </p>
                        <a href="{{ route('software.details',Module_Alias_Name($module->getName())) }}" target="_new" class="btn  btn-outline-secondary w-100 mt-2">{{ __('View Details')}}</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <!-- [ sample-page ] end -->

</div>
@endsection
@push('scripts')
<script>
$(document).on('click','.module_change',function(){
    var id = $(this).attr('data-id');
    $('#form_'+id).submit();
});
</script>
@endpush
