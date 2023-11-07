<div class="tab-pane fade" id="vendor-purchase" role="tabpanel" aria-labelledby="pills-user-tab-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5">{{ __('Purchase') }}</h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>{{__('Vendor')}}</th>
                                    <th>{{__('Vendor Date')}}</th>
                                    <th>{{__('Due Amount')}}</th>
                                    <th>{{__('Status')}}</th>
                                    @if(Gate::check('purchase edit') || Gate::check('purchase delete') || Gate::check('purchase show'))
                                        <th width="10%"> {{__('Action')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @forelse (\Modules\Pos\Entities\Purchase::vendorPurchase($vendor->user_id) as $purchase)
                                <tr class="font-style">
                                    <td class="Id">
                                        @can('purchase show')
                                            <a href="{{ route('purchase.show',\Crypt::encrypt($purchase->id)) }}" class="btn btn-outline-primary">{{ \Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id) }}</a>
                                        @else
                                            <a  class="btn btn-outline-primary">{{ \Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id) }}</a>
                                        @endcan
                                    </td>
                                    <td>{{ company_date_formate($purchase->purchase_date) }}</td>
                                    <td>{{ currency_format_with_sym($purchase->getDue())  }}</td>
                                    <td>
                                        @if($purchase->status == 0)
                                            <span class="badge bg-primary p-2 px-3 rounded">{{ __(\Modules\Pos\Entities\Purchase::$statues[$purchase->status]) }}</span>
                                        @elseif($purchase->status == 1)
                                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\Modules\Pos\Entities\Purchase::$statues[$purchase->status]) }}</span>
                                        @elseif($purchase->status == 2)
                                            <span class="badge bg-danger p-2 px-3 rounded">{{ __(\Modules\Pos\Entities\Purchase::$statues[$purchase->status]) }}</span>
                                        @elseif($purchase->status == 3)
                                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\Modules\Pos\Entities\Purchase::$statues[$purchase->status]) }}</span>
                                        @elseif($purchase->status == 4)
                                            <span class="badge bg-success p-2 px-3 rounded">{{ __(\Modules\Pos\Entities\Purchase::$statues[$purchase->status]) }}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('purchase edit') || Gate::check('purchase delete') || Gate::check('purchase show'))
                                    <td class="Action">
                                        <span>
                                            @can('purchase show')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('purchase.show',\Crypt::encrypt($purchase->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('purchase edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('purchase.edit',\Crypt::encrypt($purchase->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('purchase delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['purchase.destroy', $purchase->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$purchase->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center show_confirm" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?')}}" data-confirm-yes="document.getElementById('delete-form-{{$purchase->id}}').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                        </span>
                                    </td>
                                @endif
                                </tr>
                                @empty
                                    @include('layouts.nodatafound')
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
