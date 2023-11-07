@php
    $userprice = !empty($plan) ? $plan->price_per_user_monthly : 0;
    $userpriceyearly = !empty($plan) ? $plan->price_per_user_yearly : 0;

    $workspaceprice = !empty($plan) ? $plan->price_per_workspace_monthly : 0;
    $workspacepriceyearly = !empty($plan) ? $plan->price_per_workspace_yearly : 0;

    $planprice = !empty($plan) ? $plan->package_price_monthly : 0;
    $planpriceyearly = !empty($plan) ? $plan->package_price_yearly : 0;
    $currancy_symbol = admin_setting('defult_currancy_symbol');
@endphp
@extends('layouts.main')
@section('page-title')
    {{ __('Pricing') }}
@endsection
@section('page-breadcrumb')
    {{ __('Pricing') }}
@endsection
@push('scripts')
@endpush
@section('content')
    <!-- [ Main Content ] start -->
    @if((admin_setting('custome_package') == 'on') && (admin_setting('plan_package') == 'on'))
        <div class=" col-12">
            <div class="">
                <div class="card-body package-card-inner  d-flex align-items-center justify-content-center mb-4">
                    <div class="tab-main-div">
                        <div class="nav-pills">
                            <a class="nav-link  p-2"   href="{{ route('active.plans')}}" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Pre-Packaged Subscription')}}</a>
                    </div>
                    <div class="nav-pills">
                        <a class="nav-link active p-2"   href="{{ route('plans.index',['type'=>'subscription'])}}" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Usage Subscription')}}</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-8 col-xl-7">
                    <div class="row">
                        @if(SubscriptionDetails()['status'] == true)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body package-card-inner  d-flex align-items-center">
                                        <div class="package-itm theme-avtar border border-secondary">
                                            <img src="{{ (!empty(admin_setting('favicon')) && check_file(admin_setting('favicon'))) ? get_file(admin_setting('favicon')) : get_file('uploads/logo/favicon.png')}}{{'?'.time()}}" alt="">
                                        </div>
                                        <div class="package-content flex-grow-1  px-3">
                                            <h4>{{ __('Current Subscription')}}</h4>
                                            <div class="text-muted"> <a href="#activated-add-on">{{ __(count($purchaseds).' Premium Add-on Activated')}}</a></div>
                                        </div>
                                        <div class="price text-end">
                                            <small>{{  (SubscriptionDetails()['status'] == true) ? SubscriptionDetails()['billing_type'] : '' }}</small>
                                            <h5>{{ (SubscriptionDetails()['status'] == true) ? SubscriptionDetails()['total_user'].' '.__('Users') : '' }}</h5>
                                            <h5>{{ (SubscriptionDetails()['status'] == true) ? SubscriptionDetails()['total_workspace'].' '.__('Workspace') : '' }}</h5>
                                            <span class="time-lbl text-muted">{{ ((SubscriptionDetails()['status'] == true) && (SubscriptionDetails()['plan_expire_date'] != null)) ? __('Expired At ').SubscriptionDetails()['plan_expire_date'] : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body package-card-inner  d-flex align-items-center">
                                    <div class="package-itm theme-avtar border border-secondary">
                                        <img src="{{ (!empty(admin_setting('favicon')) && check_file(admin_setting('favicon'))) ? get_file(admin_setting('favicon')) : get_file('uploads/logo/favicon.png')}}{{'?'.time()}}" alt="">
                                    </div>
                                    <div class="package-content flex-grow-1  px-3">
                                        <h4>{{ __('Basic Package')}}</h4>
                                        <div class="text-muted"><a href="#add-on-list">{{ __('+'.count($modules)+count($purchaseds).' Premium Add-on')}}</a></div>
                                    </div>
                                    <div class="price text-end">
                                        <ins class="plan-price-text">{{ $planprice . ' ' . admin_setting('defult_currancy')  }}</ins>
                                        <span class="time-lbl text-muted plan-time-text">{{ __('/Month') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($modules) > 0)
                        <h5 class="mb-1" id="add-on-list">{{ __('Modules') }}</h5>
                            @foreach ($modules as $module)
                                @php
                                    $path = $module->getPath() . '/module.json';
                                    $json = json_decode(file_get_contents($path), true);
                                @endphp
                                @if (!isset($json['display']) || $json['display'] == true)
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6 product-card ">
                                    <div class="product-card-inner">
                                        <div class="card user_module">
                                            <div class="product-img">
                                                <div class="theme-avtar">
                                                    <img src="{{ get_module_img($module->getName()) }}"
                                                        alt="{{ $module->getName() }}" class="img-user"
                                                        style="max-width: 100%">
                                                </div>
                                                <div class="checkbox-custom">
                                                        <input type="checkbox" {{ ((isset($session) && !empty($session) && ( in_array($module->getName(),explode(',',$session['user_module'])) ))) ? 'checked' :''}}
                                                            class="form-check-input pointer user_module_check"
                                                            data-module-img="{{ get_module_img($module->getName()) }}"
                                                            data-module-price-monthly="{{ ModulePriceByName($module->getName())['monthly_price'] }}"
                                                            data-module-price-yearly="{{ ModulePriceByName($module->getName())['yearly_price'] }}"
                                                            data-module-alias="{{ Module_Alias_Name($module->getName()) }}"
                                                            value="{{ $module->getName() }}">
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4> {{ Module_Alias_Name($module->getName()) }}</h4>
                                                <p class="text-muted text-sm mb-0">
                                                    {{ isset($json['description']) ? $json['description'] : '' }}
                                                </p>
                                                <div class="price d-flex justify-content-between">
                                                    <ins class="m-price-monthly"><span class="currency-type">{{ super_currency_format_with_sym(ModulePriceByName($module->getName())['monthly_price']) }}</span> <span class="time-lbl text-muted">{{ __('/Month') }}</span></ins>
                                                    <ins class="m-price-yearly d-none"><span class="currency-type">{{ super_currency_format_with_sym(ModulePriceByName($module->getName())['yearly_price']) }}</span> <span class="time-lbl text-muted">{{ __('/Year') }}</span></ins>
                                                </div>
                                                <a href="{{ route('software.details',Module_Alias_Name($module->getName())) }}" target="_new" class="btn  btn-outline-secondary w-100 mt-2">{{ __('View Details')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <div class="col-lg-12 col-md-12">
                                <div class="card p-5">
                                    <div class="d-flex justify-content-center">
                                        <div class="ms-3 text-center">
                                            <h3>{{ __('Add-on Not Available') }}</h3>
                                            <p class="text-muted">{{ __('Click ') }}<a
                                                    href="{{ url('/') }}">{{ __('here') }}</a>
                                                {{ __('to back home') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            <hr>
                        @if (!empty($purchaseds))
                        <h5 class="mb-3" id="activated-add-on">{{ __('Activated') }}</h5>
                        @foreach ($purchaseds as $purchased)
                            @php
                                $path = $purchased->getPath() . '/module.json';
                                $json = json_decode(file_get_contents($path), true);
                            @endphp
                            @if (!isset($json['display']) || $json['display'] == true)
                            <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6 product-card ">
                                <div class="card active_module">
                                    <div class="product-img">
                                        <div class="theme-avtar">
                                            <img src="{{ get_module_img($purchased->getName()) }}"
                                                            alt="{{ $purchased->getName() }}" class="img-user"
                                                            style="max-width: 100%">
                                        </div>
                                        <div class="checkbox-custom">
                                            <div class="action-btn bg-danger ms-2">
                                                {{Form::open(array('route'=>array('cancel.add.on',\Illuminate\Support\Facades\Crypt::encrypt($purchased->getName())),'class' => 'm-0'))}}
                                                @method('GET')
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel Add-on"
                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('Cancel Add-on. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$purchased->getName()}}">
                                                        <i class="ti ti-x text-white text-white"></i>
                                                    </a>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">

                                        <h4> {{ Module_Alias_Name($purchased->getName()) }}</h4>
                                        <p class="text-muted text-sm mb-0">
                                            {{ isset($json['description']) ? $json['description'] : '' }}
                                        </p>
                                        <div class="price d-flex justify-content-between">
                                            <ins class="m-price-monthly"><span class="currency-type">{{ super_currency_format_with_sym(ModulePriceByName($purchased->getName())['monthly_price']) }}</span> <span class="time-lbl text-muted">{{ __('/Month') }}</span></ins>
                                            <ins class="m-price-yearly d-none"><span class="currency-type">{{ super_currency_format_with_sym(ModulePriceByName($purchased->getName())['yearly_price']) }}</span> <span class="time-lbl text-muted">{{ __('/Year') }}</span></ins>
                                        </div>
                                        <a href="{{ route('software.details',Module_Alias_Name($purchased->getName())) }}" target="_new" class="btn  btn-outline-secondary w-100 mt-2">{{ __('View Details') }}</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-5">
                    <div class="card subscription-counter">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mt-1">{{ __('Basic Package')}}</h5>
                            <label class="switch ">
                                <span class="lbl time-monthly text-primary">{{ __('Monthly')}}</span>
                                <input type="checkbox" {{ ((isset($session) && !empty($session) && ($session['time_period'] == 'Year'))) ? 'checked' :''}} name="time-period" class="switch-change">
                                <span class="slider round"></span>
                                <span class="lbl time-yearly">{{ __('Yearly')}}</span>
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="subscription-summery">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <span class="cart-sum-left"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" fill="#002333"/>
                                            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z" fill="#002333"/>
                                            </svg>{{ __('Workspace ') }}:</span>
                                        <span class="cart-sum-right workspace_counter_text">0</span>
                                    </li>
                                    <li>
                                        <span class="cart-sum-left"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M9.00903 11.25C11.353 11.25 13.259 9.343 13.259 7C13.259 4.657 11.353 2.75 9.00903 2.75C6.66503 2.75 4.75903 4.657 4.75903 7C4.75903 9.343 6.66503 11.25 9.00903 11.25ZM9.00903 4.25C10.526 4.25 11.759 5.483 11.759 7C11.759 8.517 10.526 9.75 9.00903 9.75C7.49203 9.75 6.25903 8.517 6.25903 7C6.25903 5.483 7.49203 4.25 9.00903 4.25ZM16.75 18.519V21.5C16.75 21.914 16.414 22.25 16 22.25C15.586 22.25 15.25 21.914 15.25 21.5V18.519C15.25 17.518 14.943 14.25 11 14.25H7C3.057 14.25 2.75 17.517 2.75 18.519V21.5C2.75 21.914 2.414 22.25 2 22.25C1.586 22.25 1.25 21.914 1.25 21.5V18.519C1.25 15.858 2.756 12.75 7 12.75H11C15.244 12.75 16.75 15.857 16.75 18.519ZM14.155 10.7159C13.859 10.4259 13.8529 9.95103 14.1429 9.65503C14.4339 9.35903 14.909 9.35504 15.204 9.64404C15.563 9.99604 16.045 10.1899 16.559 10.1899C17.664 10.1899 18.53 9.32497 18.53 8.21997C18.53 7.13397 17.646 6.25 16.559 6.25C16.251 6.25 15.9731 6.31301 15.7321 6.43701C15.3651 6.62801 14.912 6.48104 14.722 6.11304C14.532 5.74504 14.678 5.29303 15.046 5.10303C15.502 4.86903 16.011 4.75 16.559 4.75C18.473 4.75 20.03 6.30697 20.03 8.21997C20.03 10.133 18.473 11.6899 16.559 11.6899C15.65 11.6899 14.797 11.3439 14.155 10.7159ZM22.75 17.1801V19.5C22.75 19.914 22.414 20.25 22 20.25C21.586 20.25 21.25 19.914 21.25 19.5V17.1801C21.25 16.4411 21.023 14.03 18.11 14.03H16.599C16.185 14.03 15.849 13.694 15.849 13.28C15.849 12.866 16.185 12.53 16.599 12.53H18.11C21.535 12.53 22.75 15.0351 22.75 17.1801Z" fill="#002333"></path>
                                            </svg>{{ __('Users ') }}:</span>
                                        <span class="cart-sum-right user_counter_text">0</span>
                                    </li>

                                    <li class="pointer extension-trigger" data-bs-toggle="collapse" data-bs-target="#extension_div">
                                        <span class="cart-sum-left"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M21 14.75H19.75V10.25H21C21.414 10.25 21.75 9.914 21.75 9.5C21.75 9.086 21.414 8.75 21 8.75H19.75V8.5C19.75 6.082 18.418 4.75 16 4.75H15.75V3.5C15.75 3.086 15.414 2.75 15 2.75C14.586 2.75 14.25 3.086 14.25 3.5V4.75H9.75V3.5C9.75 3.086 9.414 2.75 9 2.75C8.586 2.75 8.25 3.086 8.25 3.5V4.75H8C5.582 4.75 4.25 6.082 4.25 8.5V8.75H3C2.586 8.75 2.25 9.086 2.25 9.5C2.25 9.914 2.586 10.25 3 10.25H4.25V14.75H3C2.586 14.75 2.25 15.086 2.25 15.5C2.25 15.914 2.586 16.25 3 16.25H4.25V16.5C4.25 18.918 5.582 20.25 8 20.25H8.25V21.5C8.25 21.914 8.586 22.25 9 22.25C9.414 22.25 9.75 21.914 9.75 21.5V20.25H14.25V21.5C14.25 21.914 14.586 22.25 15 22.25C15.414 22.25 15.75 21.914 15.75 21.5V20.25H16C18.418 20.25 19.75 18.918 19.75 16.5V16.25H21C21.414 16.25 21.75 15.914 21.75 15.5C21.75 15.086 21.414 14.75 21 14.75ZM18.25 16.5C18.25 18.077 17.577 18.75 16 18.75H8C6.423 18.75 5.75 18.077 5.75 16.5V8.5C5.75 6.923 6.423 6.25 8 6.25H16C17.577 6.25 18.25 6.923 18.25 8.5V16.5ZM14 8.25H10C8.591 8.25 7.75 9.091 7.75 10.5V14.5C7.75 15.909 8.591 16.75 10 16.75H14C15.409 16.75 16.25 15.909 16.25 14.5V10.5C16.25 9.091 15.409 8.25 14 8.25ZM14.75 14.5C14.75 15.089 14.589 15.25 14 15.25H10C9.411 15.25 9.25 15.089 9.25 14.5V10.5C9.25 9.911 9.411 9.75 10 9.75H14C14.589 9.75 14.75 9.911 14.75 10.5V14.5Z" fill="#002333"></path>
                                            </svg>{{ __('Extension') }}:</span>
                                        <span class="cart-sum-right module_counter_text">0</span>
                                    </li>
                                    <div class="row align-items-center my-4 collapse" id="extension_div">
                                    </div>

                                </ul>

                                <div class="summery-footer">
                                    <div class="user-qty">
                                        <div class="lbl"> {{ __('Choose Workspace') }}:</div>
                                        <div class="qty-spinner">
                                            <button type="button" class="quantity-decrement" data-name = "workspace">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 1.25C6.072 1.25 1.25 6.073 1.25 12C1.25 17.927 6.072 22.75 12 22.75C17.928 22.75 22.75 17.927 22.75 12C22.75 6.073 17.928 1.25 12 1.25ZM12 21.25C6.899 21.25 2.75 17.101 2.75 12C2.75 6.899 6.899 2.75 12 2.75C17.101 2.75 21.25 6.899 21.25 12C21.25 17.101 17.101 21.25 12 21.25ZM16.25 12C16.25 12.414 15.914 12.75 15.5 12.75H8.5C8.086 12.75 7.75 12.414 7.75 12C7.75 11.586 8.086 11.25 8.5 11.25H15.5C15.914 11.25 16.25 11.586 16.25 12Z" fill="#002333"></path>
                                                </svg>
                                            </button>
                                            <input id="workspace_counter" type="number" data-cke-saved-name="quantity" name="quantity" class="quantity" step="1" value="0" min="0" max="1000" data-name = "workspace">
                                            <button type="button" class="quantity-increment " data-name = "workspace">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 1.25C6.072 1.25 1.25 6.073 1.25 12C1.25 17.927 6.072 22.75 12 22.75C17.928 22.75 22.75 17.927 22.75 12C22.75 6.073 17.928 1.25 12 1.25ZM12 21.25C6.899 21.25 2.75 17.101 2.75 12C2.75 6.899 6.899 2.75 12 2.75C17.101 2.75 21.25 6.899 21.25 12C21.25 17.101 17.101 21.25 12 21.25ZM16.25 12C16.25 12.414 15.914 12.75 15.5 12.75H12.75V15.5C12.75 15.914 12.414 16.25 12 16.25C11.586 16.25 11.25 15.914 11.25 15.5V12.75H8.5C8.086 12.75 7.75 12.414 7.75 12C7.75 11.586 8.086 11.25 8.5 11.25H11.25V8.5C11.25 8.086 11.586 7.75 12 7.75C12.414 7.75 12.75 8.086 12.75 8.5V11.25H15.5C15.914 11.25 16.25 11.586 16.25 12Z" fill="#002333"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="user-qty">
                                        <div class="lbl"> {{ __('Choose Users') }}:</div>
                                        <div class="qty-spinner">
                                            <button type="button" class="quantity-decrement" data-name = "user">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 1.25C6.072 1.25 1.25 6.073 1.25 12C1.25 17.927 6.072 22.75 12 22.75C17.928 22.75 22.75 17.927 22.75 12C22.75 6.073 17.928 1.25 12 1.25ZM12 21.25C6.899 21.25 2.75 17.101 2.75 12C2.75 6.899 6.899 2.75 12 2.75C17.101 2.75 21.25 6.899 21.25 12C21.25 17.101 17.101 21.25 12 21.25ZM16.25 12C16.25 12.414 15.914 12.75 15.5 12.75H8.5C8.086 12.75 7.75 12.414 7.75 12C7.75 11.586 8.086 11.25 8.5 11.25H15.5C15.914 11.25 16.25 11.586 16.25 12Z" fill="#002333"></path>
                                                </svg>
                                            </button>
                                            <input id="user_counter" type="number" data-cke-saved-name="quantity" name="quantity" class="quantity" step="1" value="0" min="0" max="1000" data-name = "user">
                                            <button type="button" class="quantity-increment " data-name = "user">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 1.25C6.072 1.25 1.25 6.073 1.25 12C1.25 17.927 6.072 22.75 12 22.75C17.928 22.75 22.75 17.927 22.75 12C22.75 6.073 17.928 1.25 12 1.25ZM12 21.25C6.899 21.25 2.75 17.101 2.75 12C2.75 6.899 6.899 2.75 12 2.75C17.101 2.75 21.25 6.899 21.25 12C21.25 17.101 17.101 21.25 12 21.25ZM16.25 12C16.25 12.414 15.914 12.75 15.5 12.75H12.75V15.5C12.75 15.914 12.414 16.25 12 16.25C11.586 16.25 11.25 15.914 11.25 15.5V12.75H8.5C8.086 12.75 7.75 12.414 7.75 12C7.75 11.586 8.086 11.25 8.5 11.25H11.25V8.5C11.25 8.086 11.586 7.75 12 7.75C12.414 7.75 12.75 8.086 12.75 8.5V11.25H15.5C15.914 11.25 16.25 11.586 16.25 12Z" fill="#002333"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <span class="cart-sum-left"><h6 class="mb-0">{{ __('Basic Package') }}</h6></span>
                                            <span class="cart-sum-right"><b class="planpricetext "> <span class="final_price">{{ ($planprice > 0 ) ? $planprice . $currancy_symbol : 'Free' }}</span></b></span>
                                        </li>
                                        <li>
                                            <span class="cart-sum-left"><h6 class="mb-0">{{ __('Workspace') }} <small
                                                class="text-muted workspace-price">{{ '( Per Workspace ' . $workspaceprice .$currancy_symbol . ' )' }}</small></h6></span>
                                            <span class="cart-sum-right"><b class="workspacepricetext final_price">{{ '0.00'.$currancy_symbol }}</b></span>
                                        </li>
                                        <li>
                                            <span class="cart-sum-left"><h6 class="mb-0">{{ __('Users') }} <small
                                                class="text-muted user-price">{{ '( Per User ' . $userprice .$currancy_symbol . ' )' }}</small></h6></span>
                                            <span class="cart-sum-right"><b class="userpricetext final_price">{{ '0.00'.$currancy_symbol }}</b></span>
                                        </li>
                                        <li>
                                            <span class="cart-sum-left"><h6 class="mb-0">{{ __('Extension') }}:</h6></span>
                                            <span class="cart-sum-right"><b class="module_price_text final_price">{{ '0.00'.$currancy_symbol }}</b></span>
                                        </li>
                                    </ul>
                                    <div class="row coupon_section">
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="form-group w-100">
                                                    <label for="coupon" class="form-label">{{__('Coupon')}}</label>
                                                    <input type="text" id="coupon" name="coupon" class="form-control coupon" placeholder="Enter Coupon Code">
                                                    <small class="text-danger">{{__('Coupon apply only plan actual price. ')}}</small>
                                                </div>
                                                <div class="form-group  ms-3 mt-2 apply-coupon">
                                                        <button type="button" class="btn  btn-primary"  data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Apply') }}" id="coupon-apply" ><i class="ti ti-square-check btn-apply "></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="cart-sum-left"><h6 class="">{{ __('Payment Method') }}:</h6></span>
                                    <div class="row">
                                        @if(admin_setting('bank_transfer_payment_is_on') == 'on' )
                                            <div class="col-sm-12 col-lg-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="d-flex align-items-center">
                                                                <div class="">
                                                                    <label for="bank-payment">
                                                                        <h5 class="mb-0 pointer">{{__('Bank Transfer')}}</h5>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input payment_method" name="payment_method" id="bank-payment" type="radio" data-payment-action="{{ route('plan.pay.with.bank') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="form-label">{{ __('Bank Details :') }}</label>
                                                                        <p class="">
                                                                            {!!admin_setting('bank_number') !!}
                                                                        </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">{{ __('Payment Receipt') }}</label>
                                                                    <div class="choose-files">
                                                                    <label for="temp_receipt">
                                                                        <div class=" bg-primary "> <i class="ti ti-upload px-1"></i></div>
                                                                        <input type="file" class="form-control temp_receipt" accept="image/png, image/jpeg, image/jpg, .pdf" name="temp_receipt" id="temp_receipt" data-filename="temp_receipt" onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                    <p class="text-danger error_msg d-none">{{ __('This field is required')}}</p>

                                                                    <img class="mt-2" width="70px" src=""  id="blah3">
                                                                </div>
                                                                    <div class="invalid-feedback">{{ __('invalid form file') }}</div>
                                                                </div>
                                                            </div>
                                                            <small class="text-danger">{{ __('first, make a payment and take a screenshot or download the receipt and upload it.')}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @stack('company_plan_payment')
                                    </div>
                                    <div class="cart-footer-total-row bg-primary text-white rounded p-3 d-flex align-items-center justify-content-between">
                                        <div class="mini-total-price">
                                            <div class="price">
                                                <h3 class="text-white mb-0 total">{{ '0.00'.$currancy_symbol }}</h3>
                                                <span class="time-lbl plan-time-text">{{ __('/Month')}}</span>
                                            </div>
                                        </div>
                                        {{Form::open(array('','method'=>'post','id'=>'payment_form','enctype' => 'multipart/form-data'))}}
                                            <input type="hidden" name="workspaceprice_input" value="0" class="workspaceprice_input">
                                            <input type="hidden" name="workspace_counter_input" value="0" class="workspace_counter_input">
                                            <input type="hidden" name="user_counter_input" value="0" class="user_counter_input">
                                            <input type="hidden" name="user_module_input" value="" name="user_module_input"
                                                class="user_module_input">
                                            <input type="hidden" name="userprice_input" value="0" class="userprice_input">
                                            <input type="hidden" name="user_module_price_input" value="0" class="user_module_price_input">
                                            <input type="hidden" name="time_period" value="Month" class="time_period_input">
                                            <input type="hidden" name="workspace_module_price_input" value="0" class="workspace_module_price_input">
                                            <input type="hidden" name="plan_id" value="{{$plan->id}}" class="plan_id">
                                            <input type="hidden" name="coupon_code" value="" class="coupon_code">
                                            <div class="text-end form-btn">
                                            </div>
                                        {{Form::close()}}
                                    </div>
                                    <div class="cart-reset text-center  mt-3">
                                        <a href="{{ route('module.reset') }}" class="reset-btn"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <path d="M6 0.625C3.036 0.625 0.625 3.0365 0.625 6C0.625 8.9635 3.036 11.375 6 11.375C8.964 11.375 11.375 8.9635 11.375 6C11.375 3.0365 8.964 0.625 6 0.625ZM6 10.625C3.4495 10.625 1.375 8.5505 1.375 6C1.375 3.4495 3.4495 1.375 6 1.375C8.5505 1.375 10.625 3.4495 10.625 6C10.625 8.5505 8.5505 10.625 6 10.625ZM7.765 4.76501L6.53 6L7.765 7.23499C7.9115 7.38149 7.9115 7.619 7.765 7.7655C7.692 7.8385 7.596 7.87549 7.5 7.87549C7.404 7.87549 7.308 7.839 7.235 7.7655L6 6.53049L4.765 7.7655C4.692 7.8385 4.596 7.87549 4.5 7.87549C4.404 7.87549 4.308 7.839 4.235 7.7655C4.0885 7.619 4.0885 7.38149 4.235 7.23499L5.47 6L4.235 4.76501C4.0885 4.61851 4.0885 4.381 4.235 4.2345C4.3815 4.088 4.619 4.088 4.7655 4.2345L6.0005 5.46951L7.2355 4.2345C7.382 4.088 7.61951 4.088 7.76601 4.2345C7.91151 4.381 7.9115 4.61901 7.765 4.76501Z" fill="#737373"></path>
                                            </svg>{{ __('Reset')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var userprice = '{{ $userprice }}';
            var planprice = '{{ $planprice }}';
            if(planprice  == 0){
                $(".coupon_section").addClass("d-none");
            }else{
                $(".coupon_section").removeClass("d-none");
            }
            if ($('.switch-change').prop('checked')==true)
            {
                userprice = '{{ $userpriceyearly }}';
                planprice = '{{ $planpriceyearly }}';
            }
            var user = parseInt($('.user_counter_input').val());
            var userpricetext = userprice * user;

            var currancy_symbol = '{{ $currancy_symbol }}';
            var total = parseFloat(userpricetext) + parseFloat(planprice);
            $(".total").text(parseFloat(total).toFixed(2) + currancy_symbol);
        });
        $(document).on("click", ".user_module_check", function() {
            if ($(this).closest(".user_module").hasClass("active_module"))
            {
                $(this).closest(".user_module").removeClass("active_module");

            } else {
                $(this).closest(".user_module").addClass("active_module");
            }
            ChangeModulePrice();
            ChangePrice();

        });
        $(document).on("click","#coupon-apply",function() {
            ApplyCoupon()
        });
        function ApplyCoupon(type = null){
            var coupon = $('#coupon').val();
            var duration = $('.time_period_input').val();
            var plan_id = '{{$plan->id}}';
            if(coupon == ''){
                if(type == null)
                {
                    toastrs('Error', "{{__('Coupon code required.')}}", 'error');
                }
            }else{
                $.ajax({
                    url: '{{ route('apply.coupon') }}',
                    type: 'GET',
                    data: {
                        "plan_id": plan_id,
                        "coupon": coupon,
                        "duration": duration,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data)
                    {
                        if (data != '' ) {
                            if (data.is_success == true) {
                                var currancy_symbol = '{{ $currancy_symbol }}';
                                var finalPrice = data.final_price + currancy_symbol;
                                var originalPrice = data.final_price + currancy_symbol;

                                $('.planpricetext').html('<span class="original-price">' + data.price + currancy_symbol+ '</span> / ' + '<span class="final_price">'+finalPrice + '</span>');
                                // Apply text-decoration: line-through to the original price
                                $('.original-price').css("text-decoration", "line-through");
                                $('.coupon_code').val(coupon);
                                Coupon();
                                if(type == null)
                                {
                                    toastrs('success', data.message, 'success');
                                }
                            } else {
                                $('.coupon_code').val("");
                                if(type == null)
                                {
                                    toastrs('Error', data.message, 'error');
                                }
                            }

                        } else {
                            toastrs('Error', "{{__('Coupon code required.')}}", 'error');
                        }
                    }
                });
            }
        }
    </script>
    <script>
         $(document).on('keyup mouseup', '#user_counter, #workspace_counter' , function() {
            var name = $(this).attr('data-name');
            var counter = parseInt($(this).val());
            if (counter <= 0 || counter > 1000 || $(this).val() == '')
            {
                $(this).val(0)
                var counter = 0;
            }
            if(name == "user")
            {
                $(".user_counter_text").text(counter);
                $(".user_counter_input").val(counter);
                ChangePrice(counter)
            }
            else if(name == "workspace")
            {
                $(".workspace_counter_text").text(counter);
                $(".workspace_counter_input").val(counter);
                ChangePrice(null,counter)
            }
        });
    </script>
    <script>
        function ChangePrice(user = null,workspace = null,user_module_price = 0 ) {
            var userprice = '{{ $userprice }}';
            var workspaceprice = '{{ $workspaceprice }}';
            var planprice = '{{ $planprice }}';

            if ($('.switch-change').prop('checked')==true)
            {
                userprice = '{{ $userpriceyearly }}';
                workspaceprice = '{{ $workspacepriceyearly }}';
                planprice = '{{ $planpriceyearly }}';

            }

            var currancy_symbol = '{{ $currancy_symbol }}';
            if (user == null) {
                var user = parseInt($('.user_counter_input').val());
            }
            if (user_module_price == 0) {
                var user_module_price = parseFloat($('.user_module_price_input').val());
            }
            if (workspace == null) {
                var  workspace= parseInt($('.workspace_counter_input').val());
            }
            var userpricetext = userprice * user;
            var workspacepricetext = workspaceprice * workspace;

            var total = userpricetext + user_module_price + workspacepricetext + parseFloat(planprice);
            $(".userpricetext").text(parseFloat(userpricetext).toFixed(2) + currancy_symbol);
            $(".workspacepricetext").text(parseFloat(workspacepricetext).toFixed(2) + currancy_symbol);
            $(".userprice_input").val(userpricetext);
            $(".workspaceprice_input").val(workspacepricetext);
            Coupon();

        }
        function ChangeModulePrice() {
            var user_module_input = new Array();
            var user_module_price = parseFloat(0);
            var currancy_symbol = '{{ $currancy_symbol }}';
            var n = jQuery(".user_module_check:checked").length;

            var time = '/Month';
            if ($('.switch-change').prop('checked')==true)
            {
                time = '/Year';
            }

            $("#extension_div").empty();

            if (n > 0) {
                jQuery(".user_module_check:checked").each(function() {

                    var alias = $(this).attr('data-module-alias');
                    var img = $(this).attr('data-module-img');
                    var price = parseFloat($(this).attr('data-module-price-monthly'));

                    if ($('.switch-change').prop('checked')==true)
                    {
                        price = parseFloat($(this).attr('data-module-price-yearly'));
                    }

                    $("#extension_div").append(`<div class="col-md-6 col-sm-6  my-2">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar">
                                            <img src="` + img + `" alt="` + img + `" class="img-user" style="max-width: 100%">
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0">` + alias + `</p>
                                            <h4 class="mb-0 text-primary">` + price + currancy_symbol + `<span class="text-sm">`+time+`</span></h4>
                                        </div>
                                    </div>
                                </div>`);

                    user_module_input.push($(this).val());
                    user_module_price = user_module_price + price;
                });
            }
            $(".module_counter_text").text(n);
            $(".module_price_text").text(parseFloat(user_module_price).toFixed(2) + currancy_symbol);
            $(".user_module_input").val(user_module_input);
            $(".user_module_price_input").val(user_module_price);
        }
    /********* qty spinner ********/
    var quantity = 0;
    $('.quantity-increment').click(function()
    {
        var id = $(this).attr('data-name');
        var t = $(this).siblings('.quantity');
        var quantity = parseInt($(t).val());
        if(quantity < 1000 || $(this).val() != '')
        {
            $(t).val(quantity + 1);
            if(id == 'user')
            {
                $(".user_counter_text").text(quantity + 1);
                $(".user_counter_input").val(quantity + 1);
            }
            else if(id == 'workspace')
            {
                $(".workspace_counter_text").text(quantity + 1);
                $(".workspace_counter_input").val(quantity + 1);
            }
        }
        else
        {
            $(t).val(1000);
            if(id == 'user')
            {
                $(".user_counter_text").text(1000);
                $(".user_counter_input").val(1000);
            }
            else if(id == 'workspace')
            {
                $(".workspace_counter_text").text(1000);
                $(".workspace_counter_input").val(1000);
            }
        }

        ChangePrice()
    });
    $('.quantity-decrement').click(function()
    {
        var id = $(this).attr('data-name');
        var t = $(this).siblings('.quantity');
        var quantity = parseInt($(t).val());
        if(quantity > 1)
        {
            $(t).val(quantity - 1);
            if(id == 'user')
            {
                $(".user_counter_text").text(quantity - 1);
                $(".user_counter_input").val(quantity - 1);
            }
            else if(id == 'workspace')
            {
                $(".workspace_counter_text").text(quantity - 1);
                $(".workspace_counter_input").val(quantity - 1);
            }

        }
        else
        {
            $(t).val(0);
            if(id == 'user')
            {
                $(".user_counter_text").text(1000);
                $(".user_counter_input").val(1000);
            }
            else if(id == 'workspace')
            {
                $(".workspace_counter_text").text(1000);
                $(".workspace_counter_input").val(1000);
            }
        }
        ChangePrice()
    });
    </script>
    <script>
        $(document).on("click",".switch-change",function()
        {
            SwitchChange()
        });

        function SwitchChange()
        {
            var workspaceprice = '{{ $workspaceprice }}';
            var userprice = '{{ $userprice }}';
            var planprice = '{{ $planprice }}';
            var currancy_symbol = '{{ $currancy_symbol }}';
            var user = parseInt($('.user_counter_input').val());
            var workspace = parseInt($('.workspace_counter_input').val());
            var time = '/Month';


            if ($('.switch-change').prop('checked') == true)
            {

                $(".time-monthly").removeClass("text-primary");
                $(".time-yearly").addClass("text-primary");

                $(".m-price-yearly").removeClass("d-none");
                $(".m-price-monthly").addClass("d-none");

                userprice = '{{ $userpriceyearly }}';
                workspaceprice = '{{ $workspacepriceyearly }}';
                planprice = '{{ $planpriceyearly }}';

                time = '/Year';

                $(".time_period_input").val('Year');

            }
            else
            {
                $(".time-yearly").removeClass("text-primary");
                $(".time-monthly").addClass("text-primary");

                $(".m-price-monthly").removeClass("d-none");
                $(".m-price-yearly").addClass("d-none");

                $(".time_period_input").val('Month');

            }

            var userpricetext = userprice * user;
            var workspacepricetext = workspaceprice * workspace;


            $(".plan-price-text").text(planprice + ' {{ admin_setting("defult_currancy") }}');
            $(".plan-time-text").text(time);

            $(".planpricetext").html('<span class="final_price">'+ planprice + currancy_symbol + '</span>');
            $(".user-price").text('( Per User '+ userprice + currancy_symbol+')');
            $(".userpricetext").text(parseFloat(userpricetext).toFixed(2) + currancy_symbol);
            $(".workspace-price").text('( Per Workspace '+ workspaceprice + currancy_symbol+')');
            $(".workspacepricetext").text(parseFloat(workspacepricetext).toFixed(2) + currancy_symbol);

            if(planprice  == 0){
                $(".coupon_section").addClass("d-none");
            }else{
                $(".coupon_section").removeClass("d-none");
            }
            ApplyCoupon('switch')
            ChangeModulePrice()
            ChangePrice()
        }
    </script>
    <script>
        $(document).ready(function () {
            var numItems = $('.payment_method').length

            if(numItems > 0)
            {
                $('.form-btn').append('<button type="submit" class="btn btn-dark payment-btn" >{{ __("Buy Now") }}</button>');
                setTimeout(() => {
                    $(".payment_method").first().attr('checked', true);
                    $(".payment_method").first().trigger('click');
                }, 200);
            }
            else
            {
                $('.form-btn').append("<span class='text-danger'>{{ __('Admin payment settings not set')}}</span>");
            }

        });
        $( "#payment_form" ).on( "submit", function( event ) {
            "{{session()->put('Subscription','custom_subscription')}}";
        });
         $(document).on("click",".payment_method",function() {
            var payment_action = $(this).attr("data-payment-action");
            if(payment_action != '' && payment_action != undefined)
            {
                $("#payment_form").attr("action",payment_action);
            }
            else
            {
                $("#payment_form").attr("action",'');
            }
            if ($('#bank-payment').prop('checked'))
            {
                $(".temp_receipt").attr("required", "required");
            }
            else
            {
                $(".temp_receipt").removeAttr("required");
            }
        });
        function Coupon()
        {
            var fp = 0;
            var currancy_symbol = '{{ $currancy_symbol }}';
            $( ".final_price" ).each(function( index ) {
                console.log($(this).text());
                var text = $(this).text();
                var matches = text.match(/\d+(\.\d+)?/);
                if (matches) {
                    fp += parseFloat(matches[0]);
                }
            });
            $(".total").text(fp + currancy_symbol);
        }
    </script>
    {{-- if session is not empty --}}
    @if (isset($session) && !empty($session))
    <script>
        $(document).ready(function () {
            $('#user_counter').val("{{ $session['user_counter']}}");
            $('#user_counter').trigger('keyup')
            $('#workspace_counter').val("{{ $session['workspace_counter']}}");
            $('#workspace_counter').trigger('keyup')
            SwitchChange();
        });
    </script>
    @endif
@if (admin_setting('bank_transfer_payment_is_on') == 'on')
<script>

    $('#payment_form').submit(function(e)
    {
        if ($('#bank-payment').prop('checked'))
        {
            e.preventDefault(); // Prevent form submission


            var file = document.getElementById('temp_receipt').files[0];

            if(file != undefined)
            {
                $('.error_msg').addClass('d-none');

                // Create a new FormData object
                const formData = new FormData();

                // Add file data from the file input element
                const file = $('#temp_receipt')[0].files[0];
                formData.append('payment_receipt', file, file.name);

                // Add data from the form's input elements
                $('#payment_form input').each(function() {
                formData.append(this.name, this.value);
                });

                var url = $('#payment_form').attr('action');


                $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status == 'success')
                    {
                        toastrs('Success', response.msg, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                    else
                    {
                        toastrs('Error', response.msg, 'error');
                    }
                    // Handle success response
                },
                error: function(xhr, status, error) {
                    toastrs('Error',error, 'error');
                    // Handle error response
                }
                });

            }
            else
            {
                $('.error_msg').removeClass('d-none');
            }
        }
    });

</script>
@endif
@endpush
