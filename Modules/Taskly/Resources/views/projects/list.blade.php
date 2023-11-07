@extends('layouts.main')
@section('page-title')
    {{__('Manage Projects')}}
@endsection
@section('page-breadcrumb')
   {{__('Manage Projects')}}
@endsection
@section('page-action')
<div>
    @can('project import')
        <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{__('Project Import')}}" data-url="{{ route('project.file.import') }}"  data-toggle="tooltip" title="{{ __('Import') }}"><i class="ti ti-file-import"></i> </a>
    @endcan
    <a href="{{ route('projects.index') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"title="{{ __('Grid View') }}">
        <i class="ti ti-layout-grid text-white"></i>
    </a>

    @can('project create')
        <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
            data-title="{{ __('Create New Project') }}" data-url="{{ route('projects.create') }}" data-toggle="tooltip"
            title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
</div>
@endsection
@section('filter')
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Stage')}}</th>
                                    <th>{{__('Assigned User')}}</th>
                                    @if(Gate::check('project show') || Gate::check('project edit') || Gate::check('project delete'))
                                        <th scope="col" class="text-end">{{__('Action')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>
                                            <h5 class="mb-0">
                                                @if ($project->is_active)
                                                    <a href="@can('project manage') {{ route('projects.show', [$project->id]) }} @endcan"
                                                        title="{{ $project->name }}" class="">{{ $project->name }}</a>
                                                @else
                                                    <a href="#" title="{{ __('Locked') }}"
                                                        class="">{{ $project->name }}</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>{{ $project->status }}</td>
                                        <td>
                                            @foreach ($project->users as $user)
                                                @if ($user->pivot->is_active)
                                                    <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $user->name }}"
                                                        @if ($user->avatar) src="{{ get_file($user->avatar) }}" @else src="{{ get_file('avatar.png') }}" @endif
                                                        class="rounded-circle " width="25" height="25">
                                                @endif
                                            @endforeach
                                        </td>
                                        @if(Gate::check('project show') || Gate::check('project edit') || Gate::check('project delete'))
                                            <td class="text-end">
                                                @can('project create')
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <a data-size="md" data-url="{{ route('project.copy', [$project->id]) }}"  class="btn btn-sm d-inline-flex align-items-center text-white " data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Duplicate Project')}}" title="{{__('Duplicate')}}"><i class="ti ti-copy"></i></a>
                                                    </div>
                                                @endcan
                                                @can('project show')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="{{ route('projects.show',$project->id) }}" data-bs-toggle="tooltip" title="{{__('Details')}}"  data-title="{{__('Project Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-eye"></i>
                                                    </a>

                                                </div>
                                                @endcan
                                                @can('project edit')
                                                  <div class="action-btn bg-info ms-2">
                                                    <a data-size="md" data-url="{{ route('projects.edit',$project->id) }}"  class="btn btn-sm d-inline-flex align-items-center text-white " data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Project Edit')}}" title="{{__('Edit')}}"><i class="ti ti-pencil"></i></a>
                                                </div>
                                                @endcan
                                                @can('project delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
                                                    <a href="#!" class="btn btn-sm   align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                </div>
                                                @endcan
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

@endsection
