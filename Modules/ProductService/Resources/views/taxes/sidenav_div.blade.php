@can('tax manage')
    <div id="tax-settings" class="">
        <div class="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11">
                                <h5 class="">
                                    {{ __('Tax') }}
                                </h5>
                            </div>
                            <div class="col-1 text-end">
                                @can('tax create')
                                    <div class="float-end">
                                        <a  data-url="{{ route('tax.create') }}" data-ajax-popup="true"
                                            data-title="{{ __('Create Tax Rate') }}" data-bs-toggle="tooltip"
                                            title="{{ __('Create') }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 pc-dt-simple" id="category">
                            <thead>
                                <tr>
                                <tr>
                                    <th> {{ __('Tax Name') }}</th>
                                    <th> {{ __('Rate %') }}</th>
                                    @if (Gate::check('tax edit') || Gate::check('tax delete'))
                                        <th width="10%"> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxes as $taxe)
                                    <tr class="font-style">
                                        <td>{{ $taxe->name }}</td>
                                        <td>{{ $taxe->rate }}</td>
                                        @if (Gate::check('tax edit') || Gate::check('tax delete'))
                                            <td class="Action">
                                                <span>
                                                    @can('tax edit')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center"
                                                                data-url="{{ route('tax.edit', $taxe->id) }}"
                                                                data-ajax-popup="true" data-title="{{ __('Edit Tax Rate') }}"
                                                                data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                                data-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('tax delete')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['tax.destroy', $taxe->id],
                                                                'id' => 'delete-form-' . $taxe->id,
                                                            ]) !!}
                                                            <a
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $taxe->id }}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan

                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
@push('scripts')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
@endpush
