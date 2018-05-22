@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="pull-left">Registration</h1>
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ route('register') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email*:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password*:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-sm-2 control-label">Confirm Password*:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password-confirm" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birthdate" class="col-sm-2 control-label">Birthdate*:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="birthdate" placeholder="__/__/____"
                                   name="birthdate" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">Avatar*:</label>
                        <div class="col-sm-7">
                            <input type="file" id="avatar" name="avatar" required>
                        </div>
                        <div class="col-sm-3 msg-error">
                            <div class="help-block help-block-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-7">
                            <button type="button" class="btn btn-primary pull-right disabled" id="submit_button">
                                Register
                            </button>
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
        $(document).ready(function () {
            let name = new Validation($('#name'), '^.{5,}$', 'Длина не менее 5 символов');
            let email = new Validation($('#email'), '^.+@.+\\..+$', 'Должен быть email');
            let password = new Validation($('#password'), '^.+$', 'Пароль не должен быть пустым', function () {
                let password_el = $('#password');
                let password_conf_el = $('#password-confirm');

                if (password_conf_el.val().length !== 0) {
                    if (password_el.val() !== password_conf_el.val()) {
                        password.error('Пароли не совпадают');
                        password_conf.error('Пароли не совпадают');
                    } else {
                        password.success();
                        password_conf.success();
                    }
                } else {
                    password.success();
                }
            });
            let password_conf = new Validation($('#password-confirm'), '^.+$', 'Пароль не должен быть пустым', function () {
                let password_el = $('#password');
                let password_conf_el = $('#password-confirm');

                if (password_el.val().length !== 0) {
                    if (password_conf_el.val() !== password_el.val()) {
                        password.error('Пароли не совпадают');
                        password_conf.error('Пароли не совпадают');
                    } else {
                        password.success();
                        password_conf.success();
                    }
                } else {
                    password_conf.success();
                }
            });

            $('#birthdate').datepicker({
                dateFormat: 'dd/mm/yy',
                changeYear: true,
                changeMonth: true,
                maxDate: '0d',
                yearRange: '1950:2018'
            });

            let birthdate = new Validation($('#birthdate'), '^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$', 'Некорректная дата');
            let avatar = new Validation($('#avatar'), '', 'Обязательное поле!', function() {
                let file = $('#avatar').prop('files')[0];

                if (file.type !== 'image/jpeg') return avatar.error('Только JPG');
                if (file.size / 1024 / 1024 > 1) return avatar.error('Не больше 1Мб');

                avatar.success();

            });
        });
    </script>
@endpush
