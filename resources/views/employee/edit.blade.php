@extends('layout.app')
@push('head')

@endpush
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Employee</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="" action="{{ route('employee.update') }}" method="POST" novalidate>
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $employee->id }}">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="1" name="name" value="{{ $employee->name }}" placeholder="ex. John f. Kennedy" required="required" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Department<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select id="heard" name="department_id" class="form-control" required>
                                    <option value="" disabled selected>Choose..</option>
                                    @foreach($departments as $key => $department)
                                        <option value="{{ $department->id }}" {{ $department->id === $employee->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select id="heard" name="positions_id" class="form-control" required>
                                    <option value="" disabled selected>Choose..</option>
                                    @foreach($positions as $key => $position)
                                        <option value="{{ $position->id }}" {{ $position->id === $employee->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="email" value="{{ $employee->email }}" class='email' required="required" type="email" /></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="phone_number" class='number' name="phone_number" value="{{ $employee->phone_number }}" data-validate-minmax="10,100" required='required'></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea required="required" name='address'>{{ $employee->address }}</textarea></div>
                        </div>
                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 mt-2 offset-md-3">
                                    <button type='submit' class="btn btn-primary">Submit</button>
                                    <button type='reset' class="btn btn-success">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('script')
    <script src="{{ asset('vendors/validator/validator.js') }}"></script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>

@endpush
