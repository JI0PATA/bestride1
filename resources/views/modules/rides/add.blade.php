@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="pull-left">New ride</h1>
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ route('profile.rides.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="origin" class="col-sm-2 control-label">Origin*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="origin" name="origin">
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="destination" class="col-sm-2 control-label">Destination*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="destination" name="destination">
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="available-seats" class="col-sm-2 control-label">Available Seats*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="available-seats" name="seats">
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Date of Ride*:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="date" placeholder="__/__/____" name="start_at">
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="information" class="col-sm-2 control-label">More Information:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="information" name="comment"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-7">
                            <button type="button" class="btn btn-primary pull-right disabled" id="submit_button">Register</button>
                        </div>
                    </div>

                    <small class="help-block">* Mandatory Fields</small>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let origin = new Validation($('#origin'), '.+', 'Поле не может быть пустым');
            let destination = new Validation($('#destination'), '.+', 'Поле не может быть пустым');
            let seats = new Validation($('#available-seats'), '^[0-9]+$', 'Должно быть число');
            let price = new Validation($('#price'), '^[0-9]+([.,][0-9]+)?$', 'Должно быть число');
            $('#date').datepicker({
                dateFormat: 'dd/mm/yy',
                changeYear: true,
                changeMonth: true,
                yearRange: '1950:2018',
                minDate: '0d'
            });
            let start_at = new Validation($('#date'), '^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$', 'Должна быть корректная дата');
        });
    </script>
@endpush