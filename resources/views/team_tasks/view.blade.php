@extends('layouts.main')
@section('page-title')
    {{__('Manage Team_task Details')}}
@endsection
@section('breadcrumb')
    {{__('Team_task Details')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table  mb-0 pc-dt-simple" id="user-coupon">
                            <thead>
                            <tr>
                                <th> {{__('Name')}}</th>
                                <th> {{__('Descreption')}}</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($team_tasks as $team_task)
                               
                                <tr class="font-style">
                                    
                                <td>{{ $team_task->name }}</td>
                                    <td>{{ $team_task->desc }}</td>
                                   
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
