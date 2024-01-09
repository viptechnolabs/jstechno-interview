@extends('layout.app')
@push('head')

@endpush
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Add Salary</h3>
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
                    <form class="" action="{{ route('salary.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select id="heard" name="positions_id" class="form-control" required>
                                    <option value="" disabled selected>Choose..</option>
                                    @foreach($positions as $key => $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Basic Salary<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="number" class="form-control" data-validate-length-range="2" data-validate-words="1" name="basic_salary" placeholder="30000" required="required" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Hra<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="number" class="form-control" data-validate-length-range="2" data-validate-words="1" name="hra" placeholder="30000" required="required" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Da<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="number" class="form-control" data-validate-length-range="2" data-validate-words="1" name="da" placeholder="30000" required="required" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Other Allowances<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="number" class="form-control" data-validate-length-range="2" data-validate-words="1" name="other_allowances" placeholder="30000" required="required" />
                            </div>
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
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>

@endpush
