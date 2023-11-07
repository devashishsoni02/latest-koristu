@can('unit manage')
    <div id="unit-settings" class="">
        <div class="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11">
                                <h5 class="">
                                    {{ __('Unit') }}
                                </h5>
                            </div>
                            <div class="col-1 text-end">
                                @can('unit cerate')
                                    <div class="float-end">
                                        <a  data-url="{{ route('units.create') }}" data-ajax-popup="true"
                                            data-title="{{ __('Create New Unit') }}" data-bs-toggle="tooltip"
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
                                    <th> {{ __('Unit') }}</th>
                                    @if (Gate::check('unit edit') || Gate::check('unit delete'))
                                        <th width="10%"> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $unit->name }}</td>
                                        @if (Gate::check('unit edit') || Gate::check('unit delete'))
                                            <td class="Action">
                                                <span>
                                                    @can('unit edit')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center"
                                                                data-url="{{ route('units.edit', $unit->id) }}"
                                                                data-ajax-popup="true" title="{{ __('Edit') }}"
                                                                data-bs-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('unit delete')
                                                        <div class="action-btn bg-danger ms-2">

                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['units.destroy', $unit->id],
                                                                'id' => 'delete-form-' . $unit->id,
                                                            ]) !!}
                                                            <a
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}" data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $unit->id }}').submit();">
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
