{{ Form::open(array('url' => 'team_tasks','method' =>'post')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-8">
            {{Form::label('title',__('Title'),['class'=>'form-label'])}}
            {{Form::text('title',null,array('class'=>'form-control font-style','required'=>'required'))}}
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label">{{ __('Priority') }}</label>
            <select class="form-control form-control-light" name="priority" id="task-priority" required>
                <option value="Low">{{ __('Low') }}</option>
                <option value="Medium">{{ __('Medium') }}</option>
                <option value="High">{{ __('High') }}</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'),['class'=>'form-label'])}}
            {{Form::text('description',null,array('class'=>'form-control font-style','required'=>'required'))}}
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Select Days') }}</label>

            <select class=" multi-select choices" id="days" name="days[]" multiple="multiple"
                data-placeholder="{{ __('Select Days ...') }}" required>
                @foreach ($days as $days)
                    <option value="{{ $days->id }}">{{ $days->name }}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>


        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Select Months') }}</label>

            <select class=" multi-select choices" id="months" name="months[]" multiple="multiple"
                data-placeholder="{{ __('Select Month ...') }}" required>
                @foreach ($months as $months)
                    <option value="{{ $months->id }}">{{ $months->name }}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Select Dates') }}</label>
            <select class=" multi-select choices" id="dates" name="dates[]" multiple="multiple"
                data-placeholder="{{ __('Select Dates ...') }}" required>
                @foreach ($dates as $d)
                    <option value="{{ $d->id }}">{{ $d->date}}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>
        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Assign To') }}</label>

            <select class=" multi-select choices" id="assign_to" name="assign_to[]" multiple="multiple"
                data-placeholder="{{ __('Select Users ...') }}" required>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->email }}</option>
                @endforeach

            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>

        <div class="col-md-12">
            <label class="col-form-label">{{ __('Duration') }}</label>
            <div class='input-group form-group'>
                <input type='text' class=" form-control form-control-light" id="duration" name="duration"
                    required autocomplete="off" placeholder="Select date range" />
                <input type="hidden" name="start_date">
                <input type="hidden" name="due_date">
                <span class="input-group-text"><i class="feather icon-calendar"></i></span>
            </div>
        </div>
        @if (module_is_active('CustomField') && !$customFields->isEmpty())
        <div class="col-md-12">
            <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                @include('customfield::formBuilder')
            </div>
        </div>
    @endif
    @if (module_is_active('Calender') && company_setting('google_calendar_enable') == 'on')
        @include('calender::setting.synchronize')
    @endif

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}


<link rel="stylesheet"
href="{{ Module::asset('Taskly:Resources/assets/libs/bootstrap-daterangepicker/daterangepicker.css') }} ">

<script src="{{ Module::asset('Taskly:Resources/assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ Module::asset('Taskly:Resources/assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}">
</script>

<script>
$(function() {
    var start = moment('{{ date('Y-m-d') }}', 'YYYY-MM-DD HH:mm:ss');
    var end = moment('{{ date('Y-m-d') }}', 'YYYY-MM-DD HH:mm:ss');

    function cb(start, end) {
        $("form #duration").val(start.format('MMM D, YY hh:mm A') + ' - ' + end.format(
        'MMM D, YY hh:mm A'));
        $('form input[name="start_date"]').val(start.format('YYYY-MM-DD HH:mm:ss'));
        $('form input[name="due_date"]').val(end.format('YYYY-MM-DD HH:mm:ss'));
    }

    $('form #duration').daterangepicker({
        autoApply: true,
        timePicker: true,
        autoUpdateInput: false,
        startDate: start,
        endDate: end,
        locale: {
            format: 'MMMM D, YYYY hh:mm A',
            applyLabel: "{{ __('Apply') }}",
            cancelLabel: "{{ __('Cancel') }}",
            fromLabel: "{{ __('From') }}",
            toLabel: "{{ __('To') }}",
            daysOfWeek: [
                "{{ __('Sun') }}",
                "{{ __('Mon') }}",
                "{{ __('Tue') }}",
                "{{ __('Wed') }}",
                "{{ __('Thu') }}",
                "{{ __('Fri') }}",
                "{{ __('Sat') }}"
            ],
            monthNames: [
                "{{ __('January') }}",
                "{{ __('February') }}",
                "{{ __('March') }}",
                "{{ __('April') }}",
                "{{ __('May') }}",
                "{{ __('June') }}",
                "{{ __('July') }}",
                "{{ __('August') }}",
                "{{ __('September') }}",
                "{{ __('October') }}",
                "{{ __('November') }}",
                "{{ __('December') }}"
            ],
        }
    }, cb);

    cb(start, end);
});

</script>
