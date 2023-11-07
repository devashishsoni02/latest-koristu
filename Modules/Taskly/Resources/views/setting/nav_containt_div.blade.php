<div class="tab-pane fade" id="customer-project" role="tabpanel" aria-labelledby="pills-user-tab-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5">{{ __('Project') }}</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Stage') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('description') }}</th>
                                    @if(Gate::check('project show') || Gate::check('project edit') || Gate::check('project delete'))
                                        <th width="10%"> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\Modules\Taskly\Entities\Project::customerProject($customer->id) as $client_project)
                                <tr class="font-style">
                                    <td>{{ !empty($client_project->project) ? $client_project->project->name : '' }}</td>
                                    <td>{{ !empty($client_project->project) ? $client_project->project->status : '' }}</td>
                                    <td>{{ !empty($client_project->project) ? company_date_formate($client_project->project->start_date) : ''}}</td>
                                    <td>{{ !empty($client_project->project) ? company_date_formate($client_project->project->end_date) : '' }}</td>
                                    <td>
                                        <p style="white-space: nowrap;
                                            width: 200px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;">{{ !empty($client_project->project) ? $client_project->project->description  : ''}}
                                        </p>
                                    </td>
                                    @if (Gate::check('project edit') || Gate::check('project delete'))
                                        <td class="Action">
                                            <span>
                                                @can('project show')
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="{{ route('projects.show',$client_project->project_id) }}" data-bs-toggle="tooltip" title="{{__('Details')}}"  data-title="{{__('Project Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
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
